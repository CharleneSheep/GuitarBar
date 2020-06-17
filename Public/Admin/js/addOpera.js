function getTime() {
    let date = new Date();
    let year = date.getFullYear();
    let month = date.getMonth() + 1;
    let day = date.getDate();
    let hour = date.getHours();
    let minute = date.getMinutes();
    let second = date.getSeconds();
    month = month < 10 ? '0' + month : month;
    day = day < 10 ? '0' + day : day;
    hour = hour < 10 ? '0' + hour : hour;
    minute = minute < 10 ? '0' + minute : minute;
    second = second < 10 ? '0' + second : second;
    let time = year + '-' + month + '-' + day + ' ' + hour + ':' + minute + ':' + second;
    return time;
}
//类型编号变动时类型名变动(on可以操作动态添加的元素)
$('#typeId').on('change', function () {
    //typeName的value对应改变
    let id = this.value
    //排他
    $('#typeName option').attr('selected', false)
    $('#typeName option')[id - 1].setAttribute('selected', true)
})
//入口函数
$(function () {
    (function () {
        //创建曲谱名的正则表达式(开头必须是《,必须包含》)
        let regName = /^[《](?=.*》).{1,20}$/;
        let regFile = /^(.bmp|.png|.jpg|.jpeg|.gif)$/;
        let time = getTime();
        //添加曲谱add按钮的单击事件
        $("#add").click(function () {
            //获取输入框的值(trim()清除头尾空格)
            let operaName = $("#operaName").val().trim();
            let typeId = $("#typeId").val();
            let typeName = $("#typeName").val();
            let operaFile = $("#operaFile").val();
            //用.获取开始截取的索引
            let index = operaFile.lastIndexOf(".");
            //截取到文件的后缀格式.jpg 并转换成小写
            let fileType = operaFile.substring(index).toLowerCase();
            if (!regName.test(operaName)) {
                alert("曲谱名的格式不正确哦!");
                return;
            } else if (!regFile.test(fileType)) {
                alert("上传的图片格式不正确哦!");
                return;
            }
            //开启ajax数据检验
            //创建xhr对象,判断浏览器兼容性
            let xhr = null;
            if (window.XMLHttpRequest) {
                xhr = new XMLHttpRequest();
            } else {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
            //请求行
            xhr.open("post", "updateOperas.php");
            //请求头
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
            //请求体
            let info = "operaName=" + operaName + "&typeId=" + typeId + "&typeName=" + typeName + "&operaFile=" + operaFile
            xhr.send(info);
            xhr.onload = function () {
                let result = xhr.responseText;
                //判断获取的result为0操作成功
                if (result == 0) {
                    $(".true").slideDown();
                    //清空输入框
                    $("#resetBtn").click();
                    $('#operaFile').val() = ''
                    return;
                } else {
                    alert("操作失败!");
                    return;
                }
            }
        });
        $("#username").focus(function () {
            $(".true").slideUp();
        });
    })();
    (function () {
        //文件改变事件
        $('#operaFile').on('change', function () {
            //获取当前所选择的文件对象
            let myFile = this.files[0]
            //根据文件对象生成一个url,它会将这个文件托管到当前页面所在的服务器中的路径
            let url = URL.createObjectURL(myFile)
            //将url赋值给img的src属性
            $('.pic>img').attr('src', url)
        })
    })();
});