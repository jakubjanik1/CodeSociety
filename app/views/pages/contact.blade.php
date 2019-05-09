@include('partials/head')

<main class="contact">
    <h1 class="contact__title">Contact</h1>
    <div class="contact__info">
        Have a question or idea? I would love to hear from you.
        Send a message and I will respond as soon as possible.
        You only have to fill out quick form. Thank you!
    </div>

    <form class="contact__form" method="POST" action="contact" spellcheck="false" autocomplete="off">
        <div class="form__label">
            Name
            <input class="form__input" name="name">
        </div>

        <div class="form__label">
            Email
            <input class="form__input" name="email">
        </div>

        <div class="form__label">
            Message
            <textarea class="form__input" name="message"></textarea>
        </div>

        <input class="form__button form__button--primary" type="submit" value="Send">
    </form>
</main>

@include('partials/footer')