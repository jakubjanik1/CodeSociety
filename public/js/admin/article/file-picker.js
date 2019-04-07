document.addEventListener('DOMContentLoaded', function() {
    let browse = document.querySelector('.file-picker__browse');

    if (! browse) {
        return;
    }
    
    browse.addEventListener('change', function() {
        let reader = new FileReader();
        reader.readAsDataURL(this.files[0]);

        reader.onload = function() {
            document.querySelector('.article__form').elements['image'].value = reader.result;
            document.querySelector('.file-picker__preview').src = reader.result;
        }
    });

    browse.addEventListener('mouseover', function() {
        this.classList.toggle('file-picker__browse--hover');
    });

    browse.addEventListener('mouseout', function() {
        this.classList.toggle('file-picker__browse--hover');
    });
});