document.addEventListener('DOMContentLoaded', function() {
    let large = getLargePagination();
    let medium = getMediumPagination();
    let small = getSmallPagination();

    window.addEventListener('resize', () => changePagination(large, medium, small));
    window.addEventListener('load', () => changePagination(large, medium, small));
});

function changePagination(large, medium, small) {
    let pagination = document.querySelector('.articles__pagination');

    let width = event.type == 'load' ? event.target.body.clientWidth : event.target.innerWidth;

    if (width <= pagination.clientWidth + 64) {
        pagination.innerHTML = medium.innerHTML;
    }

    if (width <= pagination.clientWidth + 64) {
        pagination.innerHTML = small.innerHTML;
    }

    if (width > medium.width + 64) {
        pagination.innerHTML = medium.innerHTML;
    }

    if (width > large.width + 64) {
        pagination.innerHTML = large.innerHTML;
    }

    pagination.querySelector('.pagination__button--prev').addEventListener('click', prevPage);
    pagination.querySelector('.pagination__button--next').addEventListener('click', nextPage);

    for (let link of pagination.querySelectorAll('.pagination__link')) {
        if (link.innerText == getCurrentPage()) {
            link.classList.add('pagination__link--current');
        }
    }
}

function getLargePagination() {
    let pagination = document.querySelector('.articles__pagination').cloneNode(true);

    pagination = setWidth(pagination);
    return pagination;
}

function getMediumPagination() {
    let pagination = document.querySelector('.articles__pagination').cloneNode(true);
    let links = pagination.querySelectorAll('.pagination__link');

    let currentPage = getCurrentPage();
    let newLinks = [`1`, `${currentPage - 1}`, `${currentPage}`, `${currentPage + 1}`, `${links.length}`];

    for (let link of links) {
        if (! newLinks.includes(link.innerText)) {
            link.remove();
        }
    }

    if (! [1, 2, 3].includes(currentPage)) {
        createLeftDelimiter(pagination);
    }
    
    let length = links.length;
    if (! [length, length - 1, length - 2].includes(currentPage)) {
        createRightDelimiter(pagination);
    }

    pagination = setWidth(pagination);
    return pagination;
}

function getSmallPagination() {
    let pagination = document.querySelector('.articles__pagination').cloneNode(true);
    let links = pagination.querySelectorAll('.pagination__link');

    let currentPage = getCurrentPage();

    for (let link of links) {
        if (link.innerText != currentPage) {
            link.remove();
        }
    }

    pagination = setWidth(pagination);
    return pagination;
}

function setWidth(pagination) {
    pagination.style.display = 'inline-flex';
    document.body.append(pagination);

    pagination.width = pagination.clientWidth;

    document.body.removeChild(pagination);

    return pagination;
}

function getCurrentPage() {
    let match = location.href.match(/page\/\d*/);
    let currentPage = match != null ? +match[0].split('/')[1] : 1;

    return currentPage;
}

function nextPage() {
    let currentPage = getCurrentPage();
    let lastPage = event.target.parentElement.children.length - 2;

    if (currentPage != lastPage) {
        let uri = location.href.replace(/\/page\/\d*/, '');
        location.href = `${uri}/page/${currentPage + 1}`;
    }
}

function prevPage() {
    let currentPage = getCurrentPage();

    if (currentPage != 1) {
        location.href = location.href.replace(/page\/\d*/, `page/${currentPage - 1}`);
    }   
}

function createLeftDelimiter(pagination) {
    let delimiter = document.createElement('i');
    delimiter.classList.add('pagination__delimiter', 'material-icons');
    delimiter.innerHTML = 'more_horiz';

    let prevButton =  pagination.querySelector('.pagination__button--prev');
    prevButton.parentNode.insertBefore(delimiter, prevButton.nextSibling.nextSibling.nextSibling);
}

function createRightDelimiter(pagination) {
    let delimiter = document.createElement('i');
    delimiter.classList.add('pagination__delimiter', 'material-icons');
    delimiter.innerHTML = 'more_horiz';

    let nextButton =  pagination.querySelector('.pagination__button--next');
    nextButton.parentNode.insertBefore(delimiter, nextButton.previousSibling.previousSibling);
}