document.addEventListener('DOMContentLoaded', function() {
    let categories = document.querySelector('.articles__categories');
    let searchInfo = document.querySelector('.articles__search-info');

    if (location.href.includes('search')) {
        categories && categories.remove();

        searchInfo && searchInfo.classList.add('articles__search-info--visible');
    } else {
        searchInfo && searchInfo.remove();
    }

    let articles = document.querySelector('.articles__list');
    let pagination = document.querySelector('.articles__pagination');

    if (location.href.includes('search') && articles && !articles.children.length) {
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