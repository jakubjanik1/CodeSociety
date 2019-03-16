<?php require 'partials/head.php' ?>
    <div class="articles">
        <h1 class="articles__title">Articles</h1>

        <ul class="articles__categories">
            <li class="categories__item">
               <a class="categories__link" href="/articles/">All</a>
            </li>
            <?php foreach ($categories as $category): ?>
                    <li class="categories__item">
                        <?= "<a class='categories__link' href='/articles/category/{$category}'>{$category}</a>" ?>
                    </li>
            <?php endforeach; ?>
        </ul>

        <div class="articles__list">
            <?php foreach ($articles as $article): ?>
                <article class="list__article">
                    <?= $article->id ?>
                    <?= $article->title ?>
                    <?= $article->category ?>
                    <?= '<img src="data:image/png;base64,' . base64_encode($article->thumbnail) . '">' ?>
                </article>
            <?php endforeach; ?>
        </div>

        <div class="articles__pagination">
            <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                <?php 
                    $uri = trim(preg_replace('/\/page\/\d+/', '', $_SERVER['REQUEST_URI']), '/');
                    echo "<a class='pagination__link' href='/{$uri}/page/{$page}'>{$page}</a>";
                ?>
            <?php endfor; ?>
        </div>
    </div>
<?php require 'partials/footer.php' ?>