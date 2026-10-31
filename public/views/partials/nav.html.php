<?php
$variant = $navVariant ?? 'public';
?>
<nav aria-label="<?= $variant === 'app' ? 'Nawigacja aplikacji' : ($variant === 'minimal' ? 'Nawigacja rezerwacji' : 'Nawigacja główna') ?>">
    <?php if ($variant === 'app'): ?>
        <a href="/tutors">Szukaj</a>
        <a href="/dashboard" aria-current="page">Moje lekcje</a>
    <?php elseif ($variant === 'minimal'): ?>
        <a href="/tutors/<?= (int) ($tutor['id'] ?? 1) ?>">← Wróć do profilu</a>
    <?php else: ?>
        <a href="/#jak-to-dziala">Jak to działa</a>
        <a href="/tutors">Korepetytorzy</a>
        <a href="/dashboard">Moje lekcje</a>
        <a href="/#dla-korepetytorow">Dla korepetytorów</a>
    <?php endif; ?>
</nav>
