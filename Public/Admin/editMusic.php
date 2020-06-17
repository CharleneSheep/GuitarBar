<?php
//开启session会话
session_start();
//产生表单验证随机字符串
$_SESSION['random'] = uniqid();
//包含连接数据库的公共文件
require_once("../../conn.php");
$id = $_GET['id'];
//执行查询的SQL语句
$sql = "SELECT music.*,singer.singerId AS singerId FROM music INNER JOIN singer on music.singerId = singer.singerId where musicId=$id";
$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_array($result)) {
    $name = $row['name'];
    $typeId = $row['typeId'];
    $singerId = $row['singerId'];
    $url = $row['musicUrl'];
}
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>吉他曲管理</title>
    <!-- 引入favicon网站图标 -->
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="stylesheet" href="../Home/font/iconfont.css">
    <!-- 引入Bootstrap文件 -->
    <link rel="stylesheet" href="./lib/css/bootstrap.css">
    <!-- 引入样式文件 -->
    <link rel="stylesheet" href="./css/editMusic.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="header clearfix">
                <div class="header_tit">后台管理中心</div>
                <div class="header_content">
                    <a href="#">在线吉他吧 |</a>
                    <?php if (isset($_SESSION['adminName'])) : ?>
                        <span>欢迎,管理员：<?php echo $_SESSION['adminName']; ?></span>
                        <a href="exitAdmin.php" class="exit">退出</a>
                    <?php endif ?>
                </div>
            </div>
            <div class="main">
                <div class="col-lg-2 main_left">
                    <ul>
                        <li>
                            用户管理
                            <ul class="box">
                                <li><a href="./addUser.php">添加用户</a></li>
                                <li><a href="./alterUser.php">用户管理</a></li>
                            </ul>
                        </li>
                        <li>
                            曲谱管理
                            <ul class="box">
                                <li><a href="./addOperas.php">添加曲谱</a></li>
                                <li><a href="./alterOperas.php">曲谱管理</a></li>
                            </ul>
                        </li>
                        <li>
                            吉他曲管理
                            <ul class="box">
                                <li><a href="./addMusic.php">上传吉他曲</a></li>
                                <li><a href="./alterMusic.php" style="color:red;">吉他曲管理</a></li>
                            </ul>
                        </li>
                        <li>
                            帖子管理
                            <ul class="box">
                                <li><a href="./addInvitation.php">添加帖子</a></li>
                                <li><a href="./alterInvitation.php">帖子管理</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-10 main_right">
                    <form>
                        <table class="table table-striped">
                            <tr>
                                <td>吉他曲编号: </td>
                                <td><input type="text" id="id" disabled="false" index=<?php echo $id ?> value=<?php echo $id ?>></td>
                            </tr>
                            <tr>
                                <td>类型编号: </td>
                                <td><input type="text" id="typeId" value=<?php echo $typeId ?>></td>
                            </tr>
                            <tr>
                                <td>吉他曲名: </td>
                                <td><input type="text" id="musicName" value=<?php echo $name ?>></td>
                            </tr>
                            <tr>
                                <td>歌手编号: </td>
                                <td><input type="text" id="singer" value=<?php echo $singerId ?>></td>
                            </tr>
                            <tr>
                                <td>路径: </td>
                                <td><input type="text" id="musicUrl" value=<?php echo $url ?>></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="button" value="修改" id="sub">
                                </td>
                            </tr>
                        </table>
                        <div class="true">
                            <span class="iconfont icon-right"></span>
                            操作成功
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/jquery-3.5.0.min.js"></script>
    <script src="./js/editMusic.js"></script>
</body>

</html>