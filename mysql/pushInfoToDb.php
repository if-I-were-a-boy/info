<?php
/**
 * Created by PhpStorm.
 * User: didi
 * Date: 2018/5/16
 * Time: 下午5:41
 */
require_once './mysql.php';
require_once './../tool/function.php';
ini_set('date.timezone','Asia/Shanghai');

//初始化数据
$dbn = (new MysqlDb())->connMysql();
$nowTime = date("Y-m-d H:i:s");

//获取最大时间
$maxTime = getMaxTimeFromDb($dbn);

//爬取数据
$res = doSpider($maxTime);

//存储数据(2小时一次 )
if(!empty($res[0])){
    saveDb($res, $dbn, $nowTime);
}

function getMaxTimeFromDb($dbn){
    $sql = "select max(time) from pushInfo";
    $result = $dbn->query($sql);
    $row = $result->fetch();
    $maxTime = $row[0];
    return $maxTime;
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

        $url="https://www.nowcoder.com/search?type=post&order=time&query=%E5%86%85%E6%8E%A8&page=".$i;

        $html = searchInfo($rules, $rang, $url);
        $info = cutInfo($html);
        foreach ($info['par_o'][0] as $key => $value) {
            $perInfo =  getDetail($info['par_o'][0][$key], $info['par_t'][0][$key]);
            if($perInfo['time_stamp'] <= $maxTime) {
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
