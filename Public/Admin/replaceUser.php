<?php
//包含链接数据库的公共文件
require_once("../../conn.php");
$id = $_POST['id'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$sex = $_POST['sex'];
$upd = "UPDATE user SET name='" . $name . "',email='" . $email . "',phone='" . $phone . "',sex='" . $sex . "' WHERE userId='" . $id . "'";
if (mysqli_query($link, $upd)) {
    //修改成功返回0
    echo 0;
    die();
} else {
    //修改失败返回1
    echo 1;
    die();
}
