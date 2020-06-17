<?php
//开启session会话
session_start();
//包含链接数据库的公共文件
require_once("./conn.php");
$sqlSinger = "SELECT * FROM singer ORDER BY singerId LIMIT 10";
$resultSinger = mysqli_query($link, $sqlSinger);
//获取所有行数据
$arrSinger = mysqli_fetch_all($resultSinger, MYSQLI_ASSOC);
$limitMusic = "SELECT * FROM music LIMIT 7";
$resultLimit = mysqli_query($link, $limitMusic);
//获取所有行数据
$arrLimit = mysqli_fetch_all($resultLimit, MYSQLI_ASSOC);
$sqlIni = "SELECT * FROM invitation ORDER BY time LIMIT 5";
$resultIni = mysqli_query($link, $sqlIni);
$arrIni = mysqli_fetch_all($resultIni, MYSQLI_ASSOC);
?>
<!DOCTYPE html><!-- 文档类型声明标签：声明使用HTML5版本来显示网页 -->
<!-- 显示语言 中文，同样可以显示英文 -->
<html lang="zh-CN">

<head>
  <!-- 设置使用utf-8万国码进行编码 -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>在线吉他吧</title>
  <!-- 引入favicon网站图标 -->
  <link rel="shortcut icon" href="./Public/Home/favicon.ico" />
  <!-- 引入Bootstrap文件 -->
  <link rel="stylesheet" href="./Public/Home/lib/css/bootstrap.css">
  <link rel="stylesheet" href="./Public/Home/font/iconfont.css">
  <!-- 引入样式文件 -->
  <link rel="stylesheet" href="./Public/Home/css/index.css">
  <base target='_blank'>
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
              <li class="active"><a href="./index.php">首页<span class="sr-only">(current)</span></a></li>
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
              <button type="button" class=" btn btn-default" id="search_btn">搜索曲谱</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
              <!-- 导航右侧 -->
              <li><a href="./Public/Admin/AdminLogin.php">后台管理</a></li>
              <li><a href="./collect.php" id="collect">我的收藏</a></li>
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
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </div>
  </div>
  <!-- 导航部分结束 -->
  <!-- 轮播部分开始 -->
  <div class="container-fluid Carousel">
    <div class="row clearfix">
      <div class="col-md-12 column">
        <div class="carousel slide" id="carousel-463287">
          <ol class="carousel-indicators">
            <li data-slide-to="0" data-target="#carousel-463287" class="active">
            </li>
            <li data-slide-to="1" data-target="#carousel-463287">
            </li>
            <li data-slide-to="2" data-target="#carousel-463287">
            </li>
          </ol>
          <div class="carousel-inner myCarousel">
            <div class="item  active">
              <a href="jtpDetail.php?id=24"><img alt="" src="./Public/Home/images/cur1.jpg" /></a>
            </div>
            <div class="item">
              <a href="jtpDetail.php?id=13"><img alt="" src="./Public/Home/images/cur2.jpg" /></a>
            </div>
            <div class="item">
              <a href="jtpDetail.php?id=25"><img alt="" src="./Public/Home/images/cur3.jpg" /></a>
            </div>
          </div> <a class="left carousel-control" href="#carousel-463287" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-463287" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- 轮播部分结束 -->
  <!-- 最新吉他谱部分 -->
  <div class="container">
    <div class="row">
      <div class="newGuitar">
        <!-- 标题 -->
        <h3>入驻歌手</h3>
        <div class="newGuitar_content clearfix">
          <ul>
            <?php
            //循环二维数组
            foreach ($arrSinger as $singer) {
            ?>
              <li>
                <a href="#">
                  <img src="<?php echo $singer['singerUrl'] ?>" alt=""><br>
                  <p class="new_tit"><?php echo $singer['name'] ?></p>
                </a>
              </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- 热门吉他曲部分 -->
  <div class="container">
    <div class="row">
      <div class="guitarMusic">
        <!-- 标题 -->
        <h3>最新吉他曲</h3>
        <div class="guitarMusic_content">
          <table class="table table-hover tab">
            <?php
            //循环二维数组
            foreach ($arrLimit as $limit) {
            ?>
              <tr>
                <td><a href=""><?php echo $limit['name'] ?></a></td>
                <td class="music_time"><?php echo $limit['time'] ?></td>
                <td class="music_author"><?php echo $limit['singerName'] ?></td>
                <td>
                  <span class="glyphicon glyphicon-play-circle playIcon musicPlayIcon"></span>
                  <span class="glyphicon glyphicon-pause pauseIcon musicPauseIcon"></span>
                  <audio src="<?php echo $limit['musicUrl'] ?>" class=" music"></audio>
                </td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- 社区帖子部分 -->
  <!-- 热门吉他曲部分 -->
  <div class="container">
    <div class="row">
      <div class="community">
        <!-- 标题 -->
        <div class="community_head">
          <h3>社区帖子</h3>
          <a href="./community.php">更多精彩内容</a>
        </div>
        <div class="community_content clearfix">
          <ul>
            <?php
            //循环二维数组
            foreach ($arrIni as $ini) {
            ?>
              <li>
                <h3><?php echo $ini['name'] ?></h3>
                <p><?php echo $ini['content'] ?></p>
              </li>
            <?php } ?>
          </ul>
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
        <p>Guitar公司版权所有©2019-2020××××××××××有限公司运营：闽网文[2020]××××-×××号</p>
        <p>违法和不良信息举报电话：0571-×××××××× 举报邮箱：15359886666@163.com</p>
      </div>
    </div>
  </div>
  <script src="./Public/Home/js/jquery-3.5.0.min.js"></script>
  <script src="./Public/Home/lib/js/bootstrap.js"></script>
  <script src="./Public/Home/js/common.js"></script>
  <script src="./Public/Home/js/index.js"></script>
</body>

</html>