//入口函数
$(function () {
    //自执行函数避免全局污染
    (function () {
        //创建用户名的正则表达式
        let regName = /^[a-zA-Z0-9]{4,10}$/;
        //创建密码的正则表达式
        let regPwd = /^[a-zA-Z0-9-_]{6,16}$/;
        //创建手机号码的正则表达式
        let regPhone = /^1[3456789]\d{9}$/;
        //创建邮箱的正则表达式
        let regEmail = /^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/;
        //添加用户sub按钮的单击事件
        $('#sub').click(function () {
            //获取输入框的值
            let username = $('#username').val().trim();
            let pwd = $('#pwd').val().trim();
            let sex = $('.radioBtn:checked').val();
            let phone = $('#phone').val().trim();
            let email = $('#email').val().trim();
            //分别用正则的test()方法校验
            if (!regName.test(username) || username.length == 0) {
                alert('用户名格式不正确哦!');
                return
            } else if (!regPwd.test(pwd) || pwd.length == 0) {
                alert('用户密码格式不正确哦!');
                return
            } else if (!regPhone.test(phone) || phone.length == 0) {
                alert('手机格式不正确哦!');
                return
            } else if (!regEmail.test(email)) {
                alert('邮箱格式不正确哦!');
                return
            }
            //开启ajax数据检验
            //创建xhr对象,判断浏览器兼容性
            let xhr = null;
            if (window.XMLHttpRequest) {
                xhr = new XMLHttpRequest();
            } else {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
            //请求行(请求方式,请求地址)
            xhr.open("post", "updateUser.php");
            //请求头
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
            let info = "name=" + username + "&pwd=" + pwd + "&sex=" + sex + "&phone=" + phone + "&email=" + email
            xhr.send(info);
            //当服务器响应后会自动触发onload事件
            xhr.onload = function () {
                //获取响应内容
                let result = xhr.responseText;
                //判断获取的result为0操作成功
                if (result == 0) {
                    $('.true').slideDown();
                    //清空输入框
                    $('#resetBtn').click();
                    return
                } else {
                    alert('操作失败!');
                    return
                }
            }
        })
        $('#username').focus(function () {
            $('.true').slideUp();
        })
    })();
})