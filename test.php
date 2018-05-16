<?php
$dbms = "mysql";     //数据库类型
$host = "localhost"; //数据库主机名
$dbName = "gugu";    //使用的数据库
$user = "root";      //数据库连接用户名
$pass= "hpuhq";          //对应的密码
$dsn="$dbms:host=$host;dbname=$dbName";

try {
$dbh = new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')); //初始化一个PDO对象
echo "OK";
    $dbn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbn->query("SET NAMES utf8");
    $str = "你好";
    mb_convert_encoding($str,"UTF-8");
    $sql = 'insert into pushInfo(title,`time`,`date`, detail, enable, expire) values("'.$str.'",1,1,1,1,1)';
    $dbn->exec($sql);
    echo "yes";
} catch (PDOException $e) {
die ("Error!: " . $e->getMessage() . "<br/>");
}
