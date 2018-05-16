<?php
require_once './mysql.php';
require_once './../tool/opRedis.php';
require_once './../tool/function.php';
ini_set('date.timezone','Asia/Shanghai');

$dbn = (new MysqlDb())->connMysql();
$opRedis = new opRedis();

$sql = "select * from pushInfo";
$res = $dbn->query($sql);

foreach ($res as $k => $v){

    $opRedis->addList();
}
