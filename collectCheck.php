<?php
//开启session会话
session_start();
//包含连接数据库的公共文件
require_once("./conn.php");
//吉他曲编号
$id = $_GET['id'];
//用户名
$name = $_GET['username'];
//吉他曲名
$music = $_GET['music'];
$sql = "SELECT * FROM collect WHERE musicId='$id' AND userName='$name'";
$res = mysqli_query($link, $sql);
$num = mysqli_num_rows($res);
if ($num == 0) {
    //收藏成功
    $insertSql = "INSERT INTO collect(musicId,status,userName,musicName) VALUES('$id',1,'$name','$music')";
    if (mysqli_query($link, $insertSql)) {
        echo 0;
        die();
    }
} else {
    //收藏过了返回1 
    echo 1;
    die();
}
