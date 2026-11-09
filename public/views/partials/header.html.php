<?php
$headerVariant = $headerVariant ?? 'public';
$isPublicHeader = $headerVariant === 'public';
$navVariant = $headerVariant === 'app' ? 'app' : ($headerVariant === 'minimal' ? 'minimal' : 'public');
?>
<header class="site-header<?= $headerVariant === 'minimal' ? ' site-header--minimal' : '' ?><?= $headerVariant === 'app' ? ' site-header--app' : '' ?>">
    <a class="site-logo" href="/">MaturaKorki</a>

    <?php if ($isPublicHeader): ?>
        <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav">
            <span class="visually-hidden">Otwórz menu</span>
            <svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="22" height="22">
                <path d="M4 7h16M4 12h16M4 17h16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>
    <?php endif; ?>

    <?php require __DIR__ . '/nav.html.php'; ?>

    <div class="site-header__actions">
        <?php if ($isPublicHeader): ?>
            <a href="#">Zaloguj się</a>
            <a class="button button--primary" href="/tutors">Znajdź korepetytora</a>
        <?php elseif ($headerVariant === 'app'): ?>
            <p class="avatar" aria-label="Konto Zosi">Z</p>
        <?php endif; ?>

        <?php require __DIR__ . '/theme-toggle.html.php'; ?>
    </div>
</header>
