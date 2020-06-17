<?php
//包含连接数据库的公共文件
require_once("./conn.php");
//验证用户名是否存在
$name = $_GET['username'];
$searchSql = "SELECT * FROM user WHERE name='$name'";
$res = mysqli_query($link, $searchSql);
//获取结果记录数
$num = mysqli_num_rows($res);
//记录数为0说明可用
if ($num == 0) {
    echo 0; //账号可用传回0
} else {
    echo 1; //不可用传回1
}
