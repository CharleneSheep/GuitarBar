$(function () {
  /* 注册模块 */
  (function () {
    //单击输入框时清除错误提示
    $("#sign-user").focus(function () {
      $("#sign_error").slideUp();
      $("#sign_true").slideUp();
    });
    //创建正则表达式
    let reg = /^[a-zA-Z0-9]{4,10}$/;
    //name框失去焦点事件
    $("#sign-user").blur(function () {
      let name = $("#sign-user").val();
      /* 判断是否存在非正则中的符号 */
      if (!reg.test(name) && name.length != 0) {
        $("#sign_error").text("用户名只能是4-10位的字母和数字哦");
        $("#sign_error").slideDown();
        return
      }
      if (name.length >= 1) {
        /* 用户名验证是否可用 */
        //开启ajax数据检验
        //创建xml异步请求对象
        let xhr = new XMLHttpRequest();
        //配置参数3个 数据请求方式,数据提交文件url路径
        xhr.open("get", "nameCheck.php?username=" + name, true);
        //开始传输 null固定写法
        xhr.send(null);
        //响应成功后会自动调用onload事件
        xhr.onload = () => {
          let result = xhr.responseText;
          //判断获取的result如果为false就可以注册
          if (result == 0) {
            //显示账号可用
            $("#sign_true").slideDown().siblings("#sign_error").slideUp();
          } else {
            //jq链式编程
            $("#sign_error").slideDown().siblings("#sign_true").slideUp();
          }
        }
      }
    });
  })();
  //密码框的校验
  (function () {
    //定义正则表达式长度6-16位的只能包含大小写26个字母数字和-_
    let reg = /^[a-zA-Z0-9-_]{6,16}$/;
    $("#sign-password").blur(function () {
      let pwd = $("#sign-password").val();
      //test()方法验证pwd中是否存在除正则外的字符
      if (!reg.test(pwd) && pwd.length != 0) {
        $("#sign_error>span").text("密码为6-16位的字母和数字哦(可包含-和_符号)");
        $("#sign_error").slideDown();
        $('#regisBtn').attr('disabled', true)
      } else {
        $("#sign_error").slideUp();
        $('#regisBtn').attr('disabled', false)
      }
    });
  })();
  //密码显示隐藏转换
  (function () {
    $('.myIcon').on({
      mouseenter: function () {
        $('#login-password').prop('type', 'text')
        $('#sign-password').prop('type', 'text')
      },
      mouseleave: function () {
        $('#login-password').prop('type', 'password')
        $('#sign-password').prop('type', 'password')
      }
    })
  })();
  /* 注册按钮的单击事件 */
  (function () {
    $('#regisBtn').click(function () {
      //获取输入框的值
      let name = $("#sign-user").val();
      let pwd = $("#sign-password").val();
      //创建xml异步请求对象
      let xhr = new XMLHttpRequest();
      //创建一个http请求,并设置请求地址及异步请求方式
      xhr.open("post", "registerSave.php");
      //设置请求头
      xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
      let info = "name=" + name + "&pwd=" + pwd;
      xhr.send(info);
      xhr.onload = () => {
        let result = xhr.responseText;
        if (result == 0) {
          if (confirm('注册成功,去登录?')) {
            location.href = './login.php';
          }
          return
        } else {
          alert('出了点小错误哦!');
        }
      }
    })
  })();
  /* 登录按钮的单击事件 */
  (function () {
    $('#loginBtn').click(function () {
      //获取输入框的值
      let name = $("#login-user").val();
      let pwd = $("#login-password").val();
      //创建xml异步请求对象
      let xhr = new XMLHttpRequest();
      xhr.open("get", "loginCheck.php?name=" + name + '&pwd=' + pwd);
      xhr.send(null);
      xhr.onload = () => {
        //用result存储响应的值
        let result = xhr.responseText;
        if (result == 1) {
          //返回的1说明密码有误淡出错误提示
          $('.error').slideDown();
        } else {
          //跳转到首页
          location.href = 'index.php';
        }
      }
    })
  })();
});

/* 登录注册切换功能 */
(function () {
  // 封装选择器, 采用ES6箭头函数写法
  const getSelector = (ele) => {
    return typeof ele === "string" ? document.querySelector(ele) : "";
  };
  // 登录注册载入
  const containerShow = () => {
    var show = getSelector(".container");
    show.className += " container-show";
  };
  window.onload = containerShow;
  // 登录注册页切换
  ((window, document) => {
    // 登录 -> 注册
    let toSignBtn = getSelector(".toSign"),
      toLoginBtn = getSelector(".toLogin");
    (loginBox = getSelector(".login-box")),
    (signBox = getSelector(".sign-box"));
    toSignBtn.onclick = () => {
      loginBox.className += " animate_login";
      signBox.className += " animate_sign";
      $("title").text("用户注册");
    };
    toLoginBtn.onclick = () => {
      loginBox.classList.remove("animate_login");
      signBox.classList.remove("animate_sign");
      $("title").text("用户登录");
    };
  })(window, document);
})();