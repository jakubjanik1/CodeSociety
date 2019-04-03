document.addEventListener('DOMContentLoaded', function() {
    let menuLinks = document.querySelectorAll('.menu__link');
    let path = location.pathname;

    for (let link of menuLinks) {
        let regex = new RegExp(link.innerText.trim().toLowerCase() + '?');
        if (path.match(regex)) {
            link.classList.add('menu__link--current');
        }
    }
});