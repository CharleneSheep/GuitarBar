//入口函数
$(function () {
    //给第一个li加上默认的样式
    $('.navigation ul li').eq(0).addClass('red');
    //所有li的单击事件(隐式迭代)
    $('.navigation ul li').click(function () {
        //获取当前li的索引
        let index = $(this).index();
        //当前这个li加上red的类名显示红色
        $(this).addClass('red').siblings().removeClass('red');
        //让对应的content盒子ul显示
        $('#content ul').eq(index).addClass('conShow').siblings().removeClass('conShow');
    })
})