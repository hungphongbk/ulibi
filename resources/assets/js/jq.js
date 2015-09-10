$.material.init();
$(document).ready(function(){
    var navHeight=$('#navbar-top').height();
    $(window).scroll(function(e) {
        var top=$(window).scrollTop();
        if(top<=navHeight){
            $('#navbar-top').css({
                'transform': 'translateY(-'+(80+top-navHeight)+'px)',
                'opacity': (navHeight-top)/80
            });
        } else {
            $('#navbar-top').css({
                'transform': 'translateY(-80px)',
                'opacity': '0'
            });
        }
    });
});