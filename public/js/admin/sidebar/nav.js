document.addEventListener('DOMContentLoaded', function() {
    let navLinks = document.querySelectorAll('.nav__link');
    let path = location.pathname;

    for (let link of navLinks) {
        let regex = new RegExp('admin/' + link.innerText.trim().toLowerCase() + '?');
        if (path.match(regex)) {
            link.classList.add('nav__link--current');
            return;
        }
    }

    navLinks[0].classList.add('nav__link--current');
});