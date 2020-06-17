<?php
//开启session会话
session_start();
//包含链接数据库的公共文件
require_once("./conn.php");
//查询歌手表
$sqlSinger = "SELECT * FROM singer ORDER BY singerId";
$resultSinger = mysqli_query($link, $sqlSinger);
//获取所有行数据
$arrSinger = mysqli_fetch_all($resultSinger, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>歌手</title>
  <!-- 引入favicon网站图标 -->
  <link rel="shortcut icon" href="./Public/Home/favicon.ico" />
  <!-- 引入Bootstrap文件 -->
  <link rel="stylesheet" href="./Public/Home/lib/css/bootstrap.css">
  <!-- 引入样式文件 -->
  <link rel="stylesheet" href="./Public/Home/css/base.css">
  <link rel="stylesheet" href="./Public/Home/css/common.css">
  <link rel="stylesheet" href="./Public/Home/css/singer.css">
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
              <li><a href="./music.php ">吉他曲</a></li>
              <li class="active"><a href="./singer.php">歌手<span class="sr-only">(current)</span></a></li>
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
  <!-- 背景开始 -->
  <div class="container-fluid bg_content">
    <img src="./Public/Home/images/bg_singer.jpg" alt="">
    <h2 class="singer_tit">万千歌手，尽在眼前</h2>
  </div>
  <!-- 背景结束 -->

  <div class="container">
    <div class="row">
      <!-- content开始 -->
      <div class="col-md-12 container_right  ">
        <div class="right">
          <!-- 入驻歌手 -->
          <div class="right_head">
            <h3>入驻歌手</h3>
          </div>
          <div class="singer_content clearfix">
            <ul>
              <?php
              //循环二维数组
              foreach ($arrSinger as $singer) {
              ?>
                <li class="w">
                  <a href="#"><img src="<?php echo $singer['singerUrl'] ?>"><span class="singer"><?php echo $singer['name'] ?></span></a>
                </li>
              <?php } ?>
            </ul>
          </div>
          <!-- 热门歌手 -->
          <div class="right_head">
            <h3 class="hot_tit">热门歌手</h3>
          </div>
          <div class="hot_content">
            <ul>
              <li class="w"><a href="#"><img src="./Public/Home/images/fine.jpg"><span class="singer">Fine乐团</span></a>
              </li>
              <li class="w"><a href="#"><img src="./Public/Home/images/yrz.jpg"><span class="singer">颜人中</span></a></li>
              <li class="w"><a href="#"><img src="./Public/Home/images/JJ lin.jpg"><span class="singer">林俊杰</span></a>
              </li>
              <li class="w"><a href="#"><img src="./Public/Home/images/Eson.jpg"><span class="singer">陈奕迅</span></a>
              </li>
              <li class="w"><a href="#"><img src="./Public/Home/images/dengziqi.jpg"><span class="singer">邓紫棋</span></a>
              </li>
              <li><a href="#"><img src="./Public/Home/images/xuezhiqian.png"><span class="singer">薛之谦</span></a></li>
              <li><a href="#"><img src="./Public/Home/images/sunann.png"><span class="singer">孙楠</span></a></li>
              <li><a href="#"><img src="./Public/Home/images/xubinglong.jpg"><span class="singer">徐炳龙</span></a></li>
              <li><a href="#"><img src="./Public/Home/images/zhangjie.jpg"><span class="singer">张杰</span></a></li>
              <li><a href="#"><img src="./Public/Home/images/shenyicheng.jpg"><span class="singer">沈以诚</span></a></li>
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
  <script src="./Public/Home/js/common.js"></script>
</body>

</html>