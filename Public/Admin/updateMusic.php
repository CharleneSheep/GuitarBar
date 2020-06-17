<?php
//包含连接数据库的公共代码
require_once('../../conn.php');
$musicName = $_POST['name'];
// $singer = $_POST['singer'];
$typeId = $_POST['typeId'];
$singerId = $_POST['singerId'];
$url = $_POST['url'];
//构建查询语句获取目前的总记录数
$sqlAll = "SELECT * FROM music";
$result = mysqli_query($link, $sqlAll);
//总记录数
$record = mysqli_num_rows($result);
//id值
$id = $record + 3;
//构建插入的sql语句
$sql = "INSERT INTO music(musicId,name,typeId,musicUrl,singerId) VALUES('$id','$musicName','$typeId','$url','$singerId') ";
if (mysqli_query($link, $sql)) {
    echo 0;
    die();
} else {
    echo 1;
    die();
}

