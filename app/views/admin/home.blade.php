@include('partials/admin')

<main class="admin__home">
    <h1 class="home__title">Home</h1> 

    <div class="home__grid">
        <div class="home__subtitle"> Daily activities </div>

        <div class="home__card home__card--stats">
            <i class="card__icon fas fa-eye"></i>
            <div class="card__category"> Visits </div>
            <div class="card__value">{{ $visits }}</div>
        </div>

        <div class="home__card home__card--stats">
            <i class="card__icon fas fa-users"></i>
            <div class="card__category"> New accounts </div>
            <div class="card__value">{{ $newAccounts }}</div>
        </div>

        <div class="home__card home__card--stats">
            <i class="card__icon fas fa-comments"></i>
            <div class="card__category"> New comments </div>
            <div class="card__value">{{ $newComments }}</div>
        </div>

        <div class="home__card home__card--stats">
            <i class="card__icon far fa-newspaper"></i>
            <div class="card__category"> New articles </div>
            <div class="card__value">{{ $newArticles }}</div>
        </div>

        <div class="home__card home__card--chart">
            {!! $visitsChart !!}
            <script> loadChartJsPhp() </script>
        </div>
    </div>
</main>