<?php
//包含链接数据库的公共文件
require_once("../../conn.php");

$id = $_POST['id'];
$typeId = $_POST['typeId'];
$name = $_POST['name'];
$singerId = $_POST['singer'];
$url = $_POST['url'];
$upd = "UPDATE music SET name='" . $name . "',singerId='" . $singerId . "',typeId='" . $typeId . "',musicUrl='" . $url . "' where musicId='" . $id . "'";
if (mysqli_query($link, $upd)) {
    echo 0;
    die();
} else {
    echo 1;
    die();
}
