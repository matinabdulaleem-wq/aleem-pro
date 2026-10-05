<?php
require __DIR__ . '/../app/bootstrap.php';
$s = settings();
$projects = db()->query('SELECT * FROM projects WHERE is_published=1 ORDER BY sort_order, id')->fetchAll();
$skills = [];
foreach (db()->query('SELECT * FROM skills ORDER BY sort_order, id') as $r) $skills[$r['category']][] = $r;
$title = $s['name'] . ' | ' . $s['title'];
$desc = $s['name'] . ' — ' . $s['title'] . ' building modern websites and digital experiences.';
$fa = fn($row, $k) => $row[$k] ? ' data-fa="' . e($row[$k]) . '"' : '';
?><!doctype html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($title) ?></title>
<meta name="description" content="<?= e($desc) ?>">
<link rel="canonical" href="<?= e(env('APP_URL', 'https://your-domain.com')) ?>/">
<meta property="og:type" content="website"><meta property="og:title" content="<?= e($title) ?>"><meta property="og:description" content="<?= e($desc) ?>">
<meta name="twitter:card" content="summary"><meta name="twitter:title" content="<?= e($title) ?>"><meta name="twitter:description" content="<?= e($desc) ?>">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="stylesheet" href="/assets/css/style.css">
<meta name="csrf" content="<?= e(csrf()) ?>">
</head>
<body>
<a class="skip" href="#main" data-i18n="skip">Skip to content</a>
<header class="nav" id="nav">
  <a class="logo" href="#home" aria-label="<?= e($s['name']) ?>">AAM</a>
  <nav id="menu" aria-label="Main">
    <a href="#home" data-i18n="home">Home</a><a href="#about" data-i18n="about">About</a><a href="#skills" data-i18n="skills">Skills</a><a href="#work" data-i18n="work">Work</a><a href="#contact" data-i18n="contact">Contact</a>
    <a class="btn small" href="#contact" data-i18n="talk">Let's talk</a>
  </nav>
  <div class="tools">
    <div class="lang" role="group" aria-label="Language"><button data-lang="en" aria-pressed="true">EN</button><button data-lang="fa" aria-pressed="false" lang="fa">دری</button></div>
    <button class="burger" id="burger" aria-label="Menu" aria-expanded="false" aria-controls="menu"><span></span><span></span></button>
  </div>
</header>
<main id="main">
<section class="hero" id="home">
  <div class="hero-copy">
    <p class="status"><i></i><span data-i18n="avail">Available for new projects</span></p>
    <h1><span>ABDUL</span><span>ALEEM</span><span>MATIN</span></h1>
    <p class="role" data-i18n="role">HTML &amp; Front-End Development Specialist</p>
    <p class="lead" data-i18n="lead">I build modern, reliable and visually refined digital experiences.</p>
    <div class="actions"><a class="btn" href="#work" data-i18n="view">View my work</a><a class="btn ghost" href="#contact" data-i18n="talk">Let's talk</a></div>
  </div>
  <div class="stage" aria-hidden="true"><div class="obj"><b></b><b></b><b></b><b></b><b></b></div></div>
</section>

<section class="about" id="about">
  <h2 data-i18n="aboutTitle">More than code.</h2>
  <p id="aboutText" data-fa="<?= e($s['about_fa'] ?? '') ?>"><?= e($s['about']) ?></p>
  <p class="loc"><?= e($s['location']) ?></p>
</section>

<section class="skills" id="skills">
  <h2 data-i18n="skillsTitle">Skills</h2>
  <?php foreach (['frontend' => 'Frontend', 'backend' => 'Backend', 'data' => 'Databases', 'other' => 'Also'] as $k => $label): if (empty($skills[$k])) continue; ?>
  <div class="skill-row"><h3 data-i18n="cat_<?= $k ?>"><?= $label ?></h3>
    <ul><?php foreach ($skills[$k] as $sk): ?><li<?= $fa($sk, 'name_fa') ?>><?= e($sk['name']) ?></li><?php endforeach; ?></ul></div>
  <?php endforeach; ?>
</section>

<section class="work" id="work">
  <h2 data-i18n="workTitle">Selected work</h2>
  <?php if (!$projects): ?><p data-i18n="empty">Projects will appear here soon.</p><?php endif; ?>
  <?php foreach ($projects as $i => $p): ?>
  <article class="proj">
    <div class="proj-visual" style="<?= $p['image'] ? 'background-image:url(/uploads/' . e($p['image']) . ')' : '' ?>"><span><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span></div>
    <div class="proj-info">
      <p class="cat"><?= e($p['category']) ?></p>
      <h3><?= e($p['title']) ?></h3>
      <p<?= $fa($p, 'description_fa') ?>><?= e($p['description']) ?></p>
      <a class="btn" href="<?= e($p['url']) ?>" target="_blank" rel="noopener noreferrer" data-i18n="visit">Visit website</a>
    </div>
  </article>
  <?php endforeach; ?>
</section>

<section class="contact" id="contact">
  <h2 data-i18n="contactTitle">Let's build something great.</h2>
  <div class="contact-grid">
    <ul class="links">
      <li><a href="mailto:<?= e($s['email']) ?>"><?= e($s['email']) ?></a></li>
      <li><a href="<?= e($s['whatsapp']) ?>" target="_blank" rel="noopener noreferrer">WhatsApp <bdi><?= e($s['phone']) ?></bdi></a></li>
      <li><a href="tel:<?= e($s['phone']) ?>"><bdi><?= e($s['phone']) ?></bdi></a></li>
      <li><a href="<?= e($s['linkedin']) ?>" target="_blank" rel="noopener noreferrer">LinkedIn</a></li>
      <li><a href="<?= e($s['instagram']) ?>" target="_blank" rel="noopener noreferrer">Instagram</a></li>
    </ul>
    <form id="cform" novalidate>
      <input type="hidden" name="csrf" value="<?= e(csrf()) ?>">
      <input class="hp" type="text" name="website" tabindex="-1" autocomplete="off" aria-hidden="true">
      <label><span data-i18n="fName">Name</span><input name="name" required maxlength="100" autocomplete="name"></label>
      <label><span data-i18n="fEmail">Email</span><input name="email" type="email" required maxlength="190" autocomplete="email" dir="ltr"></label>
      <label><span data-i18n="fSubject">Subject</span><input name="subject" required maxlength="150"></label>
      <label><span data-i18n="fMessage">Message</span><textarea name="message" rows="5" required maxlength="5000"></textarea></label>
      <button class="btn" type="submit" data-i18n="send">Send message</button>
      <p id="fstatus" role="status" aria-live="polite"></p>
    </form>
  </div>
</section>
</main>
<footer><span>© <?= date('Y') ?> <?= e($s['name']) ?></span><span><?= e($s['location']) ?></span></footer>
<script src="/assets/js/app.js" defer></script>
</body>
</html>
