document.addEventListener('DOMContentLoaded', function() {
    let form = document.querySelector('.registration__form');
    if (! form) return;

    validateFirstname(form);
    validateLastname(form);
    validateEmail(form);
    validateLogin(form);
    validatePassword(form);
    validateRepeatedPassword(form);
    validateImage(form);

    let newsletter = form.querySelector('.form__checkbox');
    form.addEventListener('submit', function() {
        document.querySelectorAll('input').forEach(x => x.focus());
        
        if (document.querySelectorAll('.form__error').length) {
            event.preventDefault();
            return;
        }
        
        if (newsletter.checked) {
            let http = new XMLHttpRequest();
            http.open('POST', `/newsletter/subscribe`);
            http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            http.send(`email=${email.value}`);
        }
    });
});

function addError(input, errorMessage) {
    let currentError = input.parentElement.querySelector('.form__error');
    if (! currentError) {
        let error = document.createElement('span');
        error.classList.add('form__error');
        error.innerText = errorMessage;
    
        input.parentElement.appendChild(error);
        input.classList.add('form__input--invalid');
    } else {
        currentError.innerText = errorMessage;
    }
}

function removeError(input) {
    let error = input.parentElement.querySelector('.form__error');
    error && error.remove();

    input.classList.remove('form__input--invalid');
}

function validateFirstname(form) {
    let firstname = form.querySelector('[name=firstname]');
    firstname.addEventListener('input', function() {
        if (this.value.length > 30) {
            addError(this, 'Firstname cannot be longer than 30!')
        } else {
            removeError(this);
        }
    });

    firstname.addEventListener('focusout', function() {
        if (! this.value) {
            addError(this, 'You must enter firstname!')
        }
    });
}

function validateLastname(form) {
    let lastname = form.querySelector('[name=lastname]');
    lastname.addEventListener('input', function() {
        if (this.value.length > 30) {
            addError(this, 'Lastname cannot be longer than 30!')
        } else {
            removeError(this);
        }
    });

    lastname.addEventListener('focusout', function() {
        if (! this.value) {
            addError(this, 'You must enter lastname!')
        }
    });
}

function validateEmail(form) {
    let email = form.querySelector('[name=email]');
    email.addEventListener('input', function() {
        if (this.validity.valid) {
            removeError(this);
        } else if (this.value.length > 30) {
            addError(this, 'Email cannot be longer than 30!')
        } else {
            removeError(this);
        }
    });

    email.addEventListener('focusout', function() {
        if (! this.value) {
            addError(this, 'You must enter email!');
        } else if (! this.validity.valid) {
            addError(this, 'This is not correct email!')
        }
    });
}

function validateLogin(form) {
    let login = form.querySelector('[name=login]');
    login.addEventListener('input', function() {
        if (this.value.length > 30) {
            addError(this, 'Login canno be longer than 30!');
        } else if (! this.value.match(/^[^ \.\\\+\*\?\[\^\]\$\(\)\{\}\=\!\<\>\|\:\#]*$/)) {
            addError(this, 'Login cannot contain special characters!');
        } else {
            removeError(this);
        }
    });

    login.addEventListener('focusout', function() {
        if (! this.value) {
            addError(this, 'You must enter login!');
        } else {
            let http = new XMLHttpRequest();
            http.onreadystatechange = function() {
                if (this.response == '1') {
                    addError(login, 'This login already exists!');
                }
            };

            http.open('POST', `/account/login/exists`);
            http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            http.send(`login=${this.value}`);
        }
    });
}

function validatePassword(form) {
    let password = form.querySelector('[name=password]');
    password.addEventListener('input', function() {
        if (this.value.length > 30) {
            addError(this, 'Password cannot be longer than 30!')
        } else {
            removeError(this);
        }
    });

    password.addEventListener('focusout', function() {
        if (! this.value) {
            addError(this, 'You must enter password!')
        }
    });

}

function validateRepeatedPassword(form) {
    let [password, repeatedPassword] = form.querySelectorAll('[type=password]');
    repeatedPassword.addEventListener('input', function() {
        removeError(this);
    });

    repeatedPassword.addEventListener('focusout', function() {
        if (! this.value) {
            addError(this, 'You must repeat password!')
        } else if (this.value != password.value) {
            addError(this, 'Passwords do not match!')
        }
    });
}

function validateImage(form) {
    let fileInput = form.querySelector('.file-picker__browse');
    fileInput.addEventListener('change', function() {
        if (! this.files[0].type.match(/image\/.*/)) {
            addError(this.parentElement, 'File must be of image type!');
        } else {
            removeError(this.parentElement);
        }
    });
}