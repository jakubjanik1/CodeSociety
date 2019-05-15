document.addEventListener('DOMContentLoaded', function() {
    if (! location.pathname.match(/admin\/article\/(edit\/.+|add)/)) {
        return;
    }

    let form = document.querySelector('.article__form');
    let title = form.querySelector('[name=title]');
    let category = form.querySelector('[name=category]');
    let image = form.querySelector('[name=image]');
    let fileInput = form.querySelector('.file-picker__browse');
    let content = form.querySelector('.ql-editor');

    title.addEventListener('input', validateTitle);

    category.addEventListener('input', validateCategory);

    fileInput.addEventListener('change', validateImage);

    content.addEventListener('input', function() {
        if (this.innerText) {
            removeError(this.parentElement);
        }
    });

    form.addEventListener('submit', function(event) {
        if (! title.value) {
            addError(title, "You must enter title!");
        }

        if (! category.value) {
            addError(category, "You must enter category!");
        }

        if (! image.value) {
            addError(image.parentElement, "You must choose image!");
        }

        let content = form.querySelector('.ql-blank');
        if (content) {
            addError(content.parentElement, "You must write content!");
        }

        if (form.querySelectorAll('.form__error').length) {
            event.preventDefault();
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

function validateTitle() {
    if (this.value.length > 50) {
        addError(this, 'Title cannot be longer than 50!')
    } else {
        removeError(this);
    }
}

function validateCategory() {
    if (this.value.length > 20) {
        addError(this, 'Category cannot be longer than 20!');
    } else if (! this.value.match(/^[^ \.\\\+\*\?\[\^\]\$\(\)\{\}\=\!\<\>\|\:\#]*$/)) {
        addError(this, 'Category cannot contain special characters and spaces!');
    } else {
        removeError(this);
    }
}

function validateImage() {
    let url = window.URL;

    let img = new Image();
    img.src = url.createObjectURL(this.files[0]);

    img.onload = () => {
        if (! this.files[0].type.match(/image\/.*/)) {
            addError(this.parentElement, 'File must be of image type!');
        } else if (img.width < 1000 || img.height < 450) {
            addError(this.parentElement, '1000 x 450 is minimum size of image!')  
        } else {
            removeError(this.parentElement);
        }
    };
}