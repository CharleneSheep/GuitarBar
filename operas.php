<?php
//开启session会话
session_start();
//包含链接数据库的公共文件
require_once("./conn.php");
//构建查询语句-->查询类型表
$sqlType = "SELECT * FROM operatype ORDER BY typeId";
$resultType = mysqli_query($link, $sqlType);
//获取所有行数据
$arrType = mysqli_fetch_all($resultType, MYSQLI_ASSOC);
//构建查询语句-->按时间查询最新的20条
$sqlOpera = "SELECT * FROM opera ORDER BY uptime LIMIT 20";
$resultOpera = mysqli_query($link, $sqlOpera);
//构建查询语句-->查询类型为2的曲谱
$typeTwo = "SELECT * FROM opera WHERE typeId=2";
$resultTwo = mysqli_query($link, $typeTwo);
//构建查询语句-->查询类型为3的曲谱
$typeThree = "SELECT * FROM opera WHERE typeId=3";
$resultThree = mysqli_query($link, $typeThree);
//构建查询语句-->查询类型为4的曲谱
$typeFour = "SELECT * FROM opera WHERE typeId=4";
$resultFour = mysqli_query($link, $typeFour);
//构建查询语句-->查询类型为5的曲谱
$typeFive = "SELECT * FROM opera WHERE typeId=5";
$resultFive = mysqli_query($link, $typeFive);
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>吉他谱</title>
  <!-- 引入favicon网站图标 -->
  <link rel="shortcut icon" href="./Public/Home/favicon.ico" />
  <!-- 引入Bootstrap文件 -->
  <link rel="stylesheet" href="./Public/Home/lib/css/bootstrap.css">
  <!-- 引入样式文件 -->
  <link rel="stylesheet" href="./Public/Home/css/operas.css">
  <script src="./Public/Home/js/jquery-3.5.0.min.js"></script>
  <script src="./Public/Home/js/operas.js"></script>
</head>

<body>
  <!-- 头部导航部分 -->
  <div class="container-fluid nav">
    <div class="row">
      <nav class="navbar navbar-inverse  my_nav">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <!-- Toggle navigation切换导航 -->
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">吉他吧</a>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li><a href="./index.php">首页</a></li>
              <li><a href="./music.php">吉他曲</a></li>
              <li><a href="./singer.php">歌手</a></li>
              <li class="active"><a href="./operas.php">吉他谱<span class="sr-only">(current)</span></a></li>
              <li><a href="./community.php">社区</a></li>
            </ul>
            <form class="navbar-form navbar-left">
              <div class="form-group">
                <!-- 搜索框部分 -->
                <input type="text" class="form-control" name="search_txt" id="search_txt" placeholder="请输入歌曲名/曲谱类型">
              </div>
              <button type="button" class="btn btn-default" id="search_btn">搜索曲谱</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
              <!-- 导航右侧 -->
              <li><a href="./Public/Admin/AdminLogin.php" data-toggle="modal" data-target=".bs-example-modal-sm">后台管理</a></li>
              <li><a href="./collect.php" data-toggle="modal" data-target=".bs-example-modal-sm">我的收藏</a></li>
              <li id="show_li">
                <?php if (isset($_SESSION['name'])) : ?>
                  <a href="javaScript:void(0)">Hi,<?php echo $_SESSION['name']; ?></a>
                  <ul>
                    <li><a href="exit.php" class="exit">退出</a></li>
                  </ul>
                <?php else : ?>
                  <a href="login.php">登录</a>
                <?php endif ?>
              </li>
              <li class="triangle" id="out_triangle"></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </div>
  <!-- 导航部分结束 -->
  <!-- 次导航部分 -->
  <div class="container-fluid head">
    <div class="row">
      <div class="container navigation">
        <ul class="clearfix">
          <?php
          //循环二维数组
          foreach ($arrType as $type) {
          ?>
            <li><?php echo $type['name'] ?></li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </div>
  <!-- content部分开始 -->
  <div class="container" id="content">
    <ul class="conShow">
      <?php
      while ($row = mysqli_fetch_array($resultOpera)) {
        echo "<li>";
        $id = $row['operaId'];
        echo "<a href=jtpDetail.php?id=$id class='tit'>" . $row['name'] . "</a>";
      }
      ?>
    </ul>
    <ul>
      <!-- arrTwo -->
      <?php
      while ($row = mysqli_fetch_array($resultTwo)) {
        echo "<li>";
        $id = $row['operaId'];
        echo "<a href=jtpDetail.php?id=$id class='tit'>" . $row['name'] . "</a>";
      }
      ?>
    </ul>
    <ul>
      <!-- arrThree -->
      <?php
      while ($row = mysqli_fetch_array($resultThree)) {
        echo "<li>";
        $id = $row['operaId'];
        echo "<a href=jtpDetail.php?id=$id class='tit'>" . $row['name'] . "</a>";
      }
      ?>
    </ul>
    <ul>
      <!-- arrFour -->
      <?php
      while ($row = mysqli_fetch_array($resultFour)) {
        echo "<li>";
        $id = $row['operaId'];
        echo "<a href=jtpDetail.php?id=$id class='tit'>" . $row['name'] . "</a>";
      }
      ?>
    </ul>
    <ul>
      <!-- arrFive -->
      <?php
      while ($row = mysqli_fetch_array($resultFive)) {
        echo "<li>";
        $id = $row['operaId'];
        echo "<a href=jtpDetail.php?id=$id class='tit'>" . $row['name'] . "</a>";
      }
      ?>
    </ul>
  </div>
  <!-- 底部开始 -->
  <div class="container-fluid footer" id="foot">
    <div class="container">
      <div class="foot_content">
        <p class="foot_first"><a href="">服务条款</a> | <a href="">隐私政策</a> | <a href="">联系我们</a> | <a href="">关于我们</a> |
          <a href="">意见反馈</a> |
        </p>
        <p>Guitar公司版权所有©1997-2019××××××××××有限公司运营：闽网文[2019]××××-×××号</p>
        <p>违法和不良信息举报电话：0571-×××××××× 举报邮箱：15359886666@163.com</p>
      </div>
    </div>
  </div>
  <script src="./Public/Home/js/common.js"></script>
</body>

</html>