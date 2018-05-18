<?php
//获取今天最新的内推消息
require_once "./../index.php";
require_once "./../mysql/mysql.php";

$dbn = new MysqlDb();
$date = date("Y-m-d");
$sql = 'select * from pushInfo where date = "'.$date.'"';
$result = $dbn->query($sql);
$data = $result->fetchAll();
$len = count($data);
//return json_encode($date);
var_dump($len);
var_dump($result);
