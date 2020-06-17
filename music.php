<?php
//开启session会话
session_start();
//包含链接数据库的公共文件
require_once("./conn.php");
//执行查询的SQL语句
//查询类型表
$sqlType = "SELECT * FROM musictype ORDER BY typeId";
$resultType = mysqli_query($link, $sqlType);
//获取所有行数据
$arrType = mysqli_fetch_all($resultType, MYSQLI_ASSOC);
$sqlMusic = "SELECT music.musicId,music.name,music.musicUrl,singer.name AS singerName,singer.singerUrl FROM music,singer WHERE music.singerId = singer.singerId ORDER BY uptime LIMIT 7";
$resultMusic = mysqli_query($link, $sqlMusic);

//查询歌手表
$sqlSinger = "SELECT * FROM singer ORDER BY singerId LIMIT 10";
$resultSinger = mysqli_query($link, $sqlSinger);
//获取所有行数据
$arrSinger = mysqli_fetch_all($resultSinger, MYSQLI_ASSOC);
//构建查询语句-->查询类型为2的吉他曲
$typeTwo = "SELECT music.*,singer.name AS singerName,singer.singerUrl FROM music INNER JOIN singer ON music.singerId=singer.singerId  WHERE music.typeId=2";
$resultTwo = mysqli_query($link, $typeTwo);
//构建查询语句-->查询类型为3的吉他曲
$typeThree = "SELECT music.*,singer.name AS singerName,singer.singerUrl FROM music INNER JOIN singer ON music.singerId=singer.singerId  WHERE music.typeId=3";
$resultThree = mysqli_query($link, $typeThree);
//构建查询语句-->查询类型为4的吉他曲
$typeFour = "SELECT music.*,singer.name AS singerName,singer.singerUrl FROM music INNER JOIN singer ON music.singerId=singer.singerId  WHERE music.typeId=4";
$resultFour = mysqli_query($link, $typeFour);
//构建查询语句-->查询类型为5的吉他曲
$typeFive = "SELECT music.*,singer.name AS singerName,singer.singerUrl FROM music INNER JOIN singer ON music.singerId=singer.singerId  WHERE music.typeId=5";
$resultFive = mysqli_query($link, $typeFive);
?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>吉他曲</title>
  <!-- 引入favicon网站图标 -->
  <link rel="shortcut icon" href="./Public/Home/favicon.ico" />
  <!-- 引入Bootstrap文件 -->
  <link rel="stylesheet" href="./Public/Home/lib/css/bootstrap.css">
  <link rel="stylesheet" href="./Public/Home/css/music.css">
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
              <li class="active"><a href="./music.php">吉他曲<span class="sr-only">(current)</span></a></li>
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
  <!-- 主体部分 -->
  <div class="container">
    <div class="row">
      <div class="music_content">
        <!-- 上面推荐歌手部分 -->
        <div class="singer">
          <div class="singer_tit clearfix">
            <h3>推荐歌手</h3>
            <span><a href="./singer.php">更多<span class="iconfont icon-jiantouarrow487"></span></a></span>
          </div>
          <div class="singer_content">
            <ul class="clearfix">
              <?php
              //循环二维数组
              foreach ($arrSinger as $singer) {
              ?>
                <li>
                  <a href="#">
                    <img src="<?php echo $singer['singerUrl'] ?>" alt="">
                    <em><?php echo $singer['name'] ?></em>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </div>
        </div>
        <!-- 吉他曲部分 -->
        <div class="music">
          <div class="music_tit clearfix">
            <h3>吉他单曲</h3>
          </div>
          <div class="music_content">
            <ul class="conShow">
              <?php
              if (isset($_SESSION['name'])) {
                /* 判断用户是否登录 传给自定义属性loginSession */
                $name = $_SESSION['name'];
              } else {
                $name = 0;
              }
              while ($row = mysqli_fetch_array($resultMusic)) {
                echo "<li class='clearfix'>
                <a href='javaScript:void(0)'>
                <div class='singerHead'>";
                $singerUrl = $row['singerUrl'];
                echo  " <img src='$singerUrl'>";
                echo " </div>";
                echo "    <div class='music_main'>";
                echo "      <h3>" . $row['name'] . " </h3>";
                echo "      <em>" . $row['singerName'] . "</em>";
                echo "    </div>";
                $id = $row['musicId'];
                $music = $row['name'];
                $musicUrl = $row['musicUrl'];
                $url = md5($row['musicUrl']); //对路径进行md5加密-->32位的字符串(隐藏真实的下载地址)
                echo "<span class='glyphicon glyphicon-pause pauseIcon musicPauseIcon' title='暂停'></span>
                      <span class='glyphicon  glyphicon musicPlayIcon playIcon glyphicon-play-circle ' title='播放'></span>
                      <a href='javaScript:void(0)' index='$id' class='downBtn'><span class='glyphicon  glyphicon glyphicon glyphicon-download-alt ' title='下载'></span></a>";
                echo "<a href='javaScript:void(0)' loginSession='$name' music='$music' index='$id' class ='collectBtn'><span class='glyphicon glyphicon glyphicon-heart like' title='收藏'></span></a>";
                echo "  </a>";
                echo "<audio src='$musicUrl' class='musicAudio'></audio>";
                "</li>";
              }
              ?>
            </ul>
            <!-- arrTwo -->
            <ul>
              <?php
              if (isset($_SESSION['name'])) {
                $name = $_SESSION['name'];
              } else {
                $name = 0;
              }
              while ($row = mysqli_fetch_array($resultTwo)) {
                echo "<li class='clearfix'>
                <a href='javaScript:void(0)'>
                <div class='singerHead'>";
                $singerUrl = $row['singerUrl'];
                echo  " <img src='$singerUrl'>";
                echo " </div>";
                echo "    <div class='music_main'>";
                echo "      <h3>" . $row['name'] . " </h3>";
                echo "      <em>" . $row['singerName'] . "</em>";
                echo "    </div>";
                $id = $row['musicId'];
                $music = $row['name'];
                $musicUrl = $row['musicUrl'];
                echo "<span class='glyphicon glyphicon-pause pauseIcon musicPauseIcon' title='暂停'></span>
                <span class='glyphicon  glyphicon musicPlayIcon playIcon glyphicon-play-circle ' title='播放'></span>
                <a href='javaScript:void(0)' index='$id' class='downBtn'><span class='glyphicon  glyphicon glyphicon glyphicon-download-alt ' title='下载'></span></a>";
                echo "    <a href='javaScript:void(0)' loginSession='$name' music='$music'  index='$id' class ='collectBtn'><span class='glyphicon glyphicon glyphicon-heart like' title='收藏'></span></a>";
                echo "  </a>";
                echo "<audio src='$musicUrl' class='musicAudio'></audio>";
                "</li>";
              }
              ?>
            </ul>
            <ul>
              <?php
              if (isset($_SESSION['name'])) {
                $name = $_SESSION['name'];
              } else {
                $name = 0;
              }
              while ($row = mysqli_fetch_array($resultThree)) {
                echo "<li class='clearfix'>
                <a href='javaScript:void(0)'>
                <div class='singerHead'>";
                $singerUrl = $row['singerUrl'];
                echo  " <img src='$singerUrl'>";
                echo " </div>";
                echo "    <div class='music_main'>";
                echo "      <h3>" . $row['name'] . " </h3>";
                echo "      <em>" . $row['singerName'] . "</em>";
                echo "    </div>";
                $id = $row['musicId'];
                $music = $row['name'];
                $musicUrl = $row['musicUrl'];
                echo "<span class='glyphicon glyphicon-pause pauseIcon musicPauseIcon' title='暂停'></span>
                <span class='glyphicon  glyphicon musicPlayIcon  playIcon glyphicon-play-circle ' title='播放'></span>
                <a href='javaScript:void(0)' index='$id' class='downBtn'><span class='glyphicon  glyphicon glyphicon glyphicon-download-alt ' title='下载'></span></a>";
                echo "<a href='javaScript:void(0)' loginSession='$name' music='$music' index='$id' class ='collectBtn'><span class='glyphicon glyphicon glyphicon-heart like' title='收藏'></span></a>";
                echo "</a>";
                echo "<audio src='$musicUrl' class='musicAudio'></audio>";
                "</li>";
              }
              ?>
            </ul>
            <ul>
              <!--    吉他改编模块  -->
              <?php
              if (isset($_SESSION['name'])) {
                $name = $_SESSION['name'];
              } else {
                $name = 0;
              }
              while ($row = mysqli_fetch_array($resultFour)) {
                echo "<li class='clearfix'>
                <a href='javaScript:void(0)'>
                <div class='singerHead'>";
                $singerUrl = $row['singerUrl'];
                echo  " <img src='$singerUrl'>";
                echo " </div>";
                echo "    <div class='music_main'>";
                echo "      <h3>" . $row['name'] . " </h3>";
                echo "      <em>" . $row['singerName'] . "</em>";
                echo "    </div>";
                $id = $row['musicId'];
                $music = $row['name'];
                $musicUrl = $row['musicUrl'];
                echo "<span class='glyphicon glyphicon-pause pauseIcon musicPauseIcon' title='暂停'></span>
                      <span class='glyphicon  glyphicon playIcon musicPlayIcon glyphicon-play-circle ' title='播放'></span>
                      <a href='javaScript:void(0)' index='$id' class='downBtn'><span class='glyphicon  glyphicon glyphicon glyphicon-download-alt ' title='下载' ></span></a>";
                echo "<a href='javaScript:void(0)' loginSession='$name' music='$music' index='$id' class ='collectBtn'><span class='glyphicon glyphicon glyphicon-heart like' title='收藏'></span></a>";
                echo "  </a>";
                echo "<audio src='$musicUrl' class='musicAudio'></audio>";
                "</li>";
              }
              ?>
            </ul>
            <ul>
              <!-- 原唱版模块 -->
              <?php
              if (isset($_SESSION['name'])) {
                $name = $_SESSION['name'];
              } else {
                $name = 0;
              }
              while ($row = mysqli_fetch_array($resultFive)) {
                echo "<li class='clearfix'>
                <a href='javaScript:void(0)'>
                <div class='singerHead'>";
                $singerUrl = $row['singerUrl'];
                echo "<img src='$singerUrl'>";
                echo "</div>";
                echo "<div class='music_main'>";
                echo "<h3>" . $row['name'] . " </h3>";
                echo "<em>" . $row['singerName'] . "</em>";
                echo " </div>";
                $id = $row['musicId'];
                $music = $row['name'];
                $musicUrl = $row['musicUrl'];
                echo "<span class='glyphicon glyphicon-pause pauseIcon musicPauseIcon' title='暂停'></span>
                <span class='glyphicon  glyphicon playIcon musicPlayIcon glyphicon-play-circle ' title='播放'></span>
                <a href='javaScript:void(0)' index='$id' class='downBtn'><span class='glyphicon  glyphicon glyphicon glyphicon-download-alt ' title='下载'></span></a>";
                echo "<a href='javaScript:void(0)' loginSession='$name' music='$music' index='$id' class ='collectBtn'><span class='glyphicon glyphicon glyphicon-heart like' title='收藏'></span></a>";
                echo "</a>";
                echo "<audio src='$musicUrl' class='musicAudio'></audio>";
                "</li>";
              }
              ?>
            </ul>
          </div>
        </div>
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
  <!-- 引入jQuery文件 -->
  <script src="./Public/Home/js/jquery-3.5.0.min.js"></script>
  <!-- 引入本页面的js文件 -->
  <script src="./Public/Home/js/music.js"></script>
  <script src="./Public/Home/js/common.js"></script>
</body>

</html>