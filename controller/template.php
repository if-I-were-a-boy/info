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
        'img' => array("img:even",'src'),
    );
    $src = searchInfo($rules, $rang, $url);
    
    $rules = array(
        'img' => array("img:odd",'src'),
    );
    $src1 = searchInfo($rules, $rang, $url);
    
    $date = ['text' => $text[0]['text'], "src_o"  => $src[0]['src'], "src_t" => $src1[0]['src']];
    return json_encode($date);
}
echo showTemplateHtml();
