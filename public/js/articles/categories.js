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
});