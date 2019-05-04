@include('partials/head')

<main class="view">
    <h1 class="view__title">Account</h1>

    <div class="view__wrapper">
        <img class="view__image" src="{{ $account->image }}">

        <div class="view__grid">
            <div class="view__item--label">Login: </div>
            <div class="view__item">{{ $account->login }}</div>

            <div class="view__item--label">Firstname: </div>
            <div class="view__item">{{ $account->firstname }}</div>

            <div class="view__item--label">Lastname: </div>
            <div class="view__item">{{ $account->lastname }}</div>

            <div class="view__item--label">Email: </div>
            <div class="view__item">{{ $account->email }}</div>

            <div class="view__item--label">Created at: </div>
            <div class="view__item">{{ date('M d, Y', strtotime($account->created)) }}</div>
        </div>
    </div>
</main>

@include('partials/footer')