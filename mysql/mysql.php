<?php
/**
 * Created by PhpStorm.
 * User: didi
 * Date: 2018/5/15
 * Time: 下午5:08
 */
class MysqlDb{
    const info = array(
        'dbms' => 'mysql',
        'database' => 'gugu',
        'table' => 'pushInfo',
        'user' => 'root',
        'password' => 'hpuhq',
        'charset' => 'utf-8',
        'host' => 'localhost',

    );
    public function connMysql(){
        $dbInfo = self::info;
        $dbms = $dbInfo['dbms'];     //数据库类型
        $host = $dbInfo['host']; //数据库主机名
        $dbName = $dbInfo['database'];    //使用的数据库
        $user = $dbInfo['user'];      //数据库连接用户名
        $pass= $dbInfo['password'];          //对应的密码
        $dsn="$dbms:host=$host;dbname=$dbName";

        try {
            $dbh = new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')); //初始化一个PDO对象
            return $dbh;
            /*你还可以进行一次搜索操作
            foreach ($dbh->query('SELECT * from FOO') as $row) {
                print_r($row); //你可以用 echo($GLOBAL); 来看到这些值
            }
            */
        } catch (PDOException $e) {
            die ("Error!: " . $e->getMessage() . "<br/>");
        }
    }
}
