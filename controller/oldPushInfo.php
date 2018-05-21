<?php
/**
 * Created by PhpStorm.
 * User: didi
 * Date: 2018/5/21
 * Time: 下午8:26
 */
//根据条件筛选内推消息
require_once "./../index.php";
require_once "./../mysql/mysql.php";


$dbn = (new MysqlDb())->connMysql();
$start = $_GET['start'];
$end = $_GET['start'];

$sql = 'select * from pushInfo where date >= "'.$start.'" and  date <= "'.$end.' order by id desc';
$result = $dbn->query($sql);
$data = $result->fetchAll();

echo json_encode($data);