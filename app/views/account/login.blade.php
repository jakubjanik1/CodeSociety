@include('partials/head')

<main class="login">
    <h1 class="login__title">Login</h1>

    <form class="login__form" action="/account/login" method="POST" spellcheck="false" autocomplete="off">
        <div class="form__label">
            Login
            <input class="form__input" name="login">
        </div>

        <div class="form__label">
            Password
            <input class="form__input" name="password" type="password">
        </div>

        <div class="form__buttons">
            <a class="form__button form__button--secondary" href="/articles"> Cancel </a>
            <input class="form__button form__button--primary" type="submit" value="Log in">
        </div>

        <div class="form__error">{{ $error ?? '' }}</div>
    </form>
</main>

@include('partials/footer')