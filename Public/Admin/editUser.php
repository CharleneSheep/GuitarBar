<?php
//开启session会话
session_start();
//包含链接数据库的公共文件
require_once("../../conn.php");
$id = $_GET['id'];
//执行查询的SQL语句
$sql = "SELECT * FROM user where userId=$id";
$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_array($result)) {
    $name = $row['name'];
    $pwd = $row['password'];
    $sex = $row['sex'];
    $phone = $row['phone'];
    $email = $row['email'];
}
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户管理</title>
    <!-- 引入favicon网站图标 -->
    <link rel="shortcut icon" href="../Home/favicon.ico" />
    <!-- 引入Bootstrap文件 -->
    <link rel="stylesheet" href="./lib/css/bootstrap.css">
    <link rel="stylesheet" href="../Home/font/iconfont.css">
    <!-- 引入样式文件 -->
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/editUser.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="header clearfix">
                <div class="header_tit">后台管理中心</div>
                <div class="header_content">
                    <a href="../../index.php">在线吉他吧 |</a>
                    <?php if (isset($_SESSION['adminName'])) : ?>
                        <span>欢迎,管理员：<?php echo $_SESSION['adminName']; ?></span>
                        <a href="exitAdmin.php" class="exit">退出</a>
                    <?php endif ?>
                </div>
            </div>
            <div class="main">
                <div class="col-lg-2 main_left">
                    <!-- <h3>菜单</h3> -->
                    <ul>
                        <li>
                            用户管理
                            <ul class="box">
                                <li><a href="./addUser.php">添加用户</a></li>
                                <li><a href="./alterUser.php" style="color:red;">用户管理</a></li>
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
                                <li><a href="./alterMusic.php">吉他曲管理</a></li>
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
                                <td>用户名: </td>
                                <td><input type="text" name="name" index=<?php echo $id ?> value=<?php echo $name ?> id="username"></td>
                            </tr>
                            <tr>
                                <td>用户密码: </td>
                                <td><input type="text" name="pwd" disabled="true" value=<?php echo $pwd ?>></td>
                            </tr>
                            <tr>
                                <td>性别: </td>
                                <td><input type="text" name="sex"  id="sex" value=<?php echo $sex ?>></td>
                            </tr>
                            <tr>
                                <td>电话: </td>
                                <td><input type="text" name="phone" value=<?php echo $phone ?> id="phone"></td>
                            </tr>
                            <tr>
                                <td>邮箱: </td>
                                <td><input type="text" name="email" value=<?php echo $email ?> id="email"></td>
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
    <script src="./js/editUser.js"></script>
</body>

</html>