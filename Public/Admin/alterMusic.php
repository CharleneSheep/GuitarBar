<?php
// 开启session会话
session_start();
//包含链接数据库的公共文件
require_once("../../conn.php");
//定义每一页显示的条数
$pageSize = 7;
//执行查询的SQL语句(inner join    on:内连接，查询多个表中建立关联字段值相等的记录)
$sql = "SELECT music.*,singer.name AS singerName FROM music INNER JOIN singer on music.singerId = singer.singerId ";
$result = mysqli_query($link, $sql);
$arr1 = mysqli_fetch_all($result, MYSQLI_ASSOC);
//从查询的结果集对象中取总吉他曲条数
$records = mysqli_num_rows($result);
//计算总页数
$pages = ceil($records / $pageSize);
//判断用户有没有单击页码没有的话设置默认为第一页
$page = isset($_GET['page']) ? $_GET['page'] : 1; //当前页码
//设置开始的行号
$startRow = ($page - 1) * $pageSize;
//构建查找分页数据的sql语句
$sql .= " ORDER BY musicId  LIMIT {$startRow},{$pageSize}";
//执行sqlPage语句,并返回结果集对象
$result = mysqli_query($link, $sql);
$arrs = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>吉他曲管理</title>
    <!-- 引入favicon网站图标 -->
    <link rel="shortcut icon" href="favicon.ico" />
    <!-- 引入Bootstrap文件 -->
    <link rel="stylesheet" href="./lib/css/bootstrap.css">
    <link rel="stylesheet" href="./css/common.css">
    <!-- 引入样式文件 -->
    <link rel="stylesheet" href="./css/alterMusic.css">
    <script src="./js/jquery-3.5.0.min.js"></script>
    <script src="./js/alterMusic.js"></script>
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
                    <div class="search_box">
                        <form action="">
                            <input type="search" name='searchMusic' id="searchMusic">
                            <input type="button" value="搜索" id="searchBtn">
                        </form>
                    </div>
                    <table class="table table-hover">
                        <tr>
                            <th>编号</th>
                            <th>类型编号</th>
                            <th>吉他曲名</th>
                            <th>歌手</th>
                            <th>路径</th>
                            <th>操作</th>
                            <th>操作</th>
                        </tr>
                        <?php
                        foreach ($arrs as $arr) {
                        ?>
                           
                            <tr>
                                <td><?php echo $arr['musicId'] - 1 ?></td>
                                <td><?php echo $arr['typeId'] ?></td>
                                <td><?php echo $arr['name'] ?></td>
                                <td><?php echo $arr['singerName'] ?></td>
                                <td><?php echo $arr['musicUrl'] ?></td>
                                <td><a onclick="editMusic(<?php echo $arr['musicId'] ?>)" href="#">修改</a></td>
                                <td><a onclick="confirmDel(<?php echo $arr['musicId'] ?>)" href="#">删除</a></td>
                            </tr>
                        <?php } ?>
                    </table>
                    <!-- 分页按钮 -->
                    <div class="page ">
                        <ul class="clearfix">
                            <?php
                            for ($i = 1; $i <= $pages; $i++) {
                                echo " <li><a href='?page=$i'>$i</a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function editMusic(id) {
            location.href = './editMusic.php?id=' + id; //get请求  除了表单发送的请求都是get请求
        }
    </script>
</body>

</html>