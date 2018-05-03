<?php
/**
 * 过程:设置HTML=>设置采集规则=>执行采集=>获取采集结果数据
 */
namespace app\index\controller;
require './spider/phpQuery/phpQuery.php';
require './spider/QueryList/QueryList.php';
use QL\QueryList;
header("Content-type:text/html;charset=utf-8");
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
    $regex="/<div class=\"discuss-main clearfix\".*?>.*?<\/div>/ism";
    if(preg_match_all($regex, $html, $matches)){
        print_r($matches);
    }else{
        echo '0';
    }
    return ;
}

function getTitle(){

}

function getTime(){

}

function getName(){

}




function filterInfo($html){

}


$rules = array(
    'text' => array('.discuss-detail','html'),
);

$rang = '.module-body';

for($i=0;$i<=250;$i++) {
    $html = searchInfo($i,$rules, $rang);
    $info = cutInfo($html);
    foreach ($info as $value) {
        $name  = getName($value);
        $time = getTime($value);
        $url = getUrl($value);

    }

}





//$contents=file_get_contents($url);
//$contents = mb_convert_encoding($contents,'utf-8','gbk');
?>

