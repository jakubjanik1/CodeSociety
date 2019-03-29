document.addEventListener('DOMContentLoaded', function() {
    let categories = document.querySelector('.articles__categories');
    
    if (! categories) {
        return;
    }

    let items = document.querySelectorAll('.categories__item');
    let categoriesWidth = categories.clientWidth + 40;

    window.addEventListener('resize', function() {
         if (event.target.innerWidth < categoriesWidth) {
            categories.classList.add('articles__categories--folded');
            items.forEach(item => item.classList.add('categories__item--separated'));
        } else {
            categories.classList.remove('articles__categories--folded');
            items.forEach(item => item.classList.remove('categories__item--separated'));
        }
    });

    window.dispatchEvent(new Event('resize'));

    highlightCurrentCategory();
});

function highlightCurrentCategory() {
    let categoriesLinks = document.querySelectorAll('.categories__link');
    let path = location.pathname;

    for (let link of categoriesLinks) {
        if (path.includes(link.innerText)) {
            link.classList.add('categories__link--current');
            return;
        }
    }

    categoriesLinks[0].classList.add('categories__link--current');
}