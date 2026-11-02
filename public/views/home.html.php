<?php require __DIR__ . '/partials/head.html.php'; ?>
<?php require __DIR__ . '/partials/header.html.php'; ?>

<?php $heroTutor = $featuredTutors[0] ?? null; ?>

<main class="home">
    <section class="hero" aria-labelledby="hero-title">
        <div class="hero__content">
        <p class="eyebrow">Matematyka do matury · podstawa i rozszerzenie</p>
        <h1 id="hero-title">Ogarnij maturę z matematyki z korepetytorem, który zna Twój dział.</h1>
        <p class="hero__lead">
            Porównaj profile, sprawdź opinie i zarezerwuj termin online.
            Bez grup na Facebooku i ustalania ceny w DM.
        </p>

        <form class="search-form" action="/tutors" method="get">
            <div class="field">
                <label for="level">Poziom</label>
                <select id="level" name="level">
                    <option value="">Dowolny poziom</option>
                    <?php foreach ($levels as $level): ?>
                        <option value="<?= $this->e($level) ?>"><?= $this->e($level) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="field">
                <label for="topic">Dział</label>
                <select id="topic" name="topic">
                    <option value="">Dowolny dział</option>
                    <?php foreach ($topics as $topic): ?>
                        <option value="<?= $this->e($topic) ?>"><?= $this->e($topic) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit">Szukaj korepetytora</button>
        </form>

        <p class="hero__note">Online, w terminach, które Ci pasują.</p>
        </div>

        <?php if ($heroTutor !== null): ?>
            <aside class="hero-card" aria-label="Przykładowy profil korepetytora">
                <div class="hero-card__top">
                    <p class="avatar" aria-hidden="true"><?= $this->e($heroTutor['initials']) ?></p>
                    <div class="hero-card__identity">
                        <p class="hero-card__name">
                            <a href="/tutors/<?= (int) $heroTutor['id'] ?>"><?= $this->e($heroTutor['name']) ?></a>
                        </p>
                        <p class="hero-card__meta">
                            <?= $this->e($heroTutor['level']) ?> · <?= (int) $heroTutor['price'] ?> zł/h
                        </p>
                    </div>
                    <p class="rating">
                        <span aria-hidden="true">★</span>
                        <?= $this->e((string) $heroTutor['rating']) ?>
                    </p>
                </div>

                <p class="hero-card__topic"><?= $this->e($heroTutor['topics'][0] ?? '') ?></p>

                <ul class="hero-card__slots" aria-label="Najbliższe terminy">
                    <?php foreach (array_slice($heroTutor['slots'], 0, 2) as $slot): ?>
                        <li><?= $this->e($slot) ?></li>
                    <?php endforeach; ?>
                </ul>

                <a class="hero-card__link" href="/tutors/<?= (int) $heroTutor['id'] ?>">
                    Zobacz profil <span aria-hidden="true">→</span>
                </a>
            </aside>
        <?php endif; ?>
    </section>

    <section class="trust" aria-label="Zaufanie">
        <ul>
            <li>
                <h2>Profile zatwierdzane przez admina</h2>
                <p>Weryfikujemy wiedzę i doświadczenie.</p>
            </li>
            <li>
                <h2>Opinie tylko po zakończonej lekcji</h2>
                <p>Czytasz recenzje od realnych uczniów, bez znajomych i kupowanych poleceń.</p>
            </li>
            <li>
                <h2>Ceny i terminy jawne od początku</h2>
                <p>Bez pytania o stawkę i żmudnego pisania wiadomości prywatnych.</p>
            </li>
        </ul>
    </section>

    <section id="jak-to-dziala" class="how" aria-labelledby="how-title">
        <p class="eyebrow">Prosty proces</p>
        <h2 id="how-title">Jak to działa</h2>

        <ol>
            <li>
                <h3>Wybierz dział</h3>
                <p>Wskaż poziom i temat, z którym masz problem. Niezależnie czy to rachunek różniczkowy, czy proste równania.</p>
            </li>
            <li>
                <h3>Porównaj profile</h3>
                <p>Cena, doświadczenie, opinie i najbliższe terminy w jednym miejscu. Zobacz styl pracy korepetytora przed lekcją.</p>
            </li>
            <li>
                <h3>Zarezerwuj termin</h3>
                <p>Wyślij zgłoszenie, a korepetytor potwierdzi je w swoim panelu. Link do tablicy online otrzymasz natychmiast.</p>
            </li>
        </ol>
    </section>

    <section class="featured" aria-labelledby="featured-title">
        <h2 id="featured-title">Korepetytorzy z wolnymi terminami</h2>
        <p>Sprawdzeni, z opiniami po lekcjach.</p>

        <ul class="tutor-grid">
            <?php foreach ($featuredTutors as $tutor): ?>
                <li>
                    <?php require __DIR__ . '/partials/tutor-card.html.php'; ?>
                </li>
            <?php endforeach; ?>
        </ul>

        <a href="/tutors">Zobacz wszystkich korepetytorów →</a>
    </section>

    <section class="benefits" aria-labelledby="benefits-title">
        <h2 id="benefits-title">Dlaczego MaturaKorki?</h2>

        <ul>
            <li>
                <h3>Skupienie na maturze</h3>
                <p>Działy i poziomy zamiast ogólnych ogłoszeń. Trafiasz do kogoś, kto uczy dokładnie tego, czego potrzebujesz.</p>
            </li>
            <li>
                <h3>Zaufanie bez zgadywania</h3>
                <p>Opinie wystawiają tylko uczniowie po zakończonej lekcji. Żadnych gwiazdek od znajomych.</p>
            </li>
            <li>
                <h3>Terminy bez DM</h3>
                <p>Rezerwacja i status w panelu. Widzisz, czy lekcja jest przyjęta, zanim zaczniesz się pakować.</p>
            </li>
        </ul>
    </section>

    <section id="dla-korepetytorow" class="tutor-cta" aria-labelledby="tutor-cta-title">
        <h2 id="tutor-cta-title">Uczysz matematyki?</h2>
        <p>Dołącz jako korepetytor. Ustaw dostępność, przyjmuj zgłoszenia i buduj opinie.</p>
        <a class="button button--primary" href="#">Załóż profil korepetytora</a>
        <a href="#jak-to-dziala">Zobacz, jak to działa</a>
    </section>
</main>

<?php require __DIR__ . '/partials/footer.html.php'; ?>
<?php require __DIR__ . '/partials/foot.html.php'; ?>
