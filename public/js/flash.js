document.addEventListener('DOMContentLoaded', function() {
    let flash = document.querySelector('.flash');
    if (! flash) return;

    setTimeout(function() {
        flash.remove();
    }, 3000);

    let close = document.querySelector('.flash__close'); 
    close.addEventListener('click', function() {
        flash.remove();
    });
});