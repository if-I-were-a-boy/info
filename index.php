<?php
/**
 * 过程:设置HTML=>设置采集规则=>执行采集=>获取采集结果数据
 */
namespace app\index\controller;
use QL\QueryList;
require './vendor/autoload.php';
require './vendor/jaeger/querylist/src/QueryList.php';

//获取所有的HTML
header("Content-type:text/html;charset=utf-8");
$url="https://www.nowcoder.com/search?type=post&query=%E5%86%85%E6%8E%A8";
//$contents=file_get_contents($url);
//$contents = mb_convert_encoding($contents,'utf-8','gbk');

//编写采集规则
$rules = array(
 'title' => ['.discuss-main clearfix','href'],
);
//列表选择器
$rang = '.module-body>li';
//开始采集
$data = QueryList::Query($url,$rules,$rang)->data;
echo "haha";var_dump($data);
?>

