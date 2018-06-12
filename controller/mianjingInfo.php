<?php
/**
 * Created by PhpStorm.
 * User: didi
 * Date: 2018/5/28
 * Time: 下午4:29
 */
//获取今天最新的内推消息
require_once "./../index.php";
require_once "./../mysql/mysql.php";

$id = $_GET['id'];
$pageNumber = $_GET['pageNumber'];
$inputVal = empty($_GET['inputVal']) ? '' : $_GET['inputVal'];
$start = ($pageNumber-1)*10;

$dbn = (new MysqlDb())->connMysql();
$sql = 'select * from experInfo where company = "'.$id.'" and title like "%'.$inputVal.'%" order by time desc limit '.$start.',10';
$result = $dbn->query($sql);
$data = $result->fetchAll();
if($pageNumber == 1){
$sql = 'select count(*) from experInfo where company = "'.$id.'"  and title like %'.$inputVal.'%  order by time desc';
$result = $dbn->query($sql);
$info = $result->fetch();
$pageSize = ceil($info[0]/10);
$data = ['data' => $data, 'pageSize' => $pageSize];
echo json_encode($data);
}else{
echo json_encode($data);
}
