<?php
/**
 * VUG — brendirana 404 stranica.
 * Vraća pravi HTTP 404 status (ne soft-404), radi bez JavaScripta, responsive.
 * Postavljena preko: ErrorDocument 404 /404.php  (u .htaccess).
 */
http_response_code(404);

// Jezik: /en putanja ili ?lang=en => engleski, u suprotnom srpski.
$req = $_SERVER['REQUEST_URI'] ?? '';
$lang = (preg_match('#/en(/|$|\?)#', $req) || (($_GET['lang'] ?? '') === 'en')) ? 'en' : 'sr';
$t = require __DIR__ . '/lang/' . $lang . '.php';
require __DIR__ . '/php/icons.php';

// Base-path (radi i u podfolderu na lokalu i u rootu na produkciji)
$base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
$home = $base === '' ? '/' : $base . '/';
if ($lang === 'en') $home = $base . '/en';

$copy = $lang === 'sr' ? [
    'title'    => 'Stranica nije pronađena — VUG',
    'eyebrow'  => 'Greška 404 · Stranica ne postoji',
    'h1'       => 'Ova stranica se izgubila u digitalnom svemiru',
    'lead'     => 'Link koji ste pratili je možda zastareo, preimenovan ili nikada nije ni postojao. Bez brige — vratimo Vas na pravi put.',
    'home'     => 'Nazad na početnu',
    'contact'  => 'Javite nam se',
    'explore'  => 'Ili istražite dalje',
    'services' => 'Usluge',
    'refs'     => 'Reference',
    'faq'      => 'Česta pitanja',
    'contact2' => 'Kontakt',
] : [
    'title'    => 'Page not found — VUG',
    'eyebrow'  => 'Error 404 · Page not found',
    'h1'       => 'This page got lost in the digital universe',
    'lead'     => 'The link you followed may be outdated, renamed, or never existed. No worries — let’s get you back on track.',
    'home'     => 'Back to home',
    'contact'  => 'Get in touch',
    'explore'  => 'Or explore further',
    'services' => 'Services',
    'refs'     => 'References',
    'faq'      => 'FAQ',
    'contact2' => 'Contact',
];

$links = [
    ['#services',   'code-slash', $copy['services']],
    ['#references', 'briefcase',  $copy['refs']],
    ['#faq',        'chat-dots',  $copy['faq']],
    ['#contact',    'envelope',   $copy['contact2']],
];
?>
<!DOCTYPE html>
<html lang="<?= $t['lang_code'] ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d0820">
    <meta name="robots" content="noindex, follow">
    <title><?= htmlspecialchars($copy['title']) ?></title>
    <link rel="icon" href="<?= $base ?>/favicon.ico" sizes="any">
    <link rel="icon" type="image/svg+xml" href="<?= $base ?>/img/favicon.svg">
    <link rel="preload" as="font" type="font/woff2" href="<?= $base ?>/fonts/plus-jakarta-sans-normal-latin.woff2" crossorigin>
    <link rel="stylesheet" href="<?= $base ?>/css/style.css?v=<?= @filemtime(__DIR__ . '/css/style.css') ?>">
    <style>
        /* Ova stranica nema custom kursor (ni main.js) — vrati normalan miš. */
        body { cursor: auto; }
        .e404 {
            position: relative; z-index: 1;
            min-height: 100vh; min-height: 100svh;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            text-align: center; padding: 120px 20px 70px; overflow: hidden;
        }
        .e404-brand { position: absolute; top: 30px; left: 50%; transform: translateX(-50%); }
        .e404-brand img { height: 38px; width: auto; }

        .e404-eyebrow {
            display: inline-flex; align-items: center; justify-content: center;
            flex-wrap: wrap; gap: 6px 12px; max-width: 100%;
            font-family: var(--ff-mono); font-size: 13px; font-weight: 600;
            letter-spacing: 0.16em; text-transform: uppercase; color: var(--txt-muted);
            margin-bottom: 20px;
        }
        .e404-eyebrow .dot {
            width: 8px; height: 8px; border-radius: 50%;
            background: var(--mint); box-shadow: 0 0 16px var(--mint);
            animation: e404-pulse 2s infinite;
        }
        @keyframes e404-pulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(207, 251, 246, 0.6); }
            70% { box-shadow: 0 0 0 12px rgba(207, 251, 246, 0); }
        }

        /* Ogroman 404 sa gradijentom, mekim sjajem i laganim lebdenjem */
        .e404-num-wrap { position: relative; display: inline-block; margin: 4px 0 6px; }
        .e404-num-wrap::before {
            content: ""; position: absolute; left: 50%; top: 52%;
            width: 78%; height: 62%; transform: translate(-50%, -50%);
            background: radial-gradient(ellipse at center, rgba(93, 211, 245, 0.40), transparent 65%);
            filter: blur(60px); z-index: -1; pointer-events: none;
        }
        .e404-num {
            font-family: var(--ff-mono); font-weight: 700; line-height: 0.82;
            letter-spacing: -0.04em; font-size: clamp(96px, 30vw, 360px);
            background: linear-gradient(125deg, var(--mint) 0%, var(--cyan) 45%, var(--soft) 100%);
            -webkit-background-clip: text; background-clip: text;
            -webkit-text-fill-color: transparent; color: var(--mint);
            animation: e404-float 6s ease-in-out infinite;
        }
        @keyframes e404-float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-16px); }
        }

        .e404-h1 {
            font-size: clamp(26px, 4vw, 44px); font-weight: 800;
            letter-spacing: -0.03em; line-height: 1.08; color: var(--txt);
            max-width: 20ch; margin: 6px auto 0;
        }
        .e404-lead {
            font-size: clamp(16px, 1.6vw, 19px); line-height: 1.6;
            color: var(--txt-soft); max-width: 54ch; margin: 20px auto 36px;
        }
        .e404-actions { display: flex; flex-wrap: wrap; gap: 14px; justify-content: center; }

        .e404-explore { margin-top: 44px; }
        .e404-explore-label {
            font-family: var(--ff-mono); font-size: 12px; font-weight: 600;
            letter-spacing: 0.14em; text-transform: uppercase; color: var(--txt-muted);
            display: block; margin-bottom: 16px;
        }
        .e404-links { display: flex; flex-wrap: wrap; gap: 12px; justify-content: center; }
        .e404-links a {
            display: inline-flex; align-items: center; gap: 9px;
            padding: 11px 20px; border-radius: 100px;
            border: 1px solid var(--line-strong); color: var(--txt-soft);
            font-weight: 600; font-size: 14px;
            transition: color .25s, border-color .25s, background .25s, transform .25s;
        }
        .e404-links a:hover {
            color: var(--mint); border-color: rgba(207, 251, 246, 0.4);
            background: rgba(207, 251, 246, 0.06); transform: translateY(-2px);
        }
        .e404-links .vi { font-size: 15px; }

        @media (prefers-reduced-motion: reduce) {
            .e404-num { animation: none; }
            .e404-eyebrow .dot { animation: none; }
            .e404-links a:hover { transform: none; }
        }
    </style>
</head>
<body data-lang="<?= $t['lang_code'] ?>">
<?= vug_icon_sprite() ?>
<div class="mesh" aria-hidden="true"></div>
<div class="grain" aria-hidden="true"></div>

<a class="e404-brand" href="<?= $home ?>" aria-label="VUG — <?= $lang === 'sr' ? 'Početna' : 'Home' ?>">
    <img src="<?= $base ?>/img/logoes/logo-blue-white-c.png" alt="VUG Digital Agency" width="572" height="120">
</a>

<main class="e404">
    <span class="e404-eyebrow">
        <span class="dot"></span>
        <?= htmlspecialchars($copy['eyebrow']) ?>
    </span>

    <div class="e404-num-wrap">
        <div class="e404-num" aria-hidden="true">404</div>
    </div>

    <h1 class="e404-h1"><?= htmlspecialchars($copy['h1']) ?></h1>
    <p class="e404-lead"><?= htmlspecialchars($copy['lead']) ?></p>

    <div class="e404-actions">
        <a href="<?= $home ?>" class="btn btn--primary"><?= vug_icon('arrow-right') ?> <?= htmlspecialchars($copy['home']) ?></a>
        <a href="<?= $home ?>#contact" class="btn btn--ghost"><?= vug_icon('chat-left-text') ?> <?= htmlspecialchars($copy['contact']) ?></a>
    </div>

    <nav class="e404-explore" aria-label="<?= $lang === 'sr' ? 'Korisni linkovi' : 'Helpful links' ?>">
        <span class="e404-explore-label"><?= htmlspecialchars($copy['explore']) ?></span>
        <div class="e404-links">
            <?php foreach ($links as $l): ?>
                <a href="<?= $home . $l[0] ?>"><?= vug_icon($l[1]) ?> <?= htmlspecialchars($l[2]) ?></a>
            <?php endforeach; ?>
        </div>
    </nav>
</main>
</body>
</html>
