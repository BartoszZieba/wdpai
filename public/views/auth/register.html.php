<?php
$errors = isset($errors) && is_array($errors) ? $errors : [];
$name = isset($name) && is_string($name) ? $name : '';
$email = isset($email) && is_string($email) ? $email : '';
$role = isset($role) && is_string($role) ? $role : 'student';
$roles = isset($roles) && is_array($roles) ? $roles : ['student' => 'Uczeń', 'tutor' => 'Korepetytor'];
$consent = isset($consent) && $consent === true;
$notice = isset($notice) && is_string($notice) ? $notice : null;
$csrfToken = isset($csrfToken) && is_string($csrfToken) ? $csrfToken : '';
$hasErrors = $errors !== [];
$roleDescriptions = [
    'student' => 'Rezerwuję korepetycje i zarządzam swoimi lekcjami.',
    'tutor' => 'Chcę przyjmować zgłoszenia. Profil zatwierdza administrator.',
];
?>
<main class="auth-page">
    <div class="auth-shell">
        <section class="auth-card" aria-labelledby="register-title">
            <p class="eyebrow">Nowe konto</p>
            <h1 id="register-title">Załóż konto</h1>
            <p class="auth-card__intro">
                Dołącz jako uczeń albo korepetytor. Zaczynasz od jednego konta i jednej roli.
            </p>

            <?php if ($notice !== null): ?>
                <div class="auth-notice" role="status">
                    <strong>Formularz wysłany.</strong>
                    <?= $this->e($notice) ?>
                </div>
            <?php endif; ?>

            <?php if ($hasErrors): ?>
                <div class="form-alert" id="register-errors" role="alert" tabindex="-1">
                    <h2>Nie udało się utworzyć konta</h2>
                    <ul>
                        <?php foreach ($errors as $message): ?>
                            <li><?= $this->e((string) $message) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form
                class="auth-form"
                action="/register"
                method="post"
                novalidate
                <?= $hasErrors ? 'aria-describedby="register-errors"' : '' ?>
            >
                <input type="hidden" name="csrf_token" value="<?= $this->e($csrfToken) ?>">

                <div class="field">
                    <label for="register-name">Imię i nazwisko</label>
                    <input
                        type="text"
                        id="register-name"
                        name="name"
                        value="<?= $this->e($name) ?>"
                        autocomplete="name"
                        minlength="3"
                        maxlength="80"
                        required
                        <?= isset($errors['name']) ? 'aria-invalid="true" aria-describedby="register-name-error"' : '' ?>
                    >
                    <?php if (isset($errors['name'])): ?>
                        <p class="field-error" id="register-name-error"><?= $this->e($errors['name']) ?></p>
                    <?php endif; ?>
                </div>

                <div class="field">
                    <label for="register-email">Adres e-mail</label>
                    <input
                        type="email"
                        id="register-email"
                        name="email"
                        value="<?= $this->e($email) ?>"
                        autocomplete="email"
                        inputmode="email"
                        maxlength="120"
                        required
                        <?= isset($errors['email']) ? 'aria-invalid="true" aria-describedby="register-email-error"' : '' ?>
                    >
                    <?php if (isset($errors['email'])): ?>
                        <p class="field-error" id="register-email-error"><?= $this->e($errors['email']) ?></p>
                    <?php endif; ?>
                </div>

                <div class="auth-form__row">
                    <div class="field">
                        <label for="register-password">Hasło</label>
                        <input
                            type="password"
                            id="register-password"
                            name="password"
                            autocomplete="new-password"
                            minlength="8"
                            required
                            <?= isset($errors['password']) ? 'aria-invalid="true" aria-describedby="register-password-error"' : '' ?>
                        >
                        <?php if (isset($errors['password'])): ?>
                            <p class="field-error" id="register-password-error"><?= $this->e($errors['password']) ?></p>
                        <?php else: ?>
                            <p class="field-hint">Minimum 8 znaków.</p>
                        <?php endif; ?>
                    </div>

                    <div class="field">
                        <label for="register-password-confirm">Powtórz hasło</label>
                        <input
                            type="password"
                            id="register-password-confirm"
                            name="password_confirm"
                            autocomplete="new-password"
                            minlength="8"
                            required
                            <?= isset($errors['password_confirm']) ? 'aria-invalid="true" aria-describedby="register-password-confirm-error"' : '' ?>
                        >
                        <?php if (isset($errors['password_confirm'])): ?>
                            <p class="field-error" id="register-password-confirm-error"><?= $this->e($errors['password_confirm']) ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <fieldset class="auth-roles" <?= isset($errors['role']) ? 'aria-describedby="register-role-error"' : '' ?>>
                    <legend>Chcę założyć konto jako</legend>
                    <?php foreach ($roles as $value => $label): ?>
                        <label class="role-option" for="role-<?= $this->e((string) $value) ?>">
                            <input
                                type="radio"
                                id="role-<?= $this->e((string) $value) ?>"
                                name="role"
                                value="<?= $this->e((string) $value) ?>"
                                <?= $role === $value ? 'checked' : '' ?>
                                required
                            >
                            <span>
                                <strong><?= $this->e((string) $label) ?></strong>
                                <small><?= $this->e($roleDescriptions[$value] ?? '') ?></small>
                            </span>
                        </label>
                    <?php endforeach; ?>
                    <?php if (isset($errors['role'])): ?>
                        <p class="field-error" id="register-role-error"><?= $this->e($errors['role']) ?></p>
                    <?php endif; ?>
                </fieldset>

                <div class="checkbox-field">
                    <input
                        type="checkbox"
                        id="register-consent"
                        name="consent"
                        value="1"
                        <?= $consent ? 'checked' : '' ?>
                        required
                        <?= isset($errors['consent']) ? 'aria-invalid="true" aria-describedby="register-consent-error"' : '' ?>
                    >
                    <label for="register-consent">
                        Akceptuję regulamin i politykę prywatności oraz zgadzam się na kontakt w sprawie lekcji.
                    </label>
                </div>
                <?php if (isset($errors['consent'])): ?>
                    <p class="field-error" id="register-consent-error"><?= $this->e($errors['consent']) ?></p>
                <?php endif; ?>

                <button class="button button--primary auth-form__submit" type="submit">
                    Utwórz konto
                </button>
            </form>

            <p class="auth-switch">
                Masz już konto?
                <a href="/login">Zaloguj się</a>
            </p>

            <p class="auth-stage-note">
                Etap przed bazą danych: formularz jest gotowy, a konta podłączymy do PostgreSQL w Lab 7/9.
            </p>
        </section>

        <aside class="auth-aside" aria-labelledby="register-aside-title">
            <p class="eyebrow">MaturaKorki</p>
            <h2 id="register-aside-title">Ucz się z kimś, kto zna Twój dział.</h2>
            <p>
                Wybierz poziom i temat, porównaj profile, a potem zarezerwuj wolny termin online.
            </p>
            <ul class="auth-benefits">
                <li>Profile korepetytorów zatwierdzane przez admina.</li>
                <li>Opinie tylko po zakończonej lekcji.</li>
                <li>Jedna rola na koncie — bez mieszania uczniów i korepetytorów.</li>
            </ul>
            <p class="auth-aside__note">
                Chcesz uczyć? <a href="/register?role=tutor">Załóż profil korepetytora</a>.
            </p>
        </aside>
    </div>
</main>
