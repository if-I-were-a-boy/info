<?php
require_once "./../index.php";
require_once SPIDER.'phpQuery/phpQuery.php';
require_once SPIDER.'QueryList/QueryList.php';
use QL\QueryList;
header("Content-type:text/html;charset=utf-8");
ini_set('date.timezone','Asia/Shanghai');

function searchInfo($rules, $rang, $url){

    //开始采集
    $data = QueryList::Query($url,$rules,$rang)->data;
    return $data;

}

function cutInfo($html){
    $regex1="/<div class=\"discuss-main clearfix\".*?>.*?<\/div>/ism";
    $regex2 = "/<p class=\"feed-tip\".*?>.*?<\/p>/ism";

    preg_match_all($regex1, $html, $matche1);
    preg_match_all($regex2, $html, $matche2);

    $matches = array('par_o' => $matche1, 'par_t' => $matche2);

    return $matches;
}

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
    $info = ['title' => $title, 'link' => $link, 'type' => $type, 'time' => $time['time'], 'date'=> $time['date'], 'time_stamp'=>$time['time_stamp']];
    return $info;
}

function getTime($str){

    preg_match("/\d{4}-\d{2}-\d{2}/", $str, $s1);

    preg_match("/\d{2}:\d{2}:\d{2}/", $str, $s2);

    $nowdate = date("Y-m-d");

    if(empty($s1[0])) {
        $str = $nowdate." ".$s2[0];
        $timeStamp = strtotime($str);
        $s = ['time' => $s2[0], 'date' => $nowdate, 'time_stamp' => $timeStamp];

    }else{
        $str = $s1[0]." 00:00:00";
        $timeStamp = strtotime($str);
        $s = ['time' => "00:00:00", 'date' => $s1[0], 'time_stamp' => $timeStamp];
    }

    return $s;
}
