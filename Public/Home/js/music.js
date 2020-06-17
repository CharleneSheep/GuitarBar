//入口函数
$(function () {
    /* 分类切换加颜色 */
    (function () {
        //给第一个li加上默认的样式
        $('.navigation ul li').eq(0).addClass('red');
        //所有li的单击事件(隐式迭代)
        $('.navigation ul li').click(function () {
            //获取当前li的索引
            let index = $(this).index();
            //当前这个li加上red的类名显示红色
            $(this).addClass('red').siblings().removeClass('red');
            //让对应的content盒子ul显示
            $('.music_content ul').eq(index + 1).addClass('conShow').siblings().removeClass('conShow');
        })
    })();
    /* 下载功能 */
    (function () {
        //判断用户是否登录
        /* 下载按钮的单击事件 */
        $('.downBtn').click(function () {
            //获取当前吉他曲的id
            let id = $(this).attr('index');
            //收藏按钮上的自定义属性loginSession保存了session判断它即可
            let name = $('.collectBtn').attr('loginSession');
            //在设置自定义属性时未找到session时值设置为0
            if (name != 0) {
                //!=0说明登录了可以下载
                location.href = 'download.php?id=' + id;
                //阻止a链接的默认跳转
                return false;
            } else {
                //提示先登录
                if (confirm('登录了才有权限下载哦,去登录?')) {
                    location.href = 'login.php';
                    //阻止a链接的默认跳转
                    return false;
                } else {
                    //阻止a链接的默认跳转
                    return false;
                }
            }
        })
    })();
    /* 收藏功能 */
    (function () {
        /* 收藏按钮的单击事件 */
        $('.collectBtn').click(function () {
            //先判断session是否存在-->用户是否登录
            //获取用session自定义的属性值
            let name = $(this).attr('loginSession');
            if (name == 0) {
                if (confirm('你还没有登录哦,去登录?')) {
                    location.href = './login.php';
                }
                return
            }
            //获取自定义属性存的当前吉他曲的编号
            let id = $(this).attr('index');
            //获取自定义属性存的当前吉他曲名称
            let musicName = $(this).attr('music');
            //开启ajax数据检验
            //创建xml异步请求对象
            let xhr = new XMLHttpRequest();
            //配置参数3个 数据请求方式,数据提交文件url路径
            xhr.open("get", "collectCheck.php?username=" + name + '&id=' + id + '&music=' + musicName, true);
            //开始传输 null固定写法
            xhr.send(null);
            xhr.onload = () => {
                let result = xhr.responseText;
                if (result == 0) {
                    //0为收藏成功
                    alert('收藏成功!');
                } else if (result == 1) {
                    alert('你已经收藏过了哦!');
                }
            }
            //阻止a链接跳转
            return false
        })
    })();
    /* 音乐播放暂停的设置 */
    (function () {
        //获取播放按钮和暂停按钮元素
        let musicPlayIcon = document.getElementsByClassName('musicPlayIcon');
        let musicPauseIcon = document.getElementsByClassName('musicPauseIcon');
        //获取音乐文件
        let music = document.getElementsByClassName('musicAudio');
        for (let i = 0; i < musicPlayIcon.length; i++) {
            //播放按钮的单击处理函数
            musicPlayIcon[i].onclick = function () {
                for (let i = 0; i < musicPlayIcon.length; i++) {
                    //排它思想，先把所有的音乐都暂停
                    musicPlayIcon[i].style.color = '';
                    music[i].pause();
                }
                //把当前点击的按钮变色并播放
                this.style.color = 'red';
                // console.log(music[i]) 
                music[i].play();
            }
            //暂停按钮的单击处理函数
            musicPauseIcon[i].onclick = function () {
                //播放按钮颜色清除
                musicPlayIcon[i].style.color = '';
                //暂停音乐
                music[i].pause();
            }
        }
    })()
})