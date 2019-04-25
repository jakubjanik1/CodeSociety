@include('partials/head')

<div class="article">
    <p class="article__id">{{ $article->id }}</p>
    <img class="article__image" src="{{ $article->image }}">
    <div class="article__title">{{ $article->title }}</div>
    <a class="article__category" href="/articles/category/{{ $article->category }}">{{ $article->category }}</a>

    <div class="article__likes">
        <i class="likes__icon {{ in_array($article->id, $accountLikes) ? 'likes__icon--active fas' : 'far' }} fa-heart"></i>
        <div class="likes__count"> {{ $article->likes }} </div>
    </div>
    <div class="article__content ql-editor">{!! $article->content !!}</div>
</div>

<div class="comments">
    <h1 class="comments__title"></h1>
</div>

@include('partials/footer')