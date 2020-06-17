//入口函数
$(function () {
    //自执行函数避免全局污染
    (function () {
        //添加帖子sub按钮的单击事件
        $('#sub').click(function () {
            let inTitle = $('#inTitle').val();
            let inContent = $('#inContent').val();
            if (inTitle.length != 0 && inTitle.length <= 20) {
                inTitle = inTitle.trim();
                //替换一些不文明词汇
                inTitle = inTitle.replace(/搞基|made|妈的|他妈|tama|gay/gi, '**');
            } else {
                alert('帖子名的长度为1-20个字符哦');
                return
            }
            if (inContent.length != 0 && inContent.length <= 255) {
                inContent = inContent.trim();
                //替换一些不文明词汇
                inContent = inContent.replace(/搞基|made|妈的|他妈|tama|gay/gi, '**');
            } else {
                alert('内容的长度为1-255个字符哦');
                return
            }
            //开启ajax数据检验
            let xhr = new XMLHttpRequest()
            //请求行
            xhr.open("post", "updateInvitation.php");
            //请求头
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
            let info = "inTitle=" + inTitle + "&inContent=" + inContent
            xhr.send(info);
            xhr.onload = function () {
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
        $('#inTitle').focus(function () {
            $('.true').slideUp();
        })
    })();
})