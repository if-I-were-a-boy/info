<?php
/**
 * Created by PhpStorm.
 * User: didi
 * Date: 2018/5/18
 * Time: 下午1:20
 */
//获取历史的内推消息
require_once "./../index.php";
require_once "./../mysql/mysql.php";


$dbn = (new MysqlDb())->connMysql();
$date = date("Y-m-d");