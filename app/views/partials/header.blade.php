<header class="header">
    <img class="header__logo" src="/public/img/icon.png">

    <ul class="header__menu">
        <li class="menu__item"> 
            <a class="menu__link" href="/articles"> Articles </a>
        </li>
        <li class="menu__item"> 
            <a class="menu__link" href="/contact"> Contact </a>
        </li>
        <li class="menu__item">
            <a class="menu__link" href="/about"> About </a>
        </li>
    </ul>

    <div class="header__search-form">
        <input class="search-form__input" type="text" placeholder="Search here">
        <button class="search-form__button">
            <i class="search-form__icon material-icons"> search </i>
        </button>
    </div>

    <div class="header__items">
        @php $account = Core\Session::get('account') @endphp
        @if (Core\Session::get('logged_in'))
            <img class="items__account-image" src="{{ $account->image ? 'data:image/png;base64,' . base64_encode($account->image) : '/public/img/account.png' }}">
            <div class="items__account-login">{{ $account->login }}</div>
            <a class="items__account-logout" href="/account/logout" title="Logout">
                <i class="items__account-logout-icon material-icons"> power_settings_new </i>
            </a>
        @else
            <a class="items__button items__button--secondary" href="/account/login">Login</a>
            <a class="items__button items__button--primary" href="/account/register">Register</a>
        @endif
    </div>

    <button class="header__toggle">
        <i class="toggle__icon material-icons"> menu </i>
    </button>
</header>