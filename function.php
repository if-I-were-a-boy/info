<?php
require_once './spider/phpQuery/phpQuery.php';
require_once './spider/QueryList/QueryList.php';
use QL\QueryList;

ini_set('date.timezone','Asia/Shanghai');

function searchInfo($page, $rules, $rang){
    //获取所有的HTML
    $url="https://www.nowcoder.com/search?type=post&order=time&query=%E5%86%85%E6%8E%A8&page=".$page;
    //编写采集规则
    $rules = $rules;
    //列表选择器
    $rang = $rang;
    //开始采集
    $data = QueryList::Query($url,$rules,$rang)->data;

    return $data[0]['text'];
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
    $type  = ($data[0]['type'] == '[招聘信息]') ? 1 : 0;
    $time =  getTime($data[0]['time']);
    $info = ['title' => $title, 'link' => $link, 'type' => $type, 'enable' => $time];
    return $info;
}

function getTime($str){

    preg_match("/\d{4}-\d{2}-\d{2}/", $str, $s1);

    preg_match("/\d{2}:\d{2}:\d{2}/", $str, $s2);

    $nowdate = date("Y-m-d");

    if(empty($s1[0])) {
        $s = ['time' => $s2[0], 'date' => $nowdate];
    }else{
        $s = ['time' => "00:00:00", 'date' => $s1[0]];
    }

    return $s;
}

//function getName(){
//
//    return ;
//}

//function getType($str){
//
//    return ;
//}

