<?php
$errors = isset($errors) && is_array($errors) ? $errors : [];
$name = isset($name) && is_string($name) ? $name : '';
$email = isset($email) && is_string($email) ? $email : '';
$consent = isset($consent) && $consent === true;
$csrfToken = isset($csrfToken) && is_string($csrfToken) ? $csrfToken : '';
?>
<main class="booking-page">
    <ol class="stepper" aria-label="Kroki rezerwacji">
        <li aria-current="step">1. Termin</li>
        <li>2. Dane</li>
        <li>3. Potwierdzenie</li>
    </ol>

    <section class="booking-summary" aria-labelledby="booking-tutor-title">
        <p class="avatar avatar--online" aria-hidden="true"><?= $this->e($tutor['initials']) ?></p>
        <div>
            <h1 id="booking-tutor-title"><?= $this->e($tutor['name']) ?></h1>
            <p>
                <?= $this->e($tutor['level']) ?> ·
                <?= $this->e($tutor['topics'][0] ?? '') ?> ·
                <?= (int) $tutor['price'] ?> zł/h ·
                60 min · online
            </p>
        </div>
    </section>

    <?php if ($errors !== []): ?>
        <div class="form-alert" id="form-errors" role="alert" tabindex="-1">
            <h2>Nie udało się wysłać zgłoszenia</h2>
            <ul>
                <?php foreach ($errors as $message): ?>
                    <li><?= $this->e((string) $message) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($selectedSlot !== '' && !isset($errors['slot'])): ?>
        <p role="status">Wybrany termin: <strong><?= $this->e($selectedSlot) ?></strong></p>
    <?php endif; ?>

    <form
        class="booking-form"
        action="/booking"
        method="post"
        novalidate
        <?= $errors !== [] ? 'aria-describedby="form-errors"' : '' ?>
    >
        <input type="hidden" name="csrf_token" value="<?= $this->e($csrfToken) ?>">
        <input type="hidden" name="tutor" value="<?= (int) $tutor['id'] ?>">

        <fieldset <?= isset($errors['slot']) ? 'aria-describedby="slot-error"' : '' ?>>
            <legend>Wybierz termin</legend>
            <p>Strefa czasowa: Europe/Warsaw</p>

            <?php if ($tutor['slots'] === []): ?>
                <p>Brak wolnych terminów w tym tygodniu. Sprawdź później.</p>
            <?php else: ?>
                <ul class="slot-list">
                    <?php foreach ($tutor['slots'] as $index => $slot): ?>
                        <li>
                            <input
                                type="radio"
                                id="slot-<?= (int) $index ?>"
                                name="slot"
                                value="<?= $this->e($slot) ?>"
                                <?= $selectedSlot === $slot ? 'checked' : '' ?>
                                required
                            >
                            <label for="slot-<?= (int) $index ?>"><?= $this->e($slot) ?></label>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if (isset($errors['slot'])): ?>
                <p class="field-error" id="slot-error"><?= $this->e($errors['slot']) ?></p>
            <?php endif; ?>
        </fieldset>

        <div class="field">
            <label for="name">Imię i nazwisko</label>
            <input
                type="text"
                id="name"
                name="name"
                value="<?= $this->e($name) ?>"
                autocomplete="name"
                minlength="3"
                maxlength="80"
                required
                <?= isset($errors['name']) ? 'aria-invalid="true" aria-describedby="name-error"' : '' ?>
            >
            <?php if (isset($errors['name'])): ?>
                <p class="field-error" id="name-error"><?= $this->e($errors['name']) ?></p>
            <?php endif; ?>
        </div>

        <div class="field">
            <label for="email">Adres e-mail</label>
            <input
                type="email"
                id="email"
                name="email"
                value="<?= $this->e($email) ?>"
                autocomplete="email"
                maxlength="120"
                inputmode="email"
                required
                <?= isset($errors['email']) ? 'aria-invalid="true" aria-describedby="email-error"' : '' ?>
            >
            <?php if (isset($errors['email'])): ?>
                <p class="field-error" id="email-error"><?= $this->e($errors['email']) ?></p>
            <?php endif; ?>
        </div>

        <div class="field">
            <label for="note">Twoja notatka (opcjonalnie)</label>
            <textarea
                id="note"
                name="note"
                rows="4"
                maxlength="300"
                placeholder="Np. mam problem z wektorami. Max 300 znaków."
                <?= isset($errors['note']) ? 'aria-invalid="true" aria-describedby="note-error"' : '' ?>
            ><?= $this->e($note) ?></textarea>
            <?php if (isset($errors['note'])): ?>
                <p class="field-error" id="note-error"><?= $this->e($errors['note']) ?></p>
            <?php else: ?>
                <p class="field-hint">Maksymalnie 300 znaków.</p>
            <?php endif; ?>
        </div>

        <div class="checkbox-field">
            <input
                type="checkbox"
                id="consent"
                name="consent"
                value="1"
                <?= $consent ? 'checked' : '' ?>
                required
                <?= isset($errors['consent']) ? 'aria-invalid="true" aria-describedby="consent-error"' : '' ?>
            >
            <label for="consent">Akceptuję zasady rezerwacji i politykę prywatności.</label>
        </div>
        <?php if (isset($errors['consent'])): ?>
            <p class="field-error" id="consent-error"><?= $this->e($errors['consent']) ?></p>
        <?php endif; ?>

        <section aria-labelledby="summary-title">
            <h2 id="summary-title">Podsumowanie</h2>
            <dl>
                <div>
                    <dt>Lekcja 60 min</dt>
                    <dd><?= (int) $tutor['price'] ?> zł</dd>
                </div>
                <div>
                    <dt>Płatność</dt>
                    <dd>Po lekcji</dd>
                </div>
            </dl>
            <p>Bez opłat online.</p>
        </section>

        <button
            class="button button--primary"
            type="submit"
            <?= $tutor['slots'] === [] ? 'disabled' : '' ?>
        >
            Wyślij zgłoszenie
        </button>
        <p>Płatność po lekcji — bez opłat online.</p>
    </form>
</main>
