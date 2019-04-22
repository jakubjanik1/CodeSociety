document.addEventListener('DOMContentLoaded', function() {
    let likeButtons = document.querySelectorAll('.likes__icon');
    
    if (! document.querySelector('.items__account-login')) {
        likeButtons.forEach(button => button.addEventListener('click', function() {
            event.stopPropagation();
        }));

        return;
    }

    likeButtons.forEach(button => button.addEventListener('click', function() {
        if (button.classList.contains('far')) {
            button.classList.replace('far', 'fas');

            let likes = button.nextElementSibling.innerText;
            likes++;
            button.nextElementSibling.innerText = likes;
        } else {
            button.classList.replace('fas', 'far');

            let likes = button.nextElementSibling.innerText;
            likes--;
            button.nextElementSibling.innerText = likes;
        }

        let articleId = this.parentElement.parentElement.firstElementChild.innerText;
        let http = new XMLHttpRequest();
        http.open('GET', `/article/${articleId}/like`);
        http.send();

        button.classList.toggle('likes__icon--active')
        event.stopPropagation();
    }));
});