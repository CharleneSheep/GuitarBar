<?php
//包含链接数据库的公共文件
require_once("./conn.php");
//获取ajax用GET方式传过来的数据
$name = $_GET['name'];
$tit = $_GET['title'];
$txt = $_GET['txt'];
$time = $_GET['time'];
$headUrl = './Public/Home/images/userhead1.png';
//插入数据
$sqlData = "INSERT INTO invitation(userName,name,content,time,headUrl) VALUES('$name','$tit','$txt','$time','$headUrl') ";
if (mysqli_query($link, $sqlData)) {
    // 查询新增帖子成功的话返回0
    echo 0;
    die();
}else{
    echo 1;
    die();
}
