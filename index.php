<?php
/**
 * 过程:设置HTML=>设置采集规则=>执行采集=>获取采集结果数据
 */
namespace app\index\controller;
require './spider/phpQuery/phpQuery.php';
require './spider/QueryList/QueryList.php';
use QL\QueryList;
header("Content-type:text/html;charset=utf-8");
//获取所有的HTML
$url="https://www.nowcoder.com/search?type=post&query=%E5%86%85%E6%8E%A8";

//编写采集规则
$rules = array(
    'text' => array('.discuss-detail','html'),
);

//列表选择器
$rang = '.module-body';

//开始采集
$data = QueryList::Query($url,$rules,$rang)->data;

print_r($data);


//$hj = QueryList::Query('http://mobile.csdn.net/',array("url"=>array('.unit h1 a','href')));
//$data = $hj->getData(function($x){
//    return $x['url'];
//});
//print_r($data);




//$contents=file_get_contents($url);
//$contents = mb_convert_encoding($contents,'utf-8','gbk');
?>

