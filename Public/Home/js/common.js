$(function () {
    //创建正则表达式限制条件
    // let reg = /^[a-zA-Z]{1,10}$/;
    //搜索按钮的单击事件
    $('#search_btn').click(function () {
        //获取search_txt的内容(清空前后空格)
        let txt = $('#search_txt').val().trim()
        // if (!reg.test(txt)) {
        //     alert('不能输入除字符外的符号或数字哦(1-10个字符)！');
        //     return;
        // }
        if (txt.indexOf('!') != -1 || txt.indexOf('~') != -1 || txt.indexOf('-') != -1 || txt.indexOf('(') != -1 || txt.indexOf('@') != -1 || txt.indexOf('#') != -1 || txt.indexOf('$') != -1 || txt.indexOf('%') != -1 || txt.indexOf('^') != -1 || txt.indexOf(')') != -1 || txt.indexOf('+') != -1 || txt.indexOf(0) != -1 || txt.indexOf(1) != -1 || txt.indexOf(2) != -1 || txt.indexOf(3) != -1 || txt.indexOf(4) != -1 || txt.indexOf(5) != -1 || txt.indexOf(6) != -1 || txt.indexOf(7) != -1 || txt.indexOf(8) != -1 || txt.indexOf(9) != -1) {
            alert('不能输入除字符外的符号或数字哦！');
            return
        } else if (txt.length > 10) {
            alert('字符长度限定在10个之内哦！');
            return
        }
        location.href = './list.php?txt=' + txt;
    })
})