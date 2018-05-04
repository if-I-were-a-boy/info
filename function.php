<?php
require_once './spider/phpQuery/phpQuery.php';
require_once './spider/QueryList/QueryList.php';
use QL\QueryList;

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

function getTitle(){

    return ;
}

function getTime(){

    return ;
}

function getName(){

    return ;
}

function getDetail($paper){
   $url = "https://www.nowcoder.com".$paper;
    //编写采集规则
    $rules = array(
        'text' => array('.post-topic-des', 'html')
    );
    //列表选择器
    $rang = ".post-topic-des";
    //开始采集
    $data = QueryList::Query($url,$rules,$rang)->data;

    return $data[0]['text'];
}
