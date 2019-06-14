document.addEventListener('DOMContentLoaded', function() {
    if (! /article\/.+/.test(location.pathname)) return;

    let articleId = document.querySelector('.article__id').innerText;
    fetch(`/comments/article/${articleId}`)
        .then(res => res.json())
        .then(comments => displayComments(comments));
});

function displayComments(comments) {
    let commentsContainer = document.querySelector('.comments');
    
    let title = commentsContainer.querySelector('.comments__title');
    title.innerHTML = `${comments.length} Comments`;

    for (let comment of comments) {
        commentsContainer.append(createComment(comment));
    }
}

function createComment(comment) {
    let commentElem = document.createElement('div');
    commentElem.classList.add('comments__comment');

    let image = document.createElement('img');
    image.classList.add('comment__image');
    image.src = comment.image ? comment.image : '/public/img/account.png';

    let commentInfo = document.createElement('div');
    commentInfo.classList.add('comment__info');
    commentElem.append(commentInfo);

    let author = document.createElement('a');
    author.href = `/account/${comment.login}/view`;
    author.classList.add('comment__author');
    author.innerText = comment.login;

    let date = document.createElement('span');
    date.classList.add('comment__date');
    date.innerText = moment(comment.written).fromNow();

    commentInfo.append(author, date);

    let content = document.createElement('pre');
    content.classList.add('comment__content');
    content.innerHTML = comment.content;

    commentElem.append(image, content);

    return commentElem;
}