<?php
/**
 * Created by PhpStorm.
 * User: didi
 * Date: 2018/5/18
 * Time: 下午1:36
 */
require_once "./../index.php";
require_once TOOL.'function.php';

function showTemplateHtml(){
    $rules = array(
        'text' => array('.post-topic-des','text'),
    );
    $id = $_GET['id'];
    $rang = '.post-topic-main';
    $url ="https://www.nowcoder.com".$id;
    $text = searchInfo($rules, $rang, $url);

    $rules = array(
        'src' => array('img','src'),
    );
    $rang = '.post-topic-des';
    $src = searchInfo($rules, $rang, $url);
    $date = ['text' => $text, $src => $src];
    return json_encode($date);
}
echo showTemplateHtml();


