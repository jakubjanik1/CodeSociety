<?php require __DIR__ . '/../partials/admin.php' ?>

<main class="admin__articles">
    <h1 class="articles__title">Articles</h1>

    <table class="articles__table">
        <tr class="table__row table__row--heading">
            <th class="table__cell table__cell--heading">#</th>
            <th class="table__cell table__cell--heading">Title</th>
            <th class="table__cell table__cell--heading">Image</th>
            <th class="table__cell table__cell--heading">Category</th>
            <th class="table__cell table__cell--heading">Date</th>
            <th class="table__cell table__cell--heading">Action</th>
        </tr>

        <?php foreach ($articles as $article): ?>
            <tr class="table__row">
                <td class="table__cell"> <?= $article->id ?> </td>
                <td class="table__cell"> <?= $article->title ?> </td>
                <td class="table__cell"> 
                    <img class="cell__image" src="data:image/png;base64, <?= base64_encode($article->image) ?> ">
                </td>
                <td class="table__cell"> <?= $article->category ?> </td>
                <td class="table__cell"> <?= date('M d, Y', strtotime($article->date)) ?> </td>
                <td class="table__cell">
                    <a class="cell__link" href="/admin/article/edit/<?= $article->id ?>">
                        <i class="cell__icon material-icons"> edit </i>
                    </a>
                    <a class="cell_link" href="/admin/article/delete/<?= $article->id ?>">
                        <i class="cell__icon material-icons"> delete </i>
                    </a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</main>