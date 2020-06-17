<?php
//包含连接数据库的公共代码
require_once('../../conn.php');
$name = $_POST['name'];
$pwd = md5($_POST['pwd']);
$sex = $_POST['sex'];
$phone = $_POST['phone'];
$email = $_POST['email'];
//构建查询语句获取目前的总记录数
$sqlAll = "SELECT * FROM user";
$result = mysqli_query($link, $sqlAll);
$record = mysqli_num_rows($result);
$id = $record + 1;
//默认头像路径
$headUrl = './Public/Home/images/userhead1.png';
//构建插入的sql语句
$sql = "INSERT INTO user(userId,name,password,sex,phone,email,headUrl) VALUES('$id','$name','$pwd','$sex','$phone','$email','$headUrl')";
if (mysqli_query($link, $sql)) {
    echo 0;
    die();
} else {
    echo 1;
    die();
}
