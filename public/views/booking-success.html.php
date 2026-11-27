<main class="booking-page">
    <ol class="stepper" aria-label="Kroki rezerwacji">
        <li>1. Termin</li>
        <li>2. Dane</li>
        <li aria-current="step">3. Potwierdzenie</li>
    </ol>

    <section class="success-card" aria-labelledby="success-title">
        <p class="success-card__icon" aria-hidden="true">✓</p>
        <p class="eyebrow">Krok 3 z 3</p>
        <h1 id="success-title">Zgłoszenie wysłane</h1>
        <p class="success-card__lead">
            Dziękujemy, <?= $this->e($booking->studentName) ?>. Rezerwacja trafiła do korepetytora.
        </p>

        <dl class="success-details">
            <div>
                <dt>Numer zgłoszenia</dt>
                <dd><?= $this->e($booking->id) ?></dd>
            </div>
            <div>
                <dt>Korepetytor</dt>
                <dd><?= $this->e($booking->tutorName) ?></dd>
            </div>
            <div>
                <dt>Termin</dt>
                <dd><?= $this->e($booking->slot) ?></dd>
            </div>
            <div>
                <dt>Koszt</dt>
                <dd><?= $booking->price ?> zł</dd>
            </div>
            <div>
                <dt>Status</dt>
                <dd><span class="status status--<?= $this->e($booking->status) ?>"><?= $this->e($booking->statusLabel()) ?></span></dd>
            </div>
            <div>
                <dt>Kontakt</dt>
                <dd><?= $this->e($booking->email) ?></dd>
            </div>
        </dl>

        <?php if ($booking->note !== ''): ?>
            <div class="success-note">
                <h2>Twoja notatka</h2>
                <p><?= nl2br($this->e($booking->note)) ?></p>
            </div>
        <?php endif; ?>

        <div class="success-actions">
            <a class="button button--primary" href="/dashboard">Przejdź do moich lekcji</a>
            <a class="button button--ghost" href="/tutors/<?= $booking->tutorId ?>">Wróć do profilu</a>
        </div>

        <p class="success-card__note">
            Korepetytor potwierdzi termin. W wersji demonstracyjnej zgłoszenie jest zapisane
            w bazie PostgreSQL.
        </p>
    </section>
</main>
