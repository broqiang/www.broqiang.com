/**
 * 用来关闭顶部一次性 session 的提示信息(_message.blade.php)， 5 秒后自动关闭
 */
$(document).ready(function(){
    setTimeout(function(){
        $('.js-message').fadeOut("slow");
    },5000);
});
