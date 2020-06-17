<?php
// 开启session会话
session_start();
//产生表单验证随机字符串
// $_SESSION['random'] = uniqid();
//包含链接数据库的公共文件
require_once("../../conn.php");
//查询曲谱类型表
$sql = 'SELECT * FROM musictype';
$result = mysqli_query($link, $sql);
$arrs = mysqli_fetch_all($result, MYSQLI_ASSOC);
//查询singer歌手表
$sqlSinger = 'SELECT * FROM singer';
$res = mysqli_query($link, $sqlSinger);
$arrSinger = mysqli_fetch_all($res, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>上传吉他曲</title>
    <!-- 引入favicon网站图标 -->
    <link rel="shortcut icon" href="favicon.ico" />
    <!-- 引入Bootstrap文件 -->
    <link rel="stylesheet" href="./lib/css/bootstrap.css">
    <link rel="stylesheet" href="../Home/font/iconfont.css">
    <link rel="stylesheet" href="./css/addMusic.css">
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
                                <li><a href="./addMusic.php" style="color:red;">上传吉他曲</a></li>
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
                        <form action="./updateMusic.php" method="POST" enctype="multipart/form-data">
                            <table class="table table-striped">
                                <tr>
                                    <td>歌曲名: </td>
                                    <td><input type="text" name="musicName" id="musicName"></td>
                                    <div class="tip" id="name_tip">
                                        <span>1-20个字符</span>
                                    </div>
                                </tr>
                                <tr>
                                    <td>歌手编号: </td>
                                    <td>
                                        <select name="singerId" id="singerId">
                                        <?php
                                        foreach ($arrSinger as $arr) {
                                        ?>
                                            <option value="<?php echo $arr['singerId']?>"><?php echo $arr['singerId']?></option>
                                        <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>歌手名: </td>
                                    <td>
                                    <select name="singer" id="singer" disabled="true">
                                        <?php
                                        foreach ($arrSinger as $arr) {
                                        ?>
                                            <option value="<?php echo $arr['name']?>"><?php echo $arr['name']?></option>
                                        <?php } ?>
                                        </select>    
                                    <!-- <input type="text" name="singer" id="singer"> -->
                                    </td>
                                </tr>
                                <tr>
                                    <td>类型编号: </td>
                                    <td>
                                        <select name="typeId" id="typeId">
                                        <?php
                                        foreach ($arrs as $arr) {
                                        ?>
                                            <option value="<?php echo $arr['typeId']?>"><?php echo $arr['typeId']?></option>
                                        <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>类型名称: </td>
                                    <td>
                                        <select name="typeName" id="typeName" disabled="false">
                                        <?php
                                        foreach ($arrs as $arr) {
                                        ?>
                                            <option value="<?php echo $arr['name']?>"><?php echo $arr['name']?></option>
                                        <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>上传歌曲: </td>
                                    <td><input type="file" name="musicUrl" id="musicUrl"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="button" value="添加歌曲" id="addBtn">
                                        <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
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
    <script src="./js/jquery-3.5.0.min.js"></script>
    <script src="./js/tools.js"></script>
    <script src="./js/addMusic.js"></script>
</body>

</html>