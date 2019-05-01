document.addEventListener('DOMContentLoaded', function() {
    let subscribe = document.querySelector('.newsletter__button');
    let email = document.querySelector('.newsletter__input');

    subscribe.addEventListener('click', function() {
        if (email.validity.valid) {
            removeErrorMessage(this.parentElement);

            addSubscriber(email.value);
            
            showResult(this, 'Thank you for subscribe!');
        } else {
            addErrorMessage(this.parentElement, 'It is not correct email!');
        }
    });
});

function addErrorMessage(element, message) {
    if (! element.querySelector('.newsletter__error')) {
        let error = document.createElement('div');
        error.classList.add('newsletter__error');
        error.innerText = message;

        element.appendChild(error);
    }
}

function removeErrorMessage(element) {
    let error = element.querySelector('.newsletter__error');
    error && error.remove();
}

function addSubscriber(email) {
    let http = new XMLHttpRequest();
    http.open('POST', `/newsletter/subscribe`, true);
    http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    http.send(`email=${email}`);
}

function showResult(element, message) {
    element.previousElementSibling.remove();
    element.nextElementSibling && element.nextElementSibling.remove();
    element.remove();

    let result = document.createElement('div');
    result.classList.add('newsletter__result');
    result.innerText = message;

    document.querySelector('.footer__newsletter').appendChild(result);
}