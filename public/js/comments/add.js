document.addEventListener('DOMContentLoaded', function() {
    if (! document.querySelector('.items__account-login') || ! /article\/.+/.test(location.href)) return;

    let content = document.querySelector('.add__content');
    content.addEventListener('click', function() {
        this.parentElement.classList.add('comments__add--open'); 
    });

    let button = document.querySelector('.add__button');
    button.addEventListener('click', function() {
        if (content.innerText == '') {
            content.setAttribute('placeholder', 'You must write sth!!!');
            return;
        }

        let formData = new FormData();
        formData.append('content', content.innerText);
        formData.append('article_id', location.pathname.match(/\d+$/).pop());

        let fetchData = {
            method: 'POST',
            body: formData,
            header: new Headers()
        };
        
        fetch('/comments/add', fetchData)
            .then(res => res.json())
            .then(comment => {
                let add = document.querySelector('.comments__add');
                add.parentElement.insertBefore(createComment(comment), add.nextElementSibling);
                
                content.innerHTML = '';
            })
        
    });
});