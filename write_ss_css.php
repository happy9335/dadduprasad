<?php
/* Write the complete SS (Supriya Sule style) CSS */
$css = <<<'FULLCSS'

/* ======================================================
   SUPRIYA SULE STYLE — DADDOO PRASAD (Phase 5 SS Style)
   Colors: Blue #003893 | Yellow #FECB00 | Red #D21034
   ====================================================== */

/* ── Variables ── */
:root {
  --ss-blue:   #003893;
  --ss-dblue:  #002266;
  --ss-yellow: #FECB00;
  --ss-red:    #D21034;
  --ss-orange: #FF6F00;
  --ss-bg:     #f5f7fa;
  --ss-text:   #1a202c;
  --ss-muted:  #64748b;
  --ss-white:  #ffffff;
}

/* ── Reset / Base ── */
*, *::before, *::after { box-sizing: border-box; }

body {
  font-family: "Hind", "Mukta", "Noto Sans Devanagari", "Open Sans", sans-serif;
  background: #fff;
  color: var(--ss-text);
  margin: 0;
  scroll-behavior: smooth;
}

img { max-width: 100%; height: auto; }

/* ── Utility ── */
.ss-section { padding: 72px 0; }

.ss-section-kicker {
  font-size: 0.72rem;
  font-weight: 700;
  letter-spacing: 2.5px;
  text-transform: uppercase;
  color: var(--ss-orange);
  margin: 0 0 6px;
}
.kicker-light { color: var(--ss-yellow) !important; }

.ss-section-heading {
  font-family: "Mukta", "Noto Sans Devanagari", sans-serif;
  font-size: 2.25rem;
  font-weight: 800;
  color: var(--ss-text);
  margin: 0 0 12px;
  line-height: 1.2;
}

.ss-rule {
  width: 48px;
  height: 4px;
  border-radius: 2px;
  background: linear-gradient(90deg, var(--ss-blue), var(--ss-yellow));
  margin: 0 0 24px;
}

.ss-section-top {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  margin-bottom: 36px;
  flex-wrap: wrap;
  gap: 12px;
}

.ss-link-more {
  color: var(--ss-blue);
  font-weight: 600;
  font-size: 0.9rem;
  text-decoration: none;
  white-space: nowrap;
  transition: color .2s;
}
.ss-link-more:hover { color: var(--ss-red); }

/* ── Buttons ── */
.ss-btn-primary {
  display: inline-block;
  background: var(--ss-blue);
  color: #fff !important;
  text-decoration: none;
  padding: 13px 30px;
  border-radius: 3px;
  font-weight: 600;
  font-size: 0.92rem;
  border: 2px solid var(--ss-blue);
  transition: all .25s;
  cursor: pointer;
}
.ss-btn-primary:hover {
  background: var(--ss-dblue);
  border-color: var(--ss-dblue);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(0,56,147,.3);
}
.ss-btn-ghost {
  display: inline-block;
  background: transparent;
  color: var(--ss-blue) !important;
  text-decoration: none;
  padding: 11px 28px;
  border-radius: 3px;
  font-weight: 600;
  font-size: 0.92rem;
  border: 2px solid var(--ss-blue);
  transition: all .25s;
}
.ss-btn-ghost:hover {
  background: var(--ss-blue);
  color: #fff !important;
}

/* ════════ HERO ════════ */
.ss-hero {
  position: relative;
  height: 95vh;
  min-height: 580px;
  overflow: hidden;
}

.ss-swiper { width: 100%; height: 100%; }

.swiper-slide { width: 100%; height: 100%; }

.ss-slide-bg {
  position: absolute; inset: 0;
  background-size: cover;
  background-position: center top;
  transform: scale(1.06);
  transition: transform 9s ease;
}
.swiper-slide-active .ss-slide-bg { transform: scale(1); }

.ss-slide-dark {
  position: absolute; inset: 0;
  background: linear-gradient(
    100deg,
    rgba(0,34,102,.88) 0%,
    rgba(0,56,147,.65) 50%,
    rgba(0,0,0,.2) 100%
  );
}

.ss-slide-text {
  position: absolute; top: 50%; left: 0; right: 0;
  transform: translateY(-48%);
  z-index: 5;
  max-width: 680px;
}

.ss-pre-title {
  font-size: 0.8rem;
  font-weight: 700;
  letter-spacing: 2.5px;
  text-transform: uppercase;
  color: var(--ss-yellow);
  margin: 0 0 14px;
}

.ss-hero-title {
  font-family: "Mukta", "Noto Sans Devanagari", sans-serif;
  font-size: 3.4rem;
  font-weight: 800;
  color: #fff;
  line-height: 1.18;
  margin: 0 0 24px;
  text-shadow: 0 3px 14px rgba(0,0,0,.35);
}

.ss-hero-links { display: flex; gap: 20px; flex-wrap: wrap; }

.ss-hero-link {
  color: rgba(255,255,255,.85);
  text-decoration: none;
  font-size: 0.86rem;
  font-weight: 600;
  display: flex; align-items: center; gap: 6px;
  border-bottom: 1px solid rgba(255,255,255,.3);
  padding-bottom: 2px;
  transition: color .2s, border-color .2s;
}
.ss-hero-link i { color: var(--ss-yellow); }
.ss-hero-link:hover { color: #fff; border-color: var(--ss-yellow); }

/* Swiper controls */
.ss-prev, .ss-next {
  color: #fff !important;
  background: rgba(0,56,147,.5) !important;
  width: 50px !important; height: 50px !important;
  border-radius: 50% !important;
}
.ss-prev::after, .ss-next::after { font-size: 1rem !important; font-weight: 900; }
.ss-prev:hover, .ss-next:hover { background: var(--ss-blue) !important; }

.ss-dots .swiper-pagination-bullet {
  background: rgba(255,255,255,.6);
  width: 10px; height: 10px;
}
.ss-dots .swiper-pagination-bullet-active {
  background: var(--ss-yellow);
  width: 28px;
  border-radius: 5px;
}

/* Floating quote panel */
.ss-quote-panel {
  position: absolute;
  bottom: 0; left: 0; right: 0;
  z-index: 10;
}
.ss-quote-inner {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: rgba(255,255,255,.95);
  backdrop-filter: blur(10px);
  border-top: 5px solid var(--ss-yellow);
  padding: 22px 32px;
  box-shadow: 0 -4px 30px rgba(0,0,0,.1);
  gap: 24px;
  flex-wrap: wrap;
}
.ss-quote-body { flex: 1; }
.ss-quote-text {
  font-size: 1.05rem;
  font-weight: 700;
  color: var(--ss-text);
  margin: 0 0 4px;
  line-height: 1.5;
}
.ss-quote-inner small {
  color: var(--ss-muted);
  font-size: 0.85rem;
}
.ss-know-more {
  display: inline-block;
  background: var(--ss-blue);
  color: #fff;
  padding: 12px 26px;
  border-radius: 3px;
  text-decoration: none;
  font-weight: 600;
  font-size: 0.9rem;
  white-space: nowrap;
  transition: all .25s;
}
.ss-know-more:hover {
  background: var(--ss-dblue);
  transform: translateY(-2px);
}

/* ════════ ABOUT ════════ */
.ss-about {
  background: #fff;
  padding-top: 80px;
}

.ss-portrait-wrap {
  position: relative;
  padding-bottom: 20px;
}
.ss-portrait {
  width: 100%;
  max-height: 580px;
  object-fit: cover;
  object-position: top;
  box-shadow: 12px 12px 0 var(--ss-blue);
}
.ss-portrait-label {
  position: absolute; bottom: 30px; left: -8px;
  background: var(--ss-blue);
  color: #fff;
  padding: 12px 20px;
  font-weight: 700;
}
.ss-portrait-label span { display: block; font-size: 1.15rem; }
.ss-portrait-label small { font-size: 0.8rem; font-weight: 400; opacity: .85; }

.ss-portrait-stats {
  display: flex;
  gap: 0;
  margin-top: 12px;
  border-top: 3px solid var(--ss-yellow);
}
.ss-stat {
  flex: 1;
  text-align: center;
  padding: 14px 8px;
  border-right: 1px solid #e2e8f0;
}
.ss-stat:last-child { border-right: none; }
.ss-stat strong {
  display: block;
  font-size: 1.4rem;
  font-weight: 800;
  color: var(--ss-blue);
}
.ss-stat span {
  display: block;
  font-size: 0.75rem;
  color: var(--ss-muted);
  margin-top: 2px;
}

.ss-about-text {
  color: var(--ss-muted);
  font-size: 1rem;
  line-height: 1.85;
}

.ss-blockquote {
  border-left: 4px solid var(--ss-blue);
  margin: 20px 0;
  padding: 16px 20px;
  background: #f0f5ff;
  border-radius: 0 8px 8px 0;
}
.ss-blockquote p {
  font-size: 1.05rem;
  font-weight: 700;
  font-style: italic;
  color: var(--ss-text);
  margin: 0 0 6px;
  line-height: 1.6;
}
.ss-blockquote footer {
  font-size: 0.85rem;
  color: var(--ss-muted);
  font-style: normal;
}

/* ════════ PRESS NOTES ════════ */
.ss-press { background: var(--ss-bg); }

.ss-press-big {
  display: block;
  text-decoration: none;
  height: 100%;
  min-height: 400px;
  position: relative;
  overflow: hidden;
  background: #111;
}
.ss-press-big-img {
  position: absolute; inset: 0;
  background-size: cover;
  background-position: center;
  transition: transform .6s ease;
}
.ss-press-big:hover .ss-press-big-img { transform: scale(1.04); }
.ss-press-big-body {
  position: absolute;
  bottom: 0; left: 0; right: 0;
  padding: 24px 22px;
  background: linear-gradient(to top, rgba(0,0,0,.88) 0%, rgba(0,0,0,0) 100%);
}
.ss-press-date {
  display: inline-block;
  background: var(--ss-blue);
  color: #fff;
  font-size: 0.76rem;
  font-weight: 600;
  padding: 3px 10px;
  border-radius: 2px;
  margin-bottom: 8px;
}
.ss-press-big-title {
  font-family: "Mukta", sans-serif;
  font-size: 1.2rem;
  font-weight: 700;
  color: #fff;
  line-height: 1.45;
  margin: 0;
}

.ss-press-list {
  list-style: none;
  padding: 0;
  margin: 0;
  background: #fff;
  height: 100%;
}
.ss-press-item {
  border-bottom: 1px solid #e8edf3;
}
.ss-press-item:last-child { border-bottom: none; }
.ss-press-item-link {
  display: flex;
  align-items: center;
  gap: 14px;
  padding: 18px 20px;
  text-decoration: none;
  transition: background .2s;
}
.ss-press-item-link:hover { background: #f0f5ff; }

.ss-press-item-date {
  font-size: 0.72rem;
  font-weight: 700;
  color: var(--ss-blue);
  white-space: nowrap;
  background: #e8effc;
  padding: 3px 8px;
  border-radius: 3px;
  flex-shrink: 0;
}
.ss-press-item-title {
  flex: 1;
  font-size: 0.92rem;
  font-weight: 600;
  color: var(--ss-text);
  line-height: 1.5;
}
.ss-list-icon { color: var(--ss-blue); font-size: 0.7rem; flex-shrink: 0; }

/* ════════ ACHIEVEMENTS ════════ */
.ss-ach {
  background: linear-gradient(135deg, var(--ss-blue) 0%, var(--ss-dblue) 100%);
  position: relative;
  overflow: hidden;
}
.ss-ach::after {
  content: '';
  position: absolute;
  top: -100px; right: -80px;
  width: 350px; height: 350px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(254,203,0,.14) 0%, transparent 70%);
  pointer-events: none;
}

.ss-ach-card {
  background: rgba(255,255,255,.07);
  border: 1px solid rgba(255,255,255,.15);
  border-radius: 10px;
  padding: 28px 18px;
  text-align: center;
  transition: all .3s;
  backdrop-filter: blur(4px);
  height: 100%;
}
.ss-ach-card:hover {
  background: rgba(255,255,255,.14);
  transform: translateY(-5px);
  border-color: var(--ss-yellow);
}
.ss-ach-icon {
  font-size: 2rem;
  color: var(--ss-yellow);
  margin-bottom: 14px;
  display: block;
}
.ss-ach-text {
  color: rgba(255,255,255,.9);
  font-size: 0.9rem;
  font-weight: 600;
  line-height: 1.5;
  margin: 0;
}

/* ════════ JOURNEY ════════ */
.ss-journey { background: #fff; }

.ss-journey-desc {
  color: var(--ss-muted);
  font-size: 0.97rem;
  line-height: 1.8;
  margin-bottom: 0;
}

.ss-timeline { padding-left: 28px; border-left: 3px solid #e2e8f0; }

.ss-tl-item {
  position: relative;
  margin-bottom: 40px;
}
.ss-tl-item:last-child { margin-bottom: 0; }

.ss-tl-dot {
  position: absolute;
  left: -40px; top: 12px;
  width: 18px; height: 18px;
  background: var(--ss-blue);
  border: 3px solid #fff;
  border-radius: 50%;
  box-shadow: 0 0 0 3px var(--ss-blue);
}

.ss-tl-card {
  background: #f8fafd;
  border: 1px solid #e2e8f0;
  border-radius: 10px;
  padding: 20px 24px;
  transition: box-shadow .3s;
}
.ss-tl-card:hover { box-shadow: 0 4px 18px rgba(0,56,147,.1); background: #fff; }

.ss-tl-year {
  font-size: 2rem;
  font-weight: 900;
  color: rgba(0,56,147,.12);
  position: absolute;
  top: 10px; right: 18px;
  font-family: monospace;
  letter-spacing: -2px;
}

.ss-tl-title {
  font-size: 1.1rem;
  font-weight: 700;
  color: var(--ss-blue);
  margin: 0 0 8px;
}
.ss-tl-desc {
  font-size: 0.93rem;
  color: var(--ss-muted);
  line-height: 1.7;
  margin: 0;
}

/* ════════ NEWS + SOCIAL ════════ */
.ss-news-social { background: var(--ss-bg); }

.ss-news-list { list-style: none; padding: 0; margin: 0; }
.ss-news-item { border-bottom: 1px solid #dde3ef; }
.ss-news-item:last-child { border-bottom: none; }

.ss-news-link {
  display: flex;
  align-items: flex-start;
  gap: 16px;
  padding: 18px 0;
  text-decoration: none;
  transition: background .2s;
}
.ss-news-link:hover .ss-news-title { color: var(--ss-blue); }

.ss-news-date {
  flex-shrink: 0;
  background: var(--ss-blue);
  color: #fff;
  width: 52px;
  border-radius: 6px;
  text-align: center;
  padding: 8px 4px;
}
.ss-news-day { display: block; font-size: 1.4rem; font-weight: 800; line-height: 1; }
.ss-news-mon { display: block; font-size: 0.65rem; font-weight: 600; letter-spacing: .5px; margin-top: 2px; opacity: .85; }

.ss-news-body { flex: 1; }
.ss-news-title {
  font-size: 0.95rem;
  font-weight: 600;
  color: var(--ss-text);
  line-height: 1.55;
  margin: 0 0 6px;
  transition: color .2s;
}
.ss-news-cta {
  font-size: 0.8rem;
  font-weight: 600;
  color: var(--ss-orange);
  text-decoration: none;
}

/* Social Buttons */
.ss-socials { display: flex; flex-direction: column; gap: 10px; margin-bottom: 20px; }
.ss-social-btn {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 11px 18px;
  border-radius: 4px;
  color: #fff;
  text-decoration: none;
  font-weight: 600;
  font-size: 0.9rem;
  transition: opacity .2s, transform .2s;
}
.ss-social-btn:hover { opacity: .9; transform: translateX(3px); color: #fff; }
.ss-social-btn.fb { background: #1877F2; }
.ss-social-btn.tw { background: #1DA1F2; }
.ss-social-btn.ig { background: linear-gradient(45deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888); }
.ss-social-btn.yt { background: #FF0000; }

.ss-yt-wrap { border-radius: 8px; overflow: hidden; }
.ss-yt-caption { font-size: 0.8rem; color: var(--ss-muted); margin: 0; }

.ss-yt-placeholder {
  background: #fff;
  border-radius: 12px;
  padding: 36px 24px;
  text-align: center;
  border: 2px dashed #e2e8f0;
}

/* ════════ CONTACT STRIP ════════ */
.ss-contact-strip {
  background: var(--ss-blue);
  padding: 48px 0;
}
.ss-contact-title {
  font-size: 1.8rem;
  font-weight: 800;
  color: #fff;
  margin: 0 0 16px;
}
.ss-contact-details {
  display: flex;
  flex-wrap: wrap;
  gap: 16px 28px;
}
.ss-contact-details span {
  color: rgba(255,255,255,.8);
  font-size: 0.9rem;
  display: flex;
  align-items: center;
}
.ss-contact-details i { color: var(--ss-yellow); }
.ss-contact-details a {
  color: rgba(255,255,255,.8);
  text-decoration: none;
  transition: color .2s;
}
.ss-contact-details a:hover { color: var(--ss-yellow); }

/* ════════ RESPONSIVE ════════ */
@media (max-width: 992px) {
  .ss-hero-title { font-size: 2.5rem; }
  .ss-section-heading { font-size: 1.8rem; }
  .ss-portrait { max-height: 360px; }
  .ss-quote-inner { padding: 16px 20px; }
}
@media (max-width: 768px) {
  .ss-hero { height: 85vh; }
  .ss-hero-title { font-size: 1.9rem; }
  .ss-section { padding: 48px 0; }
  .ss-quote-panel { position: static; }
  .ss-quote-inner { flex-direction: column; gap: 14px; }
  .ss-timeline { padding-left: 18px; }
  .ss-tl-dot { left: -30px; }
  .ss-press-big { min-height: 260px; }
  .ss-contact-details { flex-direction: column; gap: 10px; }
}

FULLCSS;

file_put_contents('style.css', "\n/* ===== SS STYLE PHASE 5 ===== */\n" . $css . "\n", FILE_APPEND);
echo "SS Style CSS Injected!";
?>
