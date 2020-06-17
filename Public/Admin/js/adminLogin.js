/* 登录按钮的单击事件 */
(function () {
    $('#subBtn').click(function () {
        //获取输入框的值
        let name = $("#login-admin").val();
        let pwd = $("#login-password").val();
        //创建xhr对象,判断浏览器兼容性
        let xhr = null;
        if (window.XMLHttpRequest) {
            xhr = new XMLHttpRequest();
        } else {
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }
        //创建一个http请求,并设置请求地址及异步请求方式
        xhr.open("post", "adminCheck.php");
        //设置请求头
        xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
        let info = "name=" + name + "&pwd=" + pwd;
        xhr.send(info);
        //感知Ajax的状态,当Ajax状态改变时会触发事件onreadystatechange
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                //200-->交易成功
                if (xhr.status == 200) {
                    //用result存储响应的值
                    let result = xhr.responseText;
                    if (result == 1) {
                        //返回的1说明密码有误淡出错误提示
                        $('.error').slideDown();
                    } else {
                        //跳转到欢迎页
                        location.href = 'welcome.php';
                    }
                }
            }
        }
    });
    (function () {
        $("#login-password").focus(function () {
            //鼠标点击密码框时错误提示淡出
            $('.error').slideUp();
        })
    })()
})();