<article class="tutor-card">
    <header class="tutor-card__header">
        <p class="avatar" aria-hidden="true"><?= $this->e($tutor['initials']) ?></p>
        <div>
            <h3>
                <a href="/tutors/<?= (int) $tutor['id'] ?>"><?= $this->e($tutor['name']) ?></a>
            </h3>
            <p><?= $this->e($tutor['headline']) ?></p>
            <p>
                <span aria-hidden="true">★</span>
                <?= $this->e((string) $tutor['rating']) ?>
                (<?= $this->e($tutor['reviews_label']) ?>)
            </p>
        </div>
    </header>

    <p class="tutor-card__level"><?= $this->e($tutor['level']) ?></p>

    <ul class="tag-list">
        <?php foreach ($tutor['topics'] as $topic): ?>
            <li><?= $this->e($topic) ?></li>
        <?php endforeach; ?>
    </ul>

    <p class="tutor-card__price"><?= (int) $tutor['price'] ?> zł/h</p>
    <p>Najbliższy termin: <time><?= $this->e($tutor['next_slot']) ?></time></p>

    <a href="/tutors/<?= (int) $tutor['id'] ?>">Zobacz profil</a>
</article>
