<?php require __DIR__ . '/partials/head.html.php'; ?>

<header class="site-header site-header--app">
    <a class="site-logo" href="/">MaturaKorki</a>

    <nav aria-label="Nawigacja aplikacji">
        <a href="/tutors">Szukaj</a>
        <a href="/dashboard" aria-current="page">Moje lekcje</a>
    </nav>

    <p class="avatar" aria-label="Konto Zosi">Z</p>
</header>

<main>
    <h1>Moje lekcje</h1>
    <p>Zarządzaj rezerwacjami i opiniami.</p>

    <nav aria-label="Sekcje panelu">
        <ul>
            <li>
                <a href="/dashboard?tab=upcoming" <?= $tab === 'upcoming' ? 'aria-current="page"' : '' ?>>
                    Najbliższe (<?= (int) $counts['upcoming'] ?>)
                </a>
            </li>
            <li>
                <a href="/dashboard?tab=history" <?= $tab === 'history' ? 'aria-current="page"' : '' ?>>
                    Historia (<?= (int) $counts['history'] ?>)
                </a>
            </li>
            <li>
                <a href="/dashboard?tab=reviews" <?= $tab === 'reviews' ? 'aria-current="page"' : '' ?>>
                    Opinie (<?= (int) $counts['reviews'] ?>)
                </a>
            </li>
        </ul>
    </nav>

    <?php if ($lessons === []): ?>
        <section aria-labelledby="empty-title">
            <h2 id="empty-title">
                <?= $tab === 'history' ? 'Brak historii lekcji' : 'Nie masz jeszcze lekcji' ?>
            </h2>
            <p>Znajdź korepetytora i zarezerwuj pierwszy termin.</p>
            <a class="button button--primary" href="/tutors">Znajdź korepetytora</a>
        </section>
    <?php else: ?>
        <ul class="lesson-list">
            <?php foreach ($lessons as $lesson): ?>
                <li>
                    <article>
                        <header>
                            <h2><?= $this->e($lesson['tutor']) ?> — <?= $this->e($lesson['topic']) ?></h2>
                            <p><time><?= $this->e($lesson['date']) ?> · <?= $this->e($lesson['time']) ?></time></p>
                        </header>

                        <p><?= (int) $lesson['price'] ?> zł</p>
                        <p><strong><?= $this->e($lesson['status_label']) ?></strong></p>

                        <footer>
                            <?php if ($lesson['can_cancel']): ?>
                                <button type="button">Anuluj</button>
                            <?php endif; ?>

                            <?php if ($lesson['can_review']): ?>
                                <a href="/dashboard?tab=reviews#review-form">Wystaw opinię</a>
                            <?php endif; ?>
                        </footer>
                    </article>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if ($tab === 'reviews' && $reviewLesson !== null): ?>
        <section id="review-form" aria-labelledby="review-form-title">
            <h2 id="review-form-title">Wystaw opinię</h2>
            <p>Lekcja: <?= $this->e($reviewLesson['tutor']) ?> — <?= $this->e($reviewLesson['topic']) ?></p>

            <form action="/dashboard" method="get">
                <input type="hidden" name="tab" value="reviews">

                <fieldset>
                    <legend>Jak oceniasz lekcję?</legend>
                    <?php for ($rating = 1; $rating <= 5; $rating++): ?>
                        <label>
                            <input type="radio" name="rating" value="<?= $rating ?>">
                            <?= $rating ?>
                        </label>
                    <?php endfor; ?>
                </fieldset>

                <div class="field">
                    <label for="comment">Opinia (opcjonalnie)</label>
                    <textarea id="comment" name="comment" rows="4"
                              placeholder="Napisz, co było pomocne."></textarea>
                </div>

                <button class="button button--primary" type="submit">Wyślij opinię</button>
            </form>
        </section>
    <?php endif; ?>
</main>

<footer class="site-footer site-footer--minimal">
    <nav aria-label="Pomoc">
        <a href="#">Pomoc</a>
        <a href="#">Regulamin</a>
        <a href="#">Polityka prywatności</a>
    </nav>
    <p><small>&copy; 2026 MaturaKorki. Projekt studencki.</small></p>
</footer>

<?php require __DIR__ . '/partials/foot.html.php'; ?>
