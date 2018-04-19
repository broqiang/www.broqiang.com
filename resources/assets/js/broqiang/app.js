$(document).ready(function() {
    /**
     * 用来关闭顶部一次性 session 的提示信息(_message.blade.php)， 5 秒后自动关闭
     */
    setTimeout(function() {
        $('.js-message').fadeOut("slow");
    }, 5000);

    /**
     * 用来设置左侧侧边栏的滚动条
     */
    console.log($(window).height())
    $('.scroll-bar').css('max-height', $(window).height() - 100);
});