<?php
//开启session会话
session_start();
//包含链接数据库的公共文件
require_once("./conn.php");
//查询类型表
$sql = "SELECT * FROM invitation ORDER BY time DESC";
$result = mysqli_query($link, $sql);
$arrInv = mysqli_fetch_all($result, MYSQLI_ASSOC);
//获取行数
$record = mysqli_num_rows($result);

?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>社区</title>
  <!-- 引入favicon网站图标 -->
  <link rel="shortcut icon" href="./Public/Home/favicon.ico" />
  <!-- 引入Bootstrap文件 -->
  <link rel="stylesheet" href="./Public/Home/lib/css/bootstrap.css">
  <link rel="stylesheet" href="./Public/Home/font/iconfont.css">
  <!-- 引入样式文件 -->
  <link rel="stylesheet" href="./Public/Home/css/community.css">
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
              <li class="active"><a href="./community.php">社区<span class="sr-only">(current)</span></a></li>
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
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </div>
  </div>
  <!-- 导航部分结束 -->

  <!-- 中间头部-->
  <div class="container-fluid head">
    <div class="row">
      <div class="container">
        <div class="my_nav">
          <span class="iconfont icon-tiezi"></span>
          <a href="#">求谱</a>
          <a href="#" class="new">最新</a>
          <a href="#invitation" class="write">发布帖子</a>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="tiezi_content">
      <ul>
        <?php
        //循环二维数组
        foreach ($arrInv as $arr) {
        ?> <li>
            <div class="user clearfix">
              <div class="head"><img src="<?php echo $arr['headUrl'] ?>" alt=""></div>
              <span class="name"><?php echo $arr['userName'] ?></span>
              <span class="time"><?php echo $arr['time'] ?></span>
            </div>
            <a href="#" class="tiezi_detail">
              <h3 class="title"><?php echo $arr['name'] ?></h3>
              <p><?php echo $arr['content'] ?></p>
            </a>
          </li>
        <?php } ?>
      </ul>
    </div>
    <!-- 发帖区域 -->
    <!-- <a name="invitation"></a> -->
    <div class="invitation" id="invitation">
      <div class="head">
        <h3>发布帖子</h3>
        <span>共<em><?php echo $record ?></em>条帖子</span>
      </div>
      <div class="invContent clearfix">
        <div class="user">
          <img src="./Public/Home/images/userHead.jpg" alt="">
        </div>
        <div class="content">
          <form>
            标题：<input type="text" name="title" id="tit"><br>
            <textarea id="txt" cols="70" rows="5"></textarea>
            <span><em class="length">0</em>/255</span>
            <input type="button" name="" class="addInv" value="发布">
          </form>
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
  <script src="./Public/Home/js/jquery-3.5.0.min.js"></script>
  <script src="./Public/Home/js/common.js"></script>
  <script src="./Public/Home/js/community.js"></script>
  <script>
    let date = new Date();
    let year = date.getFullYear();
    let month = date.getMonth() + 1;
    let day = date.getDate();
    let hour = date.getHours();
    let minute = date.getMinutes();
    let second = date.getSeconds();
    month = month < 10 ? '0' + month : month;
    day = day < 10 ? '0' + day : day;
    hour = hour < 10 ? '0' + hour : hour;
    minute = minute < 10 ? '0' + minute : minute;
    second = second < 10 ? '0' + second : second;
    let time = year + '-' + month + '-' + day + ' ' + hour + ':' + minute + ':' + second;
    //发布按钮的单击事件
    $('.addInv').click(function() {
    <?php if (isset($_SESSION['name'])) : ?>
    //获取标题内容和textarea的内容
    let title = $('#tit').val().trim()
    let txt = $('#txt').val().trim()
    //替换不文明词汇
    title = title.replace(/搞基|made|妈的|他妈|tama|gay/gi, '**')
    txt = txt.replace(/搞基|made|妈的|他妈|tama|gay/gi, '**')
    if (title.length == 0) {
      alert('请输入标题!')
      return
    } else if (txt.length == 0) {
      alert('请输入帖子内容!')
      return
    } else if (title.length > 20) {
      alert('标题内容过长!');
      return
    } else if (txt.length > 255) {
      alert('帖子内容过长!');
      return
    }
    let name = '<?php echo $_SESSION['name'] ?>'
    //创建xml异步对象
    let xhr = new XMLHttpRequest();
    //请求行
    xhr.open("get", "addInvitation.php?title=" + title + '&txt=' + txt + '&name=' + name + '&time=' + time, true);
    //请求体
    xhr.send(null);
    //服务器响应会自动触发onload事件
    xhr.onload =function () { 
        let res = xhr.response
        if(res==0){
          alert('发布成功!');
          //重新加载页面显示新加的数据
          location.reload('community.php');
          return 
        }else{
          alert('发布失败!');
          return
        }
     }
      <?php else : ?>
        if (confirm('请先登录哦!')) {
          location.href = './login.php'
          return
        }
      <?php endif ?>
    })
  </script>
</body>

</html>