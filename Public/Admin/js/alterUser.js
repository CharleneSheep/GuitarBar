$(function () {
    $('.page').offset({
        top: 660
    });
    (function () {
        $('#searchBtn').click(function () {
            let txt = $('#searchUser').val().trim()
            location.href = './userList.php?txt=' + txt;
        })
    })();
})

function confirmDel(id) {
    let userId = id;
    //询问是否要删除
    if (window.confirm('你真的要删除吗？')) {
        //创建xhr对象,判断浏览器兼容性
        let xhr = null;
        if (window.XMLHttpRequest) {
            xhr = new XMLHttpRequest();
        } else {
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }
        //配置参数3个 数据请求方式,数据提交文件url路径
        xhr.open("get", "deleteUser.php?userId=" + userId, true);
        //开始传输 null固定写法
        xhr.send(null);
        //感知Ajax的状态,当Ajax状态改变时会触发事件onreadystatechange
        xhr.onreadystatechange = function () {
            /* 0请求未初始化(还没调用(open)) 1请求已经建立但是还没有发送 */
            /* 2请求已发送,正在处理中 3请求正在处理中已有部分数据可用但是还没有完成响应的生成*/
            //readyState为4时-->响应已完成 可以获取并使用服务器的响应了
            if (xhr.readyState == 4) {
                //200-->交易成功
                if (xhr.status == 200) {
                    let result = xhr.responseText;
                    //判断获取的result为0操作成功
                    if (result == 0) {
                        location.reload('alterUser.php')
                        return
                    } else {
                        alert('操作失败!');
                        return
                    }
                }
            }
        };
    }
}