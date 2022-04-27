$(document).ready(function (event) {
    $('.menu-items__list2').slideUp();
    $('.menu-items__list').click(function () {
        $(this).next().slideToggle(300);
        $(this).toggleClass('bg-[#303c54]');
        $(this).children('i').toggleClass('menu-items__icon--tranform ')
    });
    $('.header__list-bar').click(function () {
        $('.nav__menu').toggleClass('menu-items__nav');
        $('.nav__sub-menu').toggleClass('ml-64', 200);
        $('.fixed.w-full').toggleClass('nav__sub-menu-width',200);
        $('.nav__sub-header').toggleClass('w-[1691px]',200);
    });
});
