<?php
/**
 * Created by PhpStorm.
 * User: didi
 * Date: 2018/6/12
 * Time: 下午2:47
 */
$username = $_POST['username'];
$password = $_POST['password'];
$data  = ['username' => $username, 'password' => $password];

echo json_encode($data);