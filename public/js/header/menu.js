document.addEventListener('DOMContentLoaded', function() {
    let menuLinks = document.querySelectorAll('.menu__link');
    let path = location.pathname;

    for (let link of menuLinks) {
        if (path.includes(link.innerText.trim().toLowerCase())) {
            link.classList.add('menu__link--current');
        }
    }
});