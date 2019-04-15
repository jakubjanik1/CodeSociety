document.addEventListener('DOMContentLoaded', function() {
    let form = document.querySelector('.registration__form');
    if (! form) return;
    
    let email = document.querySelector('[name=email]');
    let newsletter = document.querySelector('.form__checkbox');

    form.addEventListener('submit', function() {
        if (newsletter.checked) {
            let http = new XMLHttpRequest();
            http.open('POST', `/newsletter/subscribe`);
            http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            http.send(`email=${email.value}`);
        }
    });
});