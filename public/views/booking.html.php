<?php require __DIR__ . '/partials/head.html.php'; ?>

<header class="site-header site-header--minimal">
    <a class="site-logo" href="/">MaturaKorki</a>
    <?php $navVariant = 'minimal'; require __DIR__ . '/partials/nav.html.php'; ?>
</header>

<main>
    <ol class="stepper" aria-label="Kroki rezerwacji">
        <li aria-current="step">1. Termin</li>
        <li>2. Dane</li>
        <li>3. Potwierdzenie</li>
    </ol>

    <section class="booking-summary" aria-labelledby="booking-tutor-title">
        <p class="avatar" aria-hidden="true"><?= $this->e($tutor['initials']) ?></p>
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

    <?php if ($selectedSlot !== ''): ?>
        <p role="status">Wybrany termin: <strong><?= $this->e($selectedSlot) ?></strong></p>
    <?php endif; ?>

    <form class="booking-form" action="/booking" method="get">
        <input type="hidden" name="tutor" value="<?= (int) $tutor['id'] ?>">

        <fieldset>
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
                            >
                            <label for="slot-<?= (int) $index ?>"><?= $this->e($slot) ?></label>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </fieldset>

        <div class="field">
            <label for="note">Twoja notatka (opcjonalnie)</label>
            <textarea id="note" name="note" rows="4" maxlength="300"
                      placeholder="Np. mam problem z wektorami. Max 300 znaków."><?= $this->e($note) ?></textarea>
            <p><small>Maksymalnie 300 znaków.</small></p>
        </div>

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

        <button class="button button--primary" type="submit">Wyślij zgłoszenie</button>
        <p>Płatność po lekcji — bez opłat online.</p>
    </form>
</main>

<footer class="site-footer site-footer--minimal">
    <p><small>&copy; 2026 MaturaKorki. Projekt studencki.</small></p>
</footer>

<?php require __DIR__ . '/partials/foot.html.php'; ?>
