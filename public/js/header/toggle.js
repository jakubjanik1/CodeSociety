document.addEventListener('DOMContentLoaded', function () {
    let menu = document.querySelector('.header__menu');
    let searchForm = document.querySelector('.header__search-form');
    let items = document.querySelector('.header__items');
    let toggle = document.querySelector('.header__toggle');

    window.addEventListener('resize', function (event) {
        if (event.target.innerWidth > 1130) {
            menu.classList.remove('visible');
            searchForm.classList.remove('visible');
            items.classList.remove('visible');
        }
    });

    toggle.addEventListener('click', function () {
        menu.classList.toggle('visible');
        searchForm.classList.toggle('visible');
        items.classList.toggle('visible');
    });
});