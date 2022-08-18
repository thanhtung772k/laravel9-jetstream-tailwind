$(document).ready(function (event) {
    $('.sub-menu').slideUp();
    $('.mobile-menu-btn').click(function(){
        $('#primary-menu').slideToggle(200);
    });
    $('.menu-item').click(function(){
        $('.active').children('.sub-menu').slideUp(200);
        if ($(this).hasClass('active')) {
            $(this).children('.sub-menu').slideUp(200);
            $(this).removeClass('active');
        }
        else {
            $('.active').removeClass('active')
            $(this).children('.sub-menu').slideDown(200);
            $(this).addClass('active');
        }
    });
});