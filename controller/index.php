<?php
/**
 * 过程:设置HTML=>设置采集规则=>执行采集=>获取采集结果数据
 */
/*require_once "./../index.php";
require_once TOOL.'function.php';
header("Content-type:text/html;charset=utf-8");

ini_set('date.timezone','Asia/Shanghai');

function showMessg(){

    $rules = array(
        'text' => array('.discuss-detail','html'),
    );

    $rang = '.module-body';
    $allInfo = [];
    $flag = false;
    for($i=0;$i<=0;$i++) {
        //爬取符合条件的html
        if($flag){
            break;
        }
        $html = searchInfo($i,$rules, $rang);
        $info = cutInfo($html);
        foreach ($info['par_o'][0] as $key => $value) {
            $perInfo =  getDetail($info['par_o'][0][$key], $info['par_t'][0][$key]);
//            if($perInfo['enable']['date'] > xx) {
//                $flag = true;
//                break;
//            }
            if(isset($perInfo["type"]) && $perInfo["type"]){
                $allInfo[] = $perInfo;
            }
        }
    }

    $data = ['toal'=>count($allInfo), 'info'=>$allInfo];
    return json_encode($data);
}

  $pushInfo = showMessg();
  echo $pushInfo;
*/
?>

