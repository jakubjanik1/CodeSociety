document.addEventListener('DOMContentLoaded', function () {
    let menu = document.querySelector('.header__menu');
    let searchForm = document.querySelector('.header__search-form');
    let items = document.querySelector('.header__items');
    let toggle = document.querySelector('.header__toggle');

    window.addEventListener('resize', function (event) {
        if (event.target.innerWidth > 1130) {
            menu.classList.remove('header__menu--expanded');
            searchForm.classList.remove('header__search-form--expanded');
            items.classList.remove('header__items--expanded');
        }
    });

    toggle.addEventListener('click', function () {
        menu.classList.toggle('header__menu--expanded');
        searchForm.classList.toggle('header__search-form--expanded');
        items.classList.toggle('header__items--expanded');
    });
});