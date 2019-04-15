document.addEventListener('DOMContentLoaded', function() {
    let browse = document.querySelector('.file-picker__browse');
    let preview = document.querySelector('.file-picker__preview');

    if (! browse) {
        return;
    }
    
    browse.addEventListener('change', function() {
        if (! this.files[0].type.match(/image\/.*/)) {
            preview.src = '/public/img/upload.png';
            return;
        }

        let reader = new FileReader();
        reader.readAsDataURL(this.files[0]);

        reader.onload = function() {
            document.querySelector('form').elements['image'].value = reader.result;
            preview.src = reader.result;
        }
    });

    browse.addEventListener('mouseover', function() {
        this.classList.toggle('file-picker__browse--hover');
    });

    browse.addEventListener('mouseout', function() {
        this.classList.toggle('file-picker__browse--hover');
    });
});