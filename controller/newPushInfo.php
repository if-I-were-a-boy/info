<?php
//获取今天最新的内推消息
require_once "./../index.php";
require_once "./../mysql/mysql.php";


$dbn = (new MysqlDb())->connMysql();
$date = date("Y-m-d");
$sql = 'select * from pushInfo where date = "'.$date.'" order by id desc';
$result = $dbn->query($sql);
$data = $result->fetchAll();

echo json_encode($data);
