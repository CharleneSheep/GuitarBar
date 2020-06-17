(function () {
    $('#sub').click(function () {
        let id = $("#id").attr("index");
        let inTitle = $('#name').val();
        let inContent = $('#content').val();
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
        let xhr = new XMLHttpRequest()
        xhr.open('post', 'replaceInvitation.php')
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        let info = "id=" + id + "&name=" + inTitle + "&content=" + inContent
        xhr.send(info)
        xhr.onload = function () {
            let res = xhr.response
            if (res == 0) {
                $('.true').slideDown()
                return
            } else {
                alert("操作失败!")
                return
            }
        }
    })
})()