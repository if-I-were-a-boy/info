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
    $html = searchInfo($rules, $rang, $url); 
    return $html;
}
echo showTemplateHtml();


