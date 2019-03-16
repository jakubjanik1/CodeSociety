document.addEventListener('DOMContentLoaded', function() {
    let categories = document.querySelector('.articles__categories');
    let items = document.querySelectorAll('.categories__item');
    let categoriesWidth = categories.clientWidth + 40;

    window.addEventListener('resize', function() {
         if (event.target.innerWidth < categoriesWidth) {
            categories.style['flex-direction'] = 'column';
            items.forEach(item => item.style['margin-bottom'] = '10px');
        } else {
            categories.style['flex-direction'] = '';
            items.forEach(item => item.style = '');
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
            link.style.color = 'var(--primary-green)';
            return;
        }
    }

    categoriesLinks[0].style.color = 'var(--primary-green)';
}