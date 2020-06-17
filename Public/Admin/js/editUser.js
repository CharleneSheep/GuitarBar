//入口函数
$(function () {
    //自执行函数避免全局污染
    (function () {
        //创建用户名的正则表达式
        let regName = /^[a-zA-Z0-9]{4,10}$/;
        //创建手机号码的正则表达式(\d等价于[0-9])
        let regPhone = /^1[3456789]\d{9}$/;
        //创建邮箱的正则表达式(\w匹配包括下划线的任何单词字符。等价于“[A-Za-z0-9_]”)
        let regEmail = /^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/;
        //添加用户sub按钮的单击事件
        $('#sub').click(function () {
            //获取存放在username上的自定义属性index获取该用户的id
            let id = $("#username").attr("index");
            //获取输入框的值
            let username = $('#username').val().trim();
            let phone = $('#phone').val().trim();
            let sex = $('#sex').val().trim();
            let email = $('#email').val().trim();
            //分别用正则的test()方法校验
            if (!regName.test(username)) {
                alert('用户名格式不正确哦!');
                return
            } else if (!regPhone.test(phone)) {
                alert('手机格式不正确哦!');
                return
            } else if (sex != '男' && sex != '女') {
                alert('性别格式不正确哦!');
            } else if (!regEmail.test(email)) {
                alert('邮箱格式不正确哦!');
                return
            }
            //开启ajax数据检验
            let xhr = new XMLHttpRequest()
            xhr.open("post", "replaceUser.php");
            //设置请求头
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
            let info = "name=" + username + "&sex=" + sex + "&phone=" + phone + "&email=" + email + '&id=' + id
            xhr.send(info);
            xhr.onload = function () {
                let result = xhr.responseText;
                //判断获取的result为0操作成功
                if (result == 0) {
                    $('.true').slideDown();
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