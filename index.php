<?php
/**
 * 过程:设置HTML=>设置采集规则=>执行采集=>获取采集结果数据
 */
namespace app\index\controller;
require_once  './function.php';
header("Content-type:text/html;charset=utf-8");


$rules = array(
    'text' => array('.discuss-detail','html'),
);

$rang = '.module-body';

for($i=0;$i<=0;$i++) {
    $html = searchInfo($i,$rules, $rang);
    $info = cutInfo($html);
    foreach ($info['par_o'] as $key => $value) {

       $perInfo =  getDetail($info['par_o'][$key], $info['par_t'][$key]);
        echo "4----";
       var_dump($perInfo);
    }

}





//$contents=file_get_contents($url);
//$contents = mb_convert_encoding($contents,'utf-8','gbk');
?>

