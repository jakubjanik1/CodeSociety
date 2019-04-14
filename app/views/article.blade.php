@include('partials/head')

<div class="article">
    <img class="article__image" src="data:image/png;base64,{{ base64_encode($article->image) }}">
    <div class="article__title">{{ $article->title }}</div>
    <a class="article__category" href="/articles/category/{{ $article->category }}">{{ $article->category }}</a>

    <div class="article__content ql-editor">{!! $article->content !!}</div>
</div>

@include('partials/footer')