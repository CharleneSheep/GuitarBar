let time = getTime()
//添加按钮的单击事件
;
(function () {
    //创建校验的正则表达式
    let regFile = /^(.mp3|.mp4)$/
    $('#addBtn').click(function () {
        //获取输入框的值
        let name = $('#musicName').val().trim()
        // let singer = $('#singer').val().trim()
        let url = $('#musicUrl').val().trim()
        let typeId = $('#typeId').val()
        let singerId = $('#singerId').val()
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
        } else if (!regFile.test(fileType)) {
            alert('上传的吉他曲格式不正确哦!')
            return
        }
        let xhr = new XMLHttpRequest()
        xhr.open('post', 'updateMusic.php')
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        let info = "name=" + name + "&typeId=" + typeId + "&url=" + url + '&singerId=' + singerId
        xhr.send(info)
        xhr.onload = function () {
            let res = xhr.response
            if (res == 0) {
                $('.true').slideDown()
                $("#resetBtn").click()
                return
            } else {
                alert("操作失败!")
                return
            }
        }
    });
    //类型编号变动时类型名变动(on可以操作动态添加的元素)
    $('#typeId').on('change', function () {
        //typeName的value对应改变
        let id = this.value
        //排他
        $('#typeName option').attr('selected', false)
        $('#typeName option')[id - 1].setAttribute('selected', true)
    })
    //歌手编号变动歌手名变动的事件
    $('#singerId').on('change', function () {
        //typeName的value对应改变
        let id = this.value
        //排他
        $('#singer option').attr('selected', false)
        $('#singer option')[id - 1].setAttribute('selected', true)
    })
})()