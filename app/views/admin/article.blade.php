@include('partials/admin')

<main class="admin__article">
    <h1 class="article__title"> Article </h1>

    <form class="article__form" action="/admin/article/store" method="POST" autocomplete="off" spellcheck="false">
        <input type="hidden" name="id" value="{{ $article->id ?? '' }}">
        
        <div class="form__label">
            Title
            <input class="form__input" name="title" value="{{ $article->title ?? '' }}">
        </div>

        <div class="form__label">
            Category
            <input class="form__input" name="category" value="{{ $article->category ?? '' }}">
        </div>

        <div class="form__label">
            Image
            <div class="form__input form__file-picker">
                <input name="image" type="hidden" value="{{ base64_encode($article->image ?? '') }}">
                <img class="file-picker__preview" src="{{ $article ? 'data:image/png;base64,' . base64_encode($article->image) : '/public/img/upload.png' }}">
                <input class="file-picker__browse" type="file" accept="image/*">
            </div>
        </div>
        
        <div class="form__label">
            Content
            <div class="form__input form__editor"> {!! $article->content ?? '' !!} </div>
            <input type="hidden" name="content">
        </div>

        <div class="form__buttons">
            <a class="form__button form__button--secondary" href="/admin/articles"> Cancel </a>
            <input class="form__button form__button--primary" type="submit" value="Save">
        </div>
    </form>
</main>
