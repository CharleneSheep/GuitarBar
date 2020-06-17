<?php
//开启session会话
session_start();
//产生表单验证随机字符串
$_SESSION['random'] = uniqid();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>管理员登录</title>
  <!-- 引入favicon网站图标 -->
  <link rel="shortcut icon" href="./favicon.ico" />
  <link rel="stylesheet" href="../Home/font/iconfont.css">
  <link rel="stylesheet" href="./css/AdminLogin.css">
</head>

<body>
  <div class="box">
    <h2>Login</h2>
    <form>
      <div class="inputBox">
        <input type="text" name="adminName" id="login-admin" required="">
        <label>adminName</label>
      </div>
      <div class="inputBox">
        <input type="password" name="adminPwd" id="login-password" required="">
        <label>password</label>
      </div>
      <input type="button" name="" id="subBtn" value="Submit">
      <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
      <div class="error" id="error_login">
        <span>账号或密码错误</span>
      </div>
    </form>
  </div>
  <script src="./js/jquery-3.5.0.min.js"></script>
  <script src="./js/adminLogin.js"></script>
</body>

</html>