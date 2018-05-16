<?php
/**
 * Created by PhpStorm.
 * User: didi
 * Date: 2018/5/15
 * Time: 下午5:08
 */
require_once './mysql.php';
require_once './../tool/opRedis.php';
require_once './../tool/function.php';
ini_set('date.timezone','Asia/Shanghai');

//初始化数据
$dbn = (new MysqlDb())->connMysql();
$opRedis = new opRedis();
$nowTime = date("Y-m-d H:i:s");

//获取最大时间
$maxTime = getMaxTime($dbn, $opRedis);

//爬取数据
$res = doSpider($maxTime);

//存储数据(2小时一次 )
saveDb($res, $dbn, $nowTime);

//存储redis


//更新最大时间
setMaxTime($dbn, $opRedis);

function getMaxTimeFromDb($dbn){
    $sql = "select max(time) from pushInfo where true";
    $dbn->query("SET NAMES utf8");
    $result = $dbn->query($sql);
    $maxTime = $result[0]['time'];
    return $maxTime;
}

function getMaxTime($dbn, $opRedis){
    //先从redis中获取时间戳 maxTime
    $maxTime = $opRedis->get('maxTime');
    if(empty($maxTime)){
        $maxTime = getMaxTimeFromDb($dbn);
    }

    return $maxTime;
}

function setMaxTime($dbn, $opRedis){

    $maxTime = getMaxTimeFromDb($dbn);
    $opRedis->set('maxTime',$maxTime);
    $opRedis->expire('maxTime','7200');
    return "OK";
}



//开始爬取数据
function doSpider($maxTime){

    $rules = array(
        'text' => array('.discuss-detail','html'),
    );

    $rang = '.module-body';
    $flag = false;
    $sumInfo = [];

    for($i=1;$i<=250;$i++) {
        //爬取符合条件的html
        $allInfo = [];
        if($flag) {
            break;
        }
        $html = searchInfo($i,$rules, $rang);
        $info = cutInfo($html);
        foreach ($info['par_o'][0] as $key => $value) {
            $perInfo =  getDetail($info['par_o'][0][$key], $info['par_t'][0][$key]);
            if($perInfo['time_stamp'] < $maxTime) {
                $flag = true;
                break;
            }
            if(isset($perInfo["type"]) && $perInfo["type"]){
                $allInfo[] = $perInfo;
            }
        }

        $sumInfo[] = array_reverse($allInfo);

    }

    return array_reverse($sumInfo);
}

function saveDb($res, $dbn, $nowTime){
    foreach ($res as $key => $value) {
        foreach ($value as $k => $v ){
            try{
                $temp = $v['time_stamp'] + 20*24*60*60;
                $dbn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $dbn->query("SET NAMES utf8");
                $sql = 'insert into pushInfo(title,`time`,`date`, detail, enable, expire) values("'.$v['title'].'","'.$v['time_stamp'].'","'.$v['date'].'","'.$v['link'].'",0,"'.$temp.'")';
                $dbn->exec($sql);
                $content = '['.$nowTime.']      '.$sql.'     success';
                file_put_contents('access-log.txt', $content,FILE_APPEND);
                //从数据中选择最大的时间戳,存入到redis

                //$sql = "select max(time) from Student where true";
                //$res=$dbn->query($sql);
                echo "yes";
            }catch(PDOException $e)
            {
                $content = '['.$nowTime.']      '.$e->getMessage().'         '.$sql;
                file_put_contents('error-log.txt', $content,FILE_APPEND);
                echo $sql . "<br>" . $e->getMessage();
            }

        }
    }
}
?>
