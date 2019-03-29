document.addEventListener('DOMContentLoaded', function() {
    if (location.href.includes('search')) {
        document.querySelector('.articles__categories').remove();
    } else {
        document.querySelector('.articles__search-info').remove();
    }

    let articles = document.querySelector('.articles__list');
    let pagination = document.querySelector('.articles__pagination');

    if (location.href.includes('search') && !articles.children.length) {
        articles.remove();
        pagination.remove();

        let title = document.createElement('div');
        title.classList.add('articles__nothing-found-title');
        title.innerHTML = 'Nothing found';

        let comment = document.createElement('div');
        comment.classList.add('articles__nothing-found-comment');
        comment.innerHTML = 'Sorry, but nothing matched your search terms.';

        document.querySelector('.articles').appendChild(title);
        document.querySelector('.articles').appendChild(comment);
    }
});