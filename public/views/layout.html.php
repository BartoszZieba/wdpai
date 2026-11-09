<?php
$headerVariant = $headerVariant ?? 'public';
$footerVariant = $footerVariant ?? 'public';
?>
<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#FBF8F3">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Source+Serif+4:opsz,wght@8..60,600;8..60,700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/tokens.css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/themes.js" defer></script>
    <script src="/js/nav.js" defer></script>
    <title><?= $this->e($pageTitle ?? 'MaturaKorki') ?></title>
</head>
<body id="top">
<?php require __DIR__ . '/partials/header.html.php'; ?>

<?= $content ?>

<?php if ($footerVariant === 'minimal'): ?>
    <?php require __DIR__ . '/partials/footer-minimal.html.php'; ?>
<?php else: ?>
    <?php require __DIR__ . '/partials/footer.html.php'; ?>
<?php endif; ?>

<?php if ($showBackToTop ?? true): ?>
    <a class="back-to-top" href="#top" aria-label="Wróć na górę strony" title="Wróć na górę">
        <svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="20" height="20">
            <path d="M12 19V5M5 12l7-7 7 7" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>
<?php endif; ?>
</body>
</html>
