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
        </div>

        <div class="home__card home__card--chart">
            {!! $browsersChart !!}
        </div>

        <div class="home__card home__card--map">
            <div class="card__title">Visits map</div>
            <div id="card__chart--map"></div>
            {!! $visitsMap->render('GeoChart', 'Visits', 'card__chart--map') !!}
        </div>
    </div>
</main>