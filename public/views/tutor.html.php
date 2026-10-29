<?php require __DIR__ . '/partials/header.html.php'; ?>

<main>
    <nav aria-label="Ścieżka nawigacji">
        <ol>
            <li><a href="/tutors">Korepetytorzy</a></li>
            <li aria-current="page"><?= $this->e($tutor['name']) ?></li>
        </ol>
    </nav>

    <article class="profile">
        <header class="profile__header">
            <p class="avatar avatar--large" aria-hidden="true"><?= $this->e($tutor['initials']) ?></p>

            <div>
                <h1><?= $this->e($tutor['name']) ?></h1>
                <p><?= $this->e($tutor['headline']) ?></p>
                <p>
                    <span aria-hidden="true">★</span>
                    <?= $this->e((string) $tutor['rating']) ?>
                    (<?= $this->e($tutor['reviews_label']) ?>)
                </p>
                <p><?= $this->e($tutor['level']) ?> · online</p>

                <ul class="tag-list">
                    <?php foreach ($tutor['topics'] as $topic): ?>
                        <li><?= $this->e($topic) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="profile__action">
                <p><strong><?= (int) $tutor['price'] ?> zł/h</strong></p>
                <a class="button button--primary" href="/booking?tutor=<?= (int) $tutor['id'] ?>">
                    Zarezerwuj termin
                </a>
            </div>
        </header>

        <dl class="stats">
            <div>
                <dt>Lekcje</dt>
                <dd><?= (int) $tutor['lessons'] ?></dd>
            </div>
            <div>
                <dt>Ocena</dt>
                <dd><?= $this->e((string) $tutor['rating']) ?></dd>
            </div>
            <div>
                <dt>Opinie</dt>
                <dd><?= (int) $tutor['reviews_count'] ?></dd>
            </div>
            <div>
                <dt>Doświadczenie</dt>
                <dd><?= (int) $tutor['experience'] ?> lat</dd>
            </div>
        </dl>

        <section aria-labelledby="about-title">
            <h2 id="about-title">O korepetytorze</h2>
            <p><?= $this->e($tutor['bio']) ?></p>
        </section>

        <section aria-labelledby="education-title">
            <h2 id="education-title">Wykształcenie</h2>
            <p><?= $this->e($tutor['education']) ?></p>
        </section>

        <section aria-labelledby="topics-title">
            <h2 id="topics-title">Działy</h2>
            <p>Wybierz temat, nad którym chcesz pracować podczas lekcji lub cyklu spotkań.</p>
            <ul class="tag-list">
                <?php foreach ($tutor['topics'] as $topic): ?>
                    <li><?= $this->e($topic) ?></li>
                <?php endforeach; ?>
            </ul>
        </section>

        <section aria-labelledby="reviews-title">
            <h2 id="reviews-title">Opinie</h2>

            <?php if ($tutor['reviews'] === []): ?>
                <p>Opinie pojawią się po zakończonej lekcji.</p>
            <?php else: ?>
                <ul class="review-list">
                    <?php foreach ($tutor['reviews'] as $review): ?>
                        <li>
                            <article>
                                <header>
                                    <h3><?= $this->e($review['author']) ?></h3>
                                    <p>
                                        <span aria-hidden="true">★</span>
                                        <?= $this->e((string) $review['rating']) ?>
                                    </p>
                                </header>
                                <p><?= $this->e($review['comment']) ?></p>
                                <p><time><?= $this->e($review['date']) ?></time></p>
                            </article>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <a href="#">Zobacz wszystkie opinie →</a>
            <?php endif; ?>
        </section>

        <aside class="booking-card" aria-labelledby="booking-title">
            <h2 id="booking-title">Najbliższe terminy</h2>
            <p>Wybierz dogodny termin lekcji:</p>

            <ul class="slot-list">
                <?php foreach ($tutor['slots'] as $slot): ?>
                    <li>
                        <a href="/booking?<?= $this->e(http_build_query(['tutor' => $tutor['id'], 'slot' => $slot])) ?>">
                            <?= $this->e($slot) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <p><strong>Cena za lekcję: <?= (int) $tutor['price'] ?> zł</strong></p>
            <a class="button button--primary" href="/booking?tutor=<?= (int) $tutor['id'] ?>">
                Zarezerwuj termin
            </a>

            <ul>
                <li>Lekcja 60 min · online</li>
                <li>Płatność po lekcji</li>
                <li>Bez opłat online</li>
            </ul>
        </aside>
    </article>
</main>

<?php require __DIR__ . '/partials/footer.html.php'; ?>
