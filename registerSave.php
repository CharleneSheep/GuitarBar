<?php
//包含连接数据库的公共文件
require_once("./conn.php");
//开启session会话
session_start();
//获取表单提交数据
$name = $_POST['name']; //用户名
$password = md5($_POST['pwd']); //加密密码
//创建默认头像地址作为新用户默认头像
$url = './Public/Home/images/userhead1.png';
//构建插入的sql语句
$sql = "INSERT INTO user(name,password,headUrl) VALUES('$name','$password','$url')";
if (mysqli_query($link, $sql)) {
    //注册成功
    echo 0;
    die();
} else {
    //失败返回1
    echo 1;
    die();
}
