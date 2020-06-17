//入口函数
$(function () {
    //removeBtn按钮的单击事件
    $('.removeBtn').click(function () {
        //获取当前btn上自定义属性index存的收藏的id值
        let id = $(this).attr('index');
        //开启ajax数据检验
        //创建xhr对象,判断浏览器兼容性
        let xhr = null;
        if (window.XMLHttpRequest) {
            xhr = new XMLHttpRequest();
        } else {
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }
        //配置参数3个 数据请求方式,数据提交文件url路径
        xhr.open("get", "removeCollect.php?id=" + id, true);
        //开始传输 null固定写法
        xhr.send(null);
        xhr.onload = () => {
            let result = xhr.responseText;
            //判断获取的result如果为false就可以注册
            if (result == 0) {
                location.reload('collect.php');
                return;
            } else {
                alert('操作失败!');
            }
        }
    })
})