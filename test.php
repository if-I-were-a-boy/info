<?php
require_once './mysql/mysql.php';
require_once './tool/opRedis.php';
ini_set('date.timezone','Asia/Shanghai');

$dbn = (new MysqlDb())->connMysql();
//$redis = new opRedis();
$redis = new redis();  
$redis->connect('127.0.0.1', 6379);  
$sql = "select * from pushInfo";
$res = $dbn->query($sql);
while($row = $res->fetch()){
  $id = $row['id'];
  $s = "pustInfo";
  $redis->lPush($s,$id);
//$s = 'pushInfo/'.$id;
//  $redis -> expire($s,3600*24);
//  $redis->hset($s,'title',$row['title']); 
 // $redis->hset($s,'time',$row['time']);
  //$redis->hset($s,'date',$row['date']);
 // $redis->hset($s,'detail',$row['detail']);
 // $redis->hset($s,'enable',$row['enable']);
 // $redis->hset($s,'expire',$row['expire']);
 // $redis->hset($s,'title',$row['title']);
}
         $redis -> expire("pustInfo",3600*24);
