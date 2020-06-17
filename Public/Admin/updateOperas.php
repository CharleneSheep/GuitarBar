<?php
//包含连接数据库的文件
require_once('../../conn.php');
//4、移动图片到images目录中
// $tmp_name = $_FILES['uploadFile']['tmp_name'];
// $dst_name = "../Admin/images/" . uniqid() . "." . $ext;
// move_uploaded_file($tmp_name, $dst_name);
//1、获取GET方式传过来的数据
$operaName = $_POST['operaName'];
$typeId = $_POST['typeId'];
$operaFile = $_POST['operaFile'];
$time = $_POST['time'];
// 2、判断记录是否添加成功
//创建sql语句
$sql = "INSERT INTO opera(typeId,name,uptime,operaUrl) VALUES('$typeId','$operaName','$time','$operaFile')";
if (mysqli_query($link, $sql)) {
    echo 0;
    die();
} else {
    echo 1;
    die();
}
