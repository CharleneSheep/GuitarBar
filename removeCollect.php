<?php
//包含连接数据库的公共文件
require_once("./conn.php");
//获取GET方式传过来的id值
$id = $_GET['id'];
$sqlDel = "DELETE FROM collect WHERE collectId=$id";
if (mysqli_query($link, $sqlDel)) {
    //操作成功返回0
    echo 0;
    die();
} else {
    echo 1;
    die();
}
