document.addEventListener('DOMContentLoaded', function() {
    let articles = document.querySelectorAll('.list__article');
    articles.forEach(function(article) {
        article.addEventListener('click', viewArticle);
    });
});

function viewArticle(event) {
    let articleId = event.currentTarget.children[0].innerText;
    location.href = `/article/${articleId}`;
}