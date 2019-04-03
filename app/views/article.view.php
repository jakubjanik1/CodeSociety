<?php require 'partials/head.php' ?>

<article class="article">
    <img class="article__image" src="data:image/png;base64, <?= base64_encode($article->image) ?> ">
    <h2 class="article__title"> <?= $article->title ?> </h2>
    <a class="article__category" href="/articles/category/<?= $article->category ?>"><?= $article->category ?></a>

    <div class="article__content"> <?= $article->content ?> </div>
</article>

<?php require 'partials/footer.php' ?>