<?php
//开启session会话
session_start();
//包含链接数据库的公共文件
require_once("../../conn.php");
//查询曲谱类型表
$sql = 'SELECT * FROM operatype';
$result = mysqli_query($link, $sql);
$arrs = mysqli_fetch_all($result, MYSQLI_ASSOC);
//产生表单验证随机字符串
$_SESSION['random'] = uniqid();

?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加曲谱</title>
    <!-- 引入favicon网站图标 -->
    <link rel="shortcut icon" href="favicon.ico" />
    <!-- 引入Bootstrap文件 -->
    <link rel="stylesheet" href="./lib/css/bootstrap.css">
    <link rel="stylesheet" href="../Home/font/iconfont.css">
    <link rel="stylesheet" href="./css/addOperas.css">
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
                                <li><a href="./addOperas.php" style="color:red;">添加曲谱</a></li>
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
                        <form>
                            <table class="table table-striped">
                                <tr>
                                    <td>曲谱名: </td>
                                    <td><input type="text" name="operaName" id="operaName"></td>
                                    <div class="tip" id="name_tip">
                                        <span>1-20个字符且谱名需用书名号《》</span>
                                    </div>
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
                                    <td>类型: </td>
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
                                    <td>上传曲谱图片: </td>
                                    <td>
                                        <input type="file" name="uploadFile" id="operaFile">
                                        <div class="pic"><img src="" alt=""></div>
                                    </td>
                                    <div class="tip" id="pic_tip">
                                        <span>jpg/png/jpeg/gif/bmp</span>
                                    </div>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <div class='img'>
                                            <img src="" alt="">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="button" value="添加曲谱" id="add">
                                        <input type="reset" value="重置" id="resetBtn">
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <div class="true">
                            <span class="iconfont icon-right"></span>
                            操作成功
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/jquery-3.5.0.min.js"></script>
    <script src="./js/addOpera.js"></script>
</body>

</html>