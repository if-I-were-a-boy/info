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















function getDetail($html_o, $html_t){

    //获取title和link
    $rules = array(
        'title' => array('a:first', 'text'),
        'link'  => array('a:first', 'href')
    );

    //开始采集
    $data = QueryList::Query($html_o,$rules)->data;
    $title = $data[0]['title'];
    $link = $data[0]['link'];
    //获取time和type
    $rules = array(
        'type'  => array('a:odd', 'text'),
        'time'  => array('.feed-tip', 'text')
    );
    //开始采集
    $data = QueryList::Query($html_t,$rules)->data;
    if($data[0]['type'] == '[招聘信息]'){
        $type  = 1;
    }else if($data[0]['type'] == '[笔经面经]'){
        $type = 2;
    }else{
        $type = 0;
    }
    //$type  = ($data[0]['type'] == '[招聘信息]') ? 1 : 0;
    $time =  getTime($data[0]['time']);
    $info = ['title' => $title, 'link' => $link, 'type' => $type,       'time' => $time['time'], 'date'=> $time['date'], 'time_stamp'=>$time['time_stamp']];
    return $info;

}
