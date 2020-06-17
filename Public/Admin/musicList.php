<?php
//开启session会话
session_start();
//包含链接数据库的公共文件
require_once("../../conn.php");
if (isset($_GET['txt'])) {
    $txt = $_GET['txt'];
    $sql = "SELECT music.*,singer.name AS singerName FROM music INNER JOIN singer ON music.singerId = singer.singerId WHERE music.name like '%$txt%'";
    $result = mysqli_query($link, $sql);
    //输入获取的总记录数
    $records = mysqli_num_rows($result);
    $arrs = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>用户管理</title>
  <!-- 引入favicon网站图标 -->
  <link rel="shortcut icon" href="favicon.ico" />
  <!-- 引入Bootstrap文件 -->
  <link rel="stylesheet" href="./lib/css/bootstrap.css">
  <link rel="stylesheet" href="./css/common.css">
  <!-- 引入样式文件 -->
  <link rel="stylesheet" href="./css/alterUser.css">
  <link rel="stylesheet" href="./css/userList.css">
  <script src="./js/jquery-3.5.0.min.js"></script>
  <script src="./js/alterUser.js"></script>
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
                <li><a href="./addInvitation.php">添加帖子</a></li>
                <li><a href="./alterInvitation.php">帖子管理</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <div class="col-lg-10 main_right">
          <div class="search_box">
            <form action="">
              <input type="search" id="searchMusic" name='searchMusic' value="<?php echo $txt ?>">
              <input type="button" value="搜索" placeholder="请输入用户名" id="searchBtn"> 
              <div class="result">
                共有<span><?php echo $records ?></span>条相似记录
            </div>
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
                    <td><?php echo $arr['musicId'] ?></td>
                    <td><?php echo $arr['typeId'] ?></td>
                    <td><?php echo $arr['name'] ?></td>
                    <td><?php echo $arr['singerName'] ?></td>
                    <td><?php echo $arr['musicUrl'] ?></td>
                    <td><a onclick="editMusic(<?php echo $arr['musicId'] ?>)" href="#">修改</a></td>
                    <td><a onclick="confirmDel(<?php echo $arr['musicId'] ?>)" href="#">删除</a></td>
                </tr>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script>
      function editOpera(id) {
                location.href = './editOpera.php?id=' + id;
       }
  </script>

</body>

</html>