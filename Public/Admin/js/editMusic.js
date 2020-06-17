(function () {
    //创建校验的正则表达式
    let regTypeId = /^[1-5]{1}$/
    let regFile = /^(.mp3|.mp4)$/
    $('#sub').click(function () {
        let id = $("#id").attr("index");
        //获取输入框的值
        let name = $('#musicName').val().trim()
        let singer = $('#singer').val().trim()
        let typeId = $('#typeId').val().trim()
        let url = $('#musicUrl').val().trim()
        //用.获取开始截取的索引
        let index = url.lastIndexOf(".")
        //截取到文件的后缀格式.jpg 并转换成小写
        let fileType = url.substring(index).toLowerCase()
        if (name.length < 1 || name.length > 20) {
            alert('歌曲名长度不对哦!')
            return
        } else if (singer.length < 1 || singer.length > 20) {
            alert('歌手名长度不对哦!')
            return
        } else if (!regTypeId.test(typeId)) {
            alert('类型编号的格式不正确哦！')
            return
        } else if (!regFile.test(fileType)) {
            alert('上传的吉他曲格式不正确哦!')
            return
        }
        let xhr = new XMLHttpRequest()
        xhr.open('post', 'replaceMusic.php')
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        let info = "id=" + id + "&name=" + name + "&singer=" + singer + "&typeId=" + typeId + "&url=" + url
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