<?php
/**
 * Created by PhpStorm.
 * User: didi
 * Date: 2018/5/28
 * Time: 下午4:29
 */
//获取今天最新的内推消息
require_once "./../index.php";
require_once "./../mysql/mysql.php";

$id = $_GET['id'];
$dbn = (new MysqlDb())->connMysql();
$sql = 'select * from experInfo where company = "'.$id.'" order by time desc limit 20';
$result = $dbn->query($sql);
$data = $result->fetchAll();

echo json_encode($data);