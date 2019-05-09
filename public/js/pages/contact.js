document.addEventListener('DOMContentLoaded', function() {
    let form = document.querySelector('.contact__form');
    if (! form) return;

    validateName(form);
    validateMail(form);
    validateMessage(form);

    form.querySelectorAll('input, textarea').forEach(function(elem) {
        elem.addEventListener('focusout', function() {
            if (event.relatedTarget.type == 'submit') {
                event.relatedTarget.click();
            }
        });
    });

    form.addEventListener('submit', function() {     
        form.querySelectorAll('input, textarea').forEach(x => x.focus());

        if (document.querySelectorAll('.form__error').length) {
            event.preventDefault();
            return;
        }
    });
});

function validateName(form) {
    let name = form.querySelector('[name=name]');
    name.addEventListener('input', function() {
        removeError(this);
    });

    name.addEventListener('focusout', function() {
        if (! this.value.trim()) {
            addError(this, 'You must enter name!');
        }
    });
}

function validateMail(form) {
    let email = form.querySelector('[name=email]');
    email.addEventListener('input', function() {
        if (this.validity.valid) {
            removeError(this);
       } else {
            removeError(this);
        }
    });

    email.addEventListener('focusout', function() {
        if (! this.value.trim()) {
            addError(this, 'You must enter email!');
        } else if (! this.validity.valid) {
            addError(this, 'This is not correct email!')
        }
    });
}

function validateMessage(form) {
    let message = form.querySelector('[name=message]');
    message.addEventListener('input', function() {
        removeError(this);
    });

    message.addEventListener('focusout', function() {
        if (! this.value.trim()) {
            addError(this, 'You must enter message!');
        }
    });
}