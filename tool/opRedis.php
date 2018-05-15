<?php
/**
 * Created by PhpStorm.
 * User: didi
 * Date: 2018/5/6
 * Time: 下午2:22
 */

//获取最近一条内推消息的发布时间
class opRedis{

       private $redis = null;

       function __construct(){
        //实例化redis
        $this->redis = new Redis();
        //连接
        $this->redis->connect('127.0.0.1', 6379);
        //检测是否连接成功
        echo "Server is running: " . $this->redis->ping();
        // 输出结果 Server is running: +PONG
    }

    public function addList(){
      //存储数据到列表中
       $this->redis->lpush('list', 'html');
       $redis->lpush('list', 'css');
       $redis->lpush('list', 'php');
       $redis->lpush('list', 'mysql');
       $redis->lpush('list', 'javascript');
       $redis->lpush('list', 'ajax');

        //获取列表中所有的值
        $list = $redis->lrange('list', 0, -1);
        print_r($list);echo '<br>';
    }

    public function addString($str){

        $this->redis->set('mykey',$str);
    }

}
function getLastTime(){

}

//获取今天的最近内推信息
function getLastMessg(){

}