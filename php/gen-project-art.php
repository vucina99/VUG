<?php
/**
 * VUG - jednokratni generator vizuala za portfolio (CLI).
 *
 *     php php/gen-project-art.php
 *
 * Za svaki projekat iz php/projects.php upisuje:
 *   img/projects/<slug>-cover.svg   (glavni vizual, 1200x750)
 *   img/projects/<slug>-1..3.svg    (galerija)
 *
 * Social projekti (cat 'social') dodatno:
 *   img/projects/<slug>-grid.svg    (mreža profila 3x3, 900x900)
 *   img/projects/<slug>-r1..rN.svg  (vertikalno 9:16, jedan po rubrici)
 *
 * Pokreni ponovo kad dodaš projekat ili promeniš akcentne boje.
 * Nema build stepa - ovo je namerno ručni korak.
 */

if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    exit("Samo CLI.\n");
}

require __DIR__ . '/project-art.php';
require __DIR__ . '/projects.php';

$dir = dirname(__DIR__) . '/img/projects';
if (!is_dir($dir) && !mkdir($dir, 0775, true)) {
    exit("Ne mogu da napravim {$dir}\n");
}

$n = 0;
foreach (vug_projects_raw() as $slug => $p) {
    $opts = ['a1' => $p['a1'], 'a2' => $p['a2'], 'seed' => $p['seed']];

    $files = [
        $slug . '-cover.svg' => $p['art']['cover'],
    ];
    foreach (array_values($p['art']['shots']) as $i => $kind) {
        $files[$slug . '-' . ($i + 1) . '.svg'] = $kind;
    }

    $k = 0;
    foreach ($files as $file => $kind) {
        // Različit seed po slici istog projekta => mockup-i se ne ponavljaju.
        $svg = vug_art_svg($kind, ['seed' => $p['seed'] + $k * 17, 'alt' => $p['sr']['title'] . ' - ' . $kind] + $opts);
        file_put_contents($dir . '/' . $file, $svg);
        echo str_pad($file, 42), strlen($svg), " B\n";
        $n++;
        $k++;
    }

    if ($p['cat'] !== 'social') continue;

    // Mreža profila (1:1) - hero social projekta.
    $svg = vug_art_grid_svg(['seed' => $p['seed'] + 101, 'alt' => $p['sr']['title'] . ' - mreža objava'] + $opts);
    file_put_contents($dir . '/' . $slug . '-grid.svg', $svg);
    echo str_pad($slug . '-grid.svg', 42), strlen($svg), " B\n";
    $n++;

    // Vertikalni 9:16 prikazi - jedan po rubrici (pillars), naizmenično format.
    $kinds = ['reel', 'story', 'carousel'];
    foreach (array_keys($p['sr']['pillars'] ?? []) as $i) {
        $kind = $kinds[$i % count($kinds)];
        $file = $slug . '-r' . ($i + 1) . '.svg';
        $svg  = vug_art_vertical_svg($kind, ['seed' => $p['seed'] + 211 + $i * 29, 'alt' => $p['sr']['pillars'][$i][0]] + $opts);
        file_put_contents($dir . '/' . $file, $svg);
        echo str_pad($file, 42), strlen($svg), " B\n";
        $n++;
    }
}
echo "\nGotovo: {$n} fajlova u img/projects/\n";
