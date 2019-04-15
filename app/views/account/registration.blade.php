@include('partials/head')

<main class="registration">
    <h1 class="registration__title">Register</h1>

    <form class="registration__form" action="/account/register" method="POST" autocomplete="off" spellcheck="false" novalidate>
        <div class="form__label">
            Firstname
            <input class="form__input" name="firstname">
        </div>

         <div class="form__label">
            Lastname
            <input class="form__input" name="lastname">
        </div>

        <div class="form__label">
            Email
            <input class="form__input" name="email" type="email">
        </div>

        <div class="form__label">
            Login
            <input class="form__input" name="login">
        </div>

        <div class="form__label">
            Password
            <input class="form__input" type="password" name="password">
        </div>

        <div class="form__label">
            Repeated password
            <input class="form__input" type="password">
        </div>

        <div class="form__label">
            Image
            <div class="form__input form__file-picker">
                <input name="image" type="hidden" value="">
                <img class="file-picker__preview" src="/public/img/upload.png">
                <input class="file-picker__browse" type="file" accept="image/*">
            </div>
        </div>

        <label class="form__label">
            <span class="form__text">Add to newsletter</span>
            <input class="form__checkbox" type="checkbox">
            <span class="form__checkmark"></span>
        </label>

        <div class="form__buttons">
            <a class="form__button form__button--secondary" href="/admin/articles"> Cancel </a>
            <input class="form__button form__button--primary" type="submit" value="Save">
        </div>
    <form>
</main>

@include('partials/footer')