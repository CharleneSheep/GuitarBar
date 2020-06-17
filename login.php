<?php
//开启session会话
session_start();
//产生表单验证随机字符串
// $_SESSION['random'] = uniqid();
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>用户登录</title>
  <!-- 引入favicon网站图标 -->
  <link rel="shortcut icon" href="./Public/Home/favicon.ico" />
  <link rel="stylesheet" href="./Public/Home/font/iconfont.css">
  <link rel="stylesheet" href="./Public/Home/css/login.css">
  <base target='_blank'>
</head>

<body>
  <div class="container">
    <!-- 登录部分 -->
    <div class="login-box">
      <a href="index.php" class="toIndex"><span class="iconfont icon-zhuye indexIcon"></span></a>
      <div class="apple-btn login-apple">
        <li class="red-btn"></li>
        <li class="yellow-btn"></li>
        <li class="green-btn"></li>
      </div>
      <div class="title">Login</div>
      <form>
        <div class="input">
          <input type="text" name="login_Name" id="login-user" placeholder="Input your username">
        </div>
        <div class="input">
          <input type="password" name="login_pwd" id="login-password" placeholder="Input your password">
          <span class="iconfont icon-changyongicon- myIcon"></span>
        </div>
        <div class="btn login-btn">
          <input type="button" value='登录' id="loginBtn">
        </div>
      </form>
      <div class="error" id="error_login">
        <span>账号或密码错误</span>
      </div>
      <!-- 登录注册切换按钮 -->
      <div class="change-box login-change">
        <div class="change-btn toSign">
          <span>去注册</span>
        </div>
      </div>
    </div>
    <!-- 注册部分 -->
    <div class="sign-box">
      <a href="index.php" class="toIndex signTo"><span class="iconfont icon-zhuye indexIcon"></span></a>
      <div class="apple-btn sign-apple">
        <li class="red-btn"></li>
        <li class="yellow-btn"></li>
        <li class="green-btn"></li>
      </div>
      <div class="title">Sign</div>
      <form>
        <div class="input">
          <input type="text" name='regis_Name' id="sign-user" placeholder="Have A Good Name?">
        </div>
        <div class="input">
          <input type="password" name='regis_pwd' id="sign-password" placeholder="Keep Secret">
          <span class="iconfont icon-changyongicon- myIcon"></span>
        </div>
        <div class="btn sign-btn">
          <input type="button" value='注册' id="regisBtn">
        </div>
      </form>
      <div class="error regis_error" id="sign_error">
        <span>账号已存在</span>
      </div>
      <div class="true" id="sign_true">
        <span>账号可用</span>
      </div>
      <div class="change-box sign-change">
        <div class="change-btn toLogin">
          <span>去登陆</span>
        </div>
      </div>
    </div>
  </div>

  <script src="./Public/Home/js/jquery-3.5.0.min.js"></script>
  <script src="./Public/Home/js/login.js"></script>
</body>

</html>