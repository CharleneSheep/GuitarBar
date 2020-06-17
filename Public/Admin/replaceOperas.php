<?php
//包含链接数据库的公共文件
require_once("../../conn.php");
$id = $_GET['id'];
$name = $_GET['name'];
$typeId = $_GET['typeId'];
$url = $_GET['url'];
$upd = "UPDATE opera SET name='" . $name . "',typeId='" . $typeId . "',operaUrl='" . $url . "' WHERE operaId='" . $id . "'";
if (mysqli_query($link, $upd)) {
    echo 0;
    die();
} else {
    echo 1;
    die();
}
