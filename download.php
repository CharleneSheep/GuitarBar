<?php
//包含链接数据库的公共文件
require_once("./conn.php");
//获取传递过来的编号进行查找数据库中的真实地址
$id = $_GET['id'];
$sql = "SELECT * FROM music WHERE musicId=$id";
$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_array($result)) {
    $url = $row['musicUrl']; //真实的路径地址
    $name = $row['name']; //真实的吉他曲名
}
//声明显示的格式(告诉浏览器内容的类型-->8位的二进制流的格式)
header("Content-Type:application/octet-stream");
//告诉浏览器 数据的处理方式-->以附件的方式保存(弹出另存框)
header("Content-Disposition:attachment;filename=$name.mp3");
//只读方式打开文件(用二进制形式传给客户端)
$handle = fopen($url, 'rb');
//从文件资源中循环取数据 1024-->1kb 1kb取
while ($str = fread($handle, 1024)) {
    echo $str; //发送客户端(一边取一边输出给客户端)
}
