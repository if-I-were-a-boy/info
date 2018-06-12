<?php
/**
 * Created by PhpStorm.
 * User: didi
 * Date: 2018/6/12
 * Time: 下午5:17
 */

require_once "./../index.php";
require_once "./../mysql/mysql.php";


$username = $_POST['username'];
$password = $_POST['password'];
$password = md5($password);
//检测数据库
$dbn = (new MysqlDb())->connMysql();

$sql = 'select id,tel from userInfo where tel = "'.$username.'" and pass = "'.$password.'"  order by id desc';

$result = $dbn->query($sql);
$info = $result->fetch();
$data = [];

if(!empty($info)) {
    $id = $info['id'];
    $tel = $info['tel'];
    $data = ['flag' => 'yes','id' => $id, 'tel' => $tel];
}else{
    $data = ['flag' => 'no'];
}
echo json_encode($data);