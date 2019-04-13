@include('partials/admin-head')

<main class="admin__authentication">
    <h1 class="authentication__title">Admin</h1>

    <form class="authentication__form" action="/admin/authenticate" method="POST" autocomplete="off">
        <img class="form__logo" src="/public/img/icon.png">

        <input class="form__input" name="name" type="text" placeholder="Username">
        <input class="form__input" name="password" type="password" placeholder="Password">
        <input class="form__button form__button--primary" type="submit" value="Login">

        <span class="form__error"> {{ $error ?? '' }} </span>
    </form>
</main>