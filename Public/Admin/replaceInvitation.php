<?php
//包含链接数据库的公共文件
require_once("../../conn.php");
$id = $_POST['id'];
$name = $_POST['name'];
$content = $_POST['content'];
$upd = "UPDATE invitation SET name='" . $name . "',content='" . $content . "' where invitId='" . $id . "'";
if (mysqli_query($link, $upd)) {
    echo 0;
    die();
} else {
    echo 1;
    die();
}
