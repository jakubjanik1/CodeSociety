document.addEventListener('DOMContentLoaded', function () {
    document.addEventListener('click', function (event) {
        let input = document.querySelector('.search-form__input');

        if (event.target.closest('.search-form__button')) {
            if (input.style.visibility == 'hidden' || input.style.visibility == '') {
                input.style.visibility = 'visible';
            } else {
                location.href = `articles/search/${input.value}`;
            }
        } else if (! event.target.closest('.search-form__input')) {
            input.style.visibility = 'hidden';
        }
    });
});
