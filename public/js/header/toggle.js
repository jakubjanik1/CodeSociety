document.addEventListener('DOMContentLoaded', function () {
    let header = document.querySelector('.header');
    let menu = document.querySelector('.header__menu');
    let searchForm = document.querySelector('.header__search-form');
    let items = document.querySelector('.header__items');
    let logo = document.querySelector('.header__logo');
    let toggle = document.querySelector('.header__toggle');

    window.addEventListener('resize', hideHeader);
    window.addEventListener('load', hideHeader);

    toggle.addEventListener('click', function () {
        if (menu.classList.contains('hidden')) {
            expandHeader();
        } else {
            collapseHeader();
        }

        menu.classList.toggle('hidden');
        searchForm.classList.toggle('hidden');
        items.classList.toggle('hidden');
    });

    let once = false;
    function hideHeader(event) {
        let width = event.currentTarget.innerWidth;

        if (!menu.classList.contains('hidden') && width < 1130 && !once) {
            toggle.click();
            once = true;
            expandHeader();
        } else if (width > 1130) {
            once = false;
            collapseHeader();
        }
    }

    function expandHeader() {
        header.style.height = 'auto';
        header.style['padding-bottom'] = '18px';
        logo.style['margin-top'] = '19px';
    }

    function collapseHeader() {
        header.style.height = '80px';
        header.style.padding = 0;
        logo.style['margin-top'] = 0;
    }
});
