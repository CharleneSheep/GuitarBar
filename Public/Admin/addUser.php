<?php
//开启session会话
session_start();
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加用户</title>
    <!-- 引入favicon网站图标 -->
    <link rel="shortcut icon" href="favicon.ico" />
    <!-- 引入Bootstrap文件 -->
    <link rel="stylesheet" href="./lib/css/bootstrap.css">
    <link rel="stylesheet" href="../Home/font/iconfont.css">
    <link rel="stylesheet" href="./css/addUser.css">
    <script src="./js/jquery-3.5.0.min.js"></script>
    <script src="./js/addUser.js"></script>
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
                                <li><a href="./addUser.php" style="color:red;">添加用户</a></li>
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
                                <li><a href="./alterInvitation.php">帖子管理</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-10 main_right">
                    <div class="content">
                        <form action="./updateUser.php" method="POST">
                            <table class="table table-striped">
                                <tr class="tr">
                                    <td>用户名: </td>
                                    <td><input type="text" name="name" id="username"></td>
                                    <div class="tip" id="name_tip">
                                        <span>4-10位字母/数字/组合</span>
                                    </div>
                                </tr>
                                <tr class="tr">
                                    <td>用户密码: </td>
                                    <td><input type="password" name="pwd" id="pwd"></td>
                                    <div class="tip" id="pwd_tip">
                                        <span>6-16位字母/数字/组合/-/_</span>
                                    </div>
                                </tr>
                                <tr>
                                    <td>性别: </td>
                                    <td></td>
                                    <div class="tip" id="sex_tip">
                                        <span>男/女</span>
                                    </div>
                                </tr>
                                <tr>
                                    <td>手机: </td>
                                    <td><input type="phone" name="phone" id="phone"></td>
                                    <div class="tip" id="phone_tip">
                                        <span>11位数字</span>
                                    </div>
                                </tr>
                                <tr>
                                    <td>邮箱: </td>
                                    <td><input type="email" name="phone" id="email"></td>
                                    <div class="tip" id="email_tip">
                                        <span>@163.com/@qq.com</span>
                                    </div>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="button" value="添加用户" id="sub">
                                        <input type="reset" value="重置" id="resetBtn">
                                    </td>
                                </tr>
                            </table>
                            <div class="sexBox">
                                <input type="radio" name="sex" value="男" checked="checked" class="radioBtn">男
                                <input type="radio" name="sex" value="女" class="radioBtn">女
                            </div>
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

</html>