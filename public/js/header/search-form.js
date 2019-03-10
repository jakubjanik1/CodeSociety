document.addEventListener('DOMContentLoaded', function () {
    let input = document.querySelector('.search-form__input');

    document.addEventListener('click', function (event) {     
        if (event.target.closest('.search-form__button')) {
            if (input.style.visibility == 'hidden' || input.style.visibility == '' && document.body.clientWidth > 1130) {
                input.style.visibility = 'visible';
            } else {
                location.href = `articles/search/${input.value}`;
            }
        } else if (! event.target.closest('.search-form__input') && document.body.clientWidth > 1130) {
            input.style.visibility = 'hidden';
        }
    });
    
    window.addEventListener('resize', function (event) {
        let width = event.target.innerWidth;

        if (width > 1130) {
            input.style.visibility = 'hidden';
        } else {
            input.style.visibility = 'visible';
        }
    });
});


