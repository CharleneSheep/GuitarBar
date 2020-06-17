<?php
//包含连接数据库的公共代码
require_once('../../conn.php');
//获取地址栏传递的ID
$id = $_GET['id'];
//构建删除的sql语句
$sql = "DELETE FROM invitation WHERE invitId=$id";
//执行sql语句并判断是否成功
if (mysqli_query($link, $sql)) {
    echo 0;
    die();
} else {
    echo 1;
    die();
}
