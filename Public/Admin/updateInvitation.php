<?php
//包含连接数据库的公共文件
require_once("../../conn.php");
//获取表单提交数据
$inTitle = $_POST['inTitle'];
$inContent = $_POST['inContent'];
$sql = "INSERT INTO invitation(name,content) VALUES('$inTitle','$inContent')";
if (mysqli_query($link, $sql)) {
    echo 0;
    die();
} else {
    echo 1;
    die();
}
