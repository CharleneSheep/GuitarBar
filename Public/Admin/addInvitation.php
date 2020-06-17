<?php
//开启session会话
session_start();
//产生表单验证随机字符串
$_SESSION['random'] = uniqid();
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加帖子</title>
    <!-- 引入favicon网站图标 -->
    <link rel="shortcut icon" href="favicon.ico" />
    <!-- 引入Bootstrap文件 -->
    <link rel="stylesheet" href="./lib/css/bootstrap.css">
    <link rel="stylesheet" href="../Home/font/iconfont.css">
    <link rel="stylesheet" href="./css/addInvitation.css">
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
                                <li><a href="./addInvitation.php" style="color:red;">添加帖子</a></li>
                                <li><a href="./alterInvitation.php">帖子管理</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-10 main_right">
                    <div class="content">
                        <form>
                            <table class="table table-striped">
                                <tr>
                                    <td>帖子名: </td>
                                    <td><input type="text" name="inTitle" id="inTitle"></td>
                                    <div class="tip" id="name_tip">
                                        <span>1-20个字符</span>
                                    </div>
                                </tr>
                                <tr>
                                    <td>帖子内容: </td>
                                    <td><textarea name="inContent" cols="70" rows="8" id="inContent"></textarea></td>
                                </tr>
                                <div class="tip" id="content_tip">
                                    <span>1-255个字符</span>
                                </div>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="button" value="添加帖子" id="sub">
                                        <input type="reset" value="重置" id="resetBtn">
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
    </div>
</body>
<script src="./js/jquery-3.5.0.min.js"></script>
<script src="./js/addInvitation.js"></script>

</html>