<?php
/**
 * Created by PhpStorm.
 * User: didi
 * Date: 2018/5/11
 * Time: 下午5:27
 */
$position = [
    'beijing' => '北京',
    'shanghai' => '上海',
    'hangzhou' => '杭州',
    'chengdu' => '成都',
    'shenzhen' => '深圳',
    'xian' => '西安',
    'suzhou' => '苏州',
    'guangzhou' => '广州',
    'nanjing' => '南京',
    'qingdao' => '青岛',
    'dalian' => '大连',
    'wuhan' => '武汉',

];


function getExperInfo($page, $address){
    $url = setUrl($page, $address);
    $info  = execCurl($url);
    if($info['result']){
        $mesg = json_decode($info['data'],true);
        return $mesg;
    }
    return null;

}
function setUrl($page, $address){
    $url = "https://www.nowcoder.com/recommend-intern/list?page=".$page."&address=".urlencode($address);
    return $url;
}
function execCurl($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60); // 60秒超时
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $data = curl_exec($ch);
    $curl_errno = curl_errno($ch);
    $curl_error = curl_error($ch);
    $http_info = curl_getinfo($ch);
    curl_close($ch);
    if($curl_errno > 0 || $http_info['http_code'] != 200){
        return array('result' => false, 'message' => 'HTTP CODE:' . $http_info['http_code'] . '  Error info:' . json_encode($curl_error));
    }
    return array('result' => true, 'data' => $data);
}

$page = 1;
$address = $position['shanghai'];
$info = getExperInfo($page, $address);




