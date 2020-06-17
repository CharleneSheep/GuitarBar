<?php
//开启session会话
session_start();
//包含链接数据库的公共文件
require_once("../../conn.php");
$id = $_GET['id'];
//执行查询的SQL语句
$sql = "SELECT * FROM invitation where invitId=$id";
$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_array($result)) {
    $name = $row['name'];
    $content = $row['content'];
    $u_Id = $row['u_Id'];
}
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>帖子编辑</title>
    <!-- 引入favicon网站图标 -->
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="stylesheet" href="../Home/font/iconfont.css">
    <!-- 引入Bootstrap文件 -->
    <link rel="stylesheet" href="./lib/css/bootstrap.css">
    <!-- 引入样式文件 -->
    <link rel="stylesheet" href="./css/editInvitation.css">
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
                    <!-- <h3>菜单</h3> -->
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
                                <li><a href="./alterMusic.php">吉他曲管理</a></li>
                            </ul>
                        </li>
                        <li>
                            帖子管理
                            <ul class="box">
                                <li><a href="./addInvitation.php">添加帖子</a></li>
                                <li><a href="./alterInvitation.php" style="color:red;">帖子管理</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-10 main_right">
                    <form>
                        <table class="table table-striped">
                            <tr>
                                <td>帖子编号: </td>
                                <td><input type="text" id="id" index=<?php echo $id ?> disabled="false" value=<?php echo $id ?>></td>
                            </tr>
                            <tr>
                                <td>帖子名: </td>
                                <td><input type="text" id="name" value=<?php echo $name ?>></td>
                            </tr>
                            <tr>
                                <td>帖子内容: </td>
                                <td><textarea id="content" cols="100" rows="7"><?php echo $content ?></textarea></td>
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
</body>
<script src="./js/jquery-3.5.0.min.js"></script>
<script src="./js/editInvitation.js"></script>

</html>