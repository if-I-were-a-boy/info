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

$dbn = (new MysqlDb())->connMysql();

//先导入一批数据进去
$rules = array(
    'text' => array('.discuss-detail','html'),
);

$rang = '.module-body';
$allInfo = [];
$flag = false;
$sumInfo = [];
for($i=3;$i>=1;$i--) {
    //爬取符合条件的html
    $allInfo = [];
    $flag = false;
    $html = searchInfo($i,$rules, $rang);
    $info = cutInfo($html);
    foreach ($info['par_o'][0] as $key => $value) {
        $perInfo =  getDetail($info['par_o'][0][$key], $info['par_t'][0][$key]);
            if($perInfo['date'] < "2018-05-01 ") {
                $flag = true;
                break;
            }
        if(isset($perInfo["type"]) && $perInfo["type"]){
            $allInfo[] = $perInfo;
        }
    }

    $sumInfo[] = array_reverse($allInfo);

}
 foreach ($sumInfo as $key => $value) {
    foreach ($value as $k => $v ){
        try{$temp = $v['time_stamp'] + 20*24*60*60;
            $dbn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbn->query("SET NAMES utf8");
            $sql = 'insert into pushInfo(title,`time`,`date`, detail, enable, expire) values("'.$v['title'].'","'.$v['time_stamp'].'","'.$v['date'].'","'.$v['link'].'",0,"'.$temp.'")';
            $dbn->exec($sql);
            echo "yes";
        }catch(PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
        }

    }
 }




////查询当前查找时间的限制
//$sql = "select max(time) from Student where true";
//
//$res=$dbn->query($sql);





?>
