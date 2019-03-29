document.addEventListener('DOMContentLoaded', function () {
    let input = document.querySelector('.search-form__input');

    document.addEventListener('click', function (event) {     
        if (event.target.closest('.search-form__button')) {
            if (! input.classList.contains('search-form__input--visible') || input.classList.length == 1 && document.body.clientWidth > 1130) {
                input.classList.add('search-form__input--visible');
            } else {
                searchRedirect(input.value);
            }
        } else if (! event.target.closest('.search-form__input') && document.body.clientWidth > 1130) {
            input.classList.remove('search-form__input--visible');
        }
    });
    
    window.addEventListener('resize', toggleSearchForm);
    window.addEventListener('load', toggleSearchForm);

    function toggleSearchForm() {
        let width = event.target.innerWidth || event.target.body.clientWidth;
    
        if (width > 1130) {
            input.classList.remove('search-form__input--visible');
        } else {
            input.classList.add('search-form__input--visible');
        }
    }

    function searchRedirect(searchTerm) {
        searchTerm = searchTerm.split(' ').join('_');
        location.href = `/articles/search/${searchTerm}`;
    }
});