$(document).ready(function(){
    $('.content-wrap .content').hide();
    $('.content-wrap').children('.content:lt(10)').show();
    $('.load-more').click(function() {
        $('.content-wrap').children('.content:hidden:lt(6)').show();
    });
    
})