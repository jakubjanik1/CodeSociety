document.addEventListener('DOMContentLoaded', function() {
    let articles = document.querySelectorAll('.list__article-thumbnail');
    articles.forEach(function(article) {
        article.addEventListener('click', viewArticle);
    });
});

function viewArticle(event) {
    let articleSlug = event.currentTarget.children[1].innerText;
    location.href = `/article/${articleSlug}`;
}