<?php
//开启session会话
session_start();
//包含连接数据库的公共文件
require_once("./conn.php");
//判断用户是否登录
if (empty($_SESSION['name'])) {
  //如果用户没有登录，则直接跳转到登录页面
  header("location:./login.php");
  die();
}
$name = $_SESSION['name'];
$sql = "SELECT * FROM collect WHERE userName='$name'";
$result = mysqli_query($link, $sql);
//获取吉他曲条数
$record = mysqli_num_rows($result);
//查询用户头像
// $sqlUser = "SELECT * FROM user where name=$name";
// $resultUser = mysqli_query($link, $sqlUser);
// $user = mysqli_fetch_all($resultUser, MYSQLI_ASSOC);
// $head = $user['headUrl'];
// echo $head;
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>我的收藏</title>
  <!-- 引入favicon网站图标 -->
  <link rel="shortcut icon" href="./Public/Home/favicon.ico" />
  <!-- 引入Bootstrap文件 -->
  <link rel="stylesheet" href="./Public/Home/lib/css/bootstrap.css">
  <link rel="stylesheet" href="./Public/Home/font/iconfont.css">
  <!-- 引入样式文件 -->
  <link rel="stylesheet" href="./Public/Home/css/collect.css">
  <script src="./Public/Home/js/jquery-3.5.0.min.js"></script>
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
              <li><a href="./operas.php">吉他谱</a></li>
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
              <li><a href="./collect.php">我的收藏</a></li>
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
      <div class="container tit">
        <span>我的收藏夹</span>
      </div>
    </div>
  </div>
  <!-- 收藏用户信息部分 -->
  <div class="container">
    <div class="row">
      <div class="container-fluid user">
        <div class="head">
          <img src='./Public/Home/images/userhead1.png' alt="">
        </div>
        <div class="content">
          <span class="userName"><?php echo $name ?></span><br>
          <span class="detail">共收藏<em><?php echo $record ?></em>首喜爱的吉他曲</span>
        </div>
      </div>
      <div class="container-fluid">
        <table class="table table-hover">
          <?php
          while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['musicName'] . "</td>";
            echo "<td><span class='glyphicon glyphicon-play-circle playIcon musicPlayIcon'></span>
            <span class='glyphicon glyphicon-pause pauseIcon musicPauseIcon'></span></td>";
            $id = $row['collectId'];
            echo "<td><a href='javaScript:void(0)' index=$id class='removeBtn'>取消收藏</a></td>";
            echo "</tr>";
          }
          ?>
        </table>
      </div>
    </div>
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
  <script src="./Public/Home/js/collect.js"></script>
</body>

</html>