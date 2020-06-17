$(function () {
//获取播放按钮和暂停按钮元素
let musicPlayIcon = document.getElementsByClassName('musicPlayIcon');
let musicPauseIcon = document.getElementsByClassName('musicPauseIcon');
//获取音乐文件
let music = document.getElementsByClassName('music');
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
  /* 轮播定时器 */
  (function () {
    $('.carousel').carousel({
      interval: 2500
    })
  })()
});