<?php
//开启session会话
session_start();
//包含连接数据库的公共文件
require_once("../../conn.php");
//获取表单提交数据
$adminName = $_POST['name']; //用户名
$password = md5($_POST['pwd']); //加密字符串
// 判断用户名和密码与数据库是否一致
$sql = "SELECT * FROM admin WHERE name='$adminName' AND password='$password'";
$result = mysqli_query($link, $sql); //执行SQL语句，并返回给结果集对象
$records = mysqli_num_rows($result); //取回记录数，0为没找到，1为找到了
if (!$records) {
    // 输入有误返回1
    echo 1;
    die();
}
//输入正确返回0
echo 0;
//保存用户信息到SESSION中
$_SESSION['adminName'] = $adminName;
