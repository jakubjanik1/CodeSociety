<?php require 'partials/head.php' ?>
    <?php foreach ($categories as $category): ?>
        <?php 
            echo "<a href='/articles/category/{$category}'>{$category}</a>";
        ?>
    <?php endforeach; ?>

    <?php foreach ($articles as $article): ?>
        <br>
        <?= $article->id ?> <br>
        <?= $article->title ?> <br>
        <?= $article->category ?> <br>
        <?= '<img src="data:image/png;base64,' . base64_encode($article->thumbnail) . '">' ?>
        <hr>
    <?php endforeach; ?>

    <?php for ($page = 1; $page <= $totalPages; $page++): ?>
        <?php 
            $uri = trim(preg_replace('/\/page\/\d+/', '', $_SERVER['REQUEST_URI']), '/');
            echo "<a href='/{$uri}/page/{$page}'>{$page}</a>";
        ?>
    <?php endfor; ?>
<?php require 'partials/footer.php' ?>