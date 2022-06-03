$(document).ready(function (event) {
    //$('.nav-menu__sub-item').slideUp();
    $('.header__list-bar').click(function () {
        $('.nav-menu').toggleClass('menu-items__nav');
        $('.nav__sub-menu').toggleClass('ml-64', 200);
        $('.fixed.w-full').toggleClass('nav-menu__sub-item-width', 200);
        $('.nav__sub-header').toggleClass('w-[1691px]', 200);
    });
    $('.nav-menu__item').click(function () {
        $('.active').children('.nav-menu__sub-item').slideUp(200);
        $('.active').children('.nav-menu__dropToggle').removeClass('menu-item__icon--tranform');
        if ($(this).hasClass('active')) {
            $(this).children('.nav-menu__sub-item').slideUp(200);
            $(this).children('.nav-menu__dropToggle').removeClass('menu-item__icon--tranform');
            $(this).removeClass('active');
        }
        else {
            $('.active').removeClass('active')
            $(this).children('.nav-menu__dropToggle').addClass('menu-item__icon--tranform')
            $(this).children('.nav-menu__sub-item').slideDown();
            $(this).addClass('active');
        }

    });
});
