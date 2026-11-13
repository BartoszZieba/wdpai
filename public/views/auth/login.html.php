<?php
$errors = isset($errors) && is_array($errors) ? $errors : [];
$email = isset($email) && is_string($email) ? $email : '';
$notice = isset($notice) && is_string($notice) ? $notice : null;
$csrfToken = isset($csrfToken) && is_string($csrfToken) ? $csrfToken : '';
$hasErrors = $errors !== [];
?>
<main class="auth-page">
    <div class="auth-shell">
        <section class="auth-card" aria-labelledby="login-title">
            <p class="eyebrow">Witaj ponownie</p>
            <h1 id="login-title">Zaloguj się</h1>
            <p class="auth-card__intro">
                Wejdź do panelu, aby zobaczyć swoje lekcje i zarządzać rezerwacjami.
            </p>

            <?php if ($notice !== null): ?>
                <div class="auth-notice" role="status">
                    <strong>Formularz wysłany.</strong>
                    <?= $this->e($notice) ?>
                </div>
            <?php endif; ?>

            <?php if ($hasErrors): ?>
                <div class="form-alert" id="login-errors" role="alert" tabindex="-1">
                    <h2>Nie udało się zalogować</h2>
                    <ul>
                        <?php foreach ($errors as $message): ?>
                            <li><?= $this->e((string) $message) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form
                class="auth-form"
                action="/login"
                method="post"
                novalidate
                <?= $hasErrors ? 'aria-describedby="login-errors"' : '' ?>
            >
                <input type="hidden" name="csrf_token" value="<?= $this->e($csrfToken) ?>">

                <div class="field">
                    <label for="login-email">Adres e-mail</label>
                    <input
                        type="email"
                        id="login-email"
                        name="email"
                        value="<?= $this->e($email) ?>"
                        autocomplete="email"
                        inputmode="email"
                        maxlength="120"
                        required
                        <?= isset($errors['email']) ? 'aria-invalid="true" aria-describedby="login-email-error"' : '' ?>
                    >
                    <?php if (isset($errors['email'])): ?>
                        <p class="field-error" id="login-email-error"><?= $this->e($errors['email']) ?></p>
                    <?php endif; ?>
                </div>

                <div class="field">
                    <label for="login-password">Hasło</label>
                    <input
                        type="password"
                        id="login-password"
                        name="password"
                        autocomplete="current-password"
                        required
                        <?= isset($errors['password']) ? 'aria-invalid="true" aria-describedby="login-password-error"' : '' ?>
                    >
                    <?php if (isset($errors['password'])): ?>
                        <p class="field-error" id="login-password-error"><?= $this->e($errors['password']) ?></p>
                    <?php endif; ?>
                </div>

                <button class="button button--primary auth-form__submit" type="submit">
                    Zaloguj się
                </button>
            </form>

            <p class="auth-switch">
                Nie masz konta?
                <a href="/register">Zarejestruj się</a>
            </p>

            <p class="auth-stage-note">
                Etap przed bazą danych: formularz jest gotowy, a logowanie podłączymy do PostgreSQL w Lab 7/9.
            </p>
        </section>

        <aside class="auth-aside" aria-labelledby="login-aside-title">
            <p class="eyebrow">MaturaKorki</p>
            <h2 id="login-aside-title">Twoje lekcje w jednym miejscu.</h2>
            <p>
                Po zalogowaniu zobaczysz status rezerwacji, najbliższe terminy i historię spotkań.
            </p>
            <ul class="auth-benefits">
                <li>Rezerwacje bez ustalania ceny w DM.</li>
                <li>Opinie tylko po zakończonej lekcji.</li>
                <li>Terminy i ceny jawne od początku.</li>
            </ul>
            <p class="auth-aside__note">
                Szukasz korepetytora? <a href="/tutors">Przejdź do wyszukiwarki</a>.
            </p>
        </aside>
    </div>
</main>
