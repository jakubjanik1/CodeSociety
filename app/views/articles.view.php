<?php require 'partials/head.php' ?>
    <div class="articles">
        <h1 class="articles__title">Articles</h1>

        <ul class="articles__categories">
            <li class="categories__item">
               <a class="categories__link" href="/articles">All</a>
            </li>
            <?php foreach ($categories as $category): ?>
                    <li class="categories__item">
                        <a class="categories__link" href="/articles/category/<?= $category ?>"> <?= $category ?> </a>
                    </li>
            <?php endforeach ?>
        </ul>

        <div class="articles__list">
            <?php foreach ($articles as $article): ?>         
                <article class="list__article">
                    <p class="article__id"><?= $article->id ?></p>
                    <img class="article__thumbnail" src="data:image/png;base64, <?= base64_encode($article->thumbnail) ?> ">
                    <h1 class="article__title"> <?= $article->title ?> </h1>
                    <a class="article__category" href="/articles/category/<?= $article->category ?>"><?= $article->category ?></a>
                    <h2 class="article__date"> <?= Carbon\Carbon::parse($article->date)->diffForHumans() ?> </h2>
                </article>
            <?php endforeach ?>
        </div>

        <?php $uri = trim(preg_replace('/\/page\/\d+/', '', $_SERVER['REQUEST_URI']), '/') ?>
        <div class="articles__pagination">
            <button class="pagination__button pagination__button--prev"> PREV </button>

            <?php for ($page = 1; $page <= $totalPages; $page++): ?>    
                <a class="pagination__link" href="/<?= $uri ?>/page/<?= $page ?>"><?= $page ?></a>
            <?php endfor; ?>

            <button class="pagination__button pagination__button--next"> NEXT </button>
        </div>
    </div>
<?php require 'partials/footer.php' ?>