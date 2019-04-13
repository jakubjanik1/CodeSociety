@include('partials/head')

<main class="articles">
    <h1 class="articles__title">Articles</h1>

    <ul class="articles__categories">
        <li class="categories__item">
            <a class="categories__link" href="/articles">All</a>
        </li>
        @foreach ($categories ?? [] as $category)
            <li class="categories__item">
                <a class="categories__link" href="/articles/category/{{ $category }}">{{ $category }}</a>
            </li>
        @endforeach
    </ul>

    <div class="articles__search-info">
        Search results for: <span class="search-info__term">{{ str_replace('_', ' ', $searchTerm ?? '') }}</span>
    </div>

    <div class="articles__list">
        @foreach ($articles as $article)  
            <div class="list__article-thumbnail">
                <p class="article-thumbnail__id">{{ $article->id }}</p>
                <img class="article-thumbnail__image" src="data:image/png;base64,{{ base64_encode($article->image) }}">
                <div class="article-thumbnail__title">{{ $article->title }}</div>
                <a class="article-thumbnail__category" href="/articles/category/{{ $article->category }}">{{ $article->category }}</a>
                <div class="article-thumbnail__date">{{ Carbon\Carbon::parse($article->date)->diffForHumans() }}</div>
            </div>
        @endforeach
    </div>

    @php $uri = trim(preg_replace('/\/page\/\d+/', '', $_SERVER['REQUEST_URI']), '/') @endphp
    <div class="articles__pagination">
        <button class="pagination__button pagination__button--prev"> PREV </button>

        @for ($page = 1; $page <= $totalPages; $page++)  
            <a class="pagination__link" href="/{{ $uri }}/page/{{ $page }}">{{ $page }}</a>
        @endfor

        <button class="pagination__button pagination__button--next"> NEXT </button>
    </div>
</main>

@include('partials/footer')