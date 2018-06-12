<?php
/**
 * Created by PhpStorm.
 * User: didi
 * Date: 2018/6/12
 * Time: 下午2:47
 */

require_once "./../index.php";
require_once "./../mysql/mysql.php";

$date = date("Y-m-d");
$time = time();

$username = $_POST['username'];
$password = $_POST['password'];

//检测数据库
$dbn = (new MysqlDb())->connMysql();

$sql = 'select * from userInfo where tel = "'.$username.'" order by id desc';

$result = $dbn->query($sql);
$info = $result->fetch();

$data = [];
if(empty($info)) {
    //插入数据库
    $password = md5($password);
    $sql = 'insert into userInfo(tel,`pass`, `date`, `time`) values("'.$username.'","'.$password.'","'.$date.'","'.$time.'")';
    $dbn->exec($sql);
    $data = ['flag' => 'yes'];
}else{
    $data = ['flag' => 'no'];
}
echo json_encode($data);