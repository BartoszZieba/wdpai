<?php require __DIR__ . '/partials/header.html.php'; ?>

<main>
    <nav aria-label="Ścieżka nawigacji">
        <ol>
            <li><a href="/">Strona główna</a></li>
            <li aria-current="page">Korepetytorzy</li>
        </ol>
    </nav>

    <header>
        <h1>Korepetytorzy z matematyki do matury</h1>
        <p><?= (int) $resultCount ?> profili · online · podstawa i rozszerzenie</p>
    </header>

    <form class="filters" action="/tutors" method="get">
        <div class="field">
            <label for="filter-level">Poziom</label>
            <select id="filter-level" name="level">
                <option value="">Dowolny poziom</option>
                <?php foreach ($levels as $level): ?>
                    <option value="<?= $this->e($level) ?>" <?= $filters['level'] === $level ? 'selected' : '' ?>>
                        <?= $this->e($level) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="field">
            <label for="filter-topic">Dział</label>
            <select id="filter-topic" name="topic">
                <option value="">Dowolny dział</option>
                <?php foreach ($topics as $topic): ?>
                    <option value="<?= $this->e($topic) ?>" <?= $filters['topic'] === $topic ? 'selected' : '' ?>>
                        <?= $this->e($topic) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit">Filtruj</button>
        <a href="/tutors">Wyczyść</a>
    </form>

    <?php if ($filters['level'] !== '' || $filters['topic'] !== ''): ?>
        <ul class="active-filters" aria-label="Aktywne filtry">
            <?php if ($filters['level'] !== ''): ?>
                <li>
                    <?= $this->e($filters['level']) ?>
                    <a href="/tutors?<?= $this->e(http_build_query(['topic' => $filters['topic']])) ?>"
                       aria-label="Usuń filtr poziomu">×</a>
                </li>
            <?php endif; ?>

            <?php if ($filters['topic'] !== ''): ?>
                <li>
                    <?= $this->e($filters['topic']) ?>
                    <a href="/tutors?<?= $this->e(http_build_query(['level' => $filters['level']])) ?>"
                       aria-label="Usuń filtr działu">×</a>
                </li>
            <?php endif; ?>

            <li><a href="/tutors">Wyczyść filtry</a></li>
        </ul>
    <?php endif; ?>

    <p><strong>Znaleziono <?= (int) $resultCount ?> korepetytorów</strong></p>

    <?php if ($tutors === []): ?>
        <section aria-labelledby="empty-title">
            <h2 id="empty-title">Brak korepetytorów dla tych filtrów</h2>
            <p>Spróbuj usunąć jeden z filtrów albo zmienić dział.</p>
            <a class="button button--primary" href="/tutors">Wyczyść filtry</a>
        </section>
    <?php else: ?>
        <ul class="tutor-grid">
            <?php foreach ($tutors as $tutor): ?>
                <li>
                    <?php require __DIR__ . '/partials/tutor-card.html.php'; ?>
                </li>
            <?php endforeach; ?>
        </ul>

        <p>
            <button type="button">Pokaż więcej</button>
        </p>
        <p>Opinie tylko po zakończonej lekcji.</p>
    <?php endif; ?>
</main>

<?php require __DIR__ . '/partials/footer.html.php'; ?>
