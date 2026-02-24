<?php
$css = '
/* ═══════════════════════════════════════════
   PHASE 6: HERO FIX + MOBILE RESPONSIVE
   ─────────────────────────────────────────── */

/* Ensure hero fills full space */
.ss-hero {
    position: relative !important;
    width: 100% !important;
    height: calc(100vh - 0px) !important;
    min-height: 540px !important;
    overflow: hidden !important;
    display: block !important;
}

/* Swiper must fill parent */
.ss-swiper,
.ss-swiper .swiper-wrapper,
.ss-swiper .swiper-slide {
    width: 100% !important;
    height: 100% !important;
    position: absolute !important;
    top: 0; left: 0;
}

/* Slide image backgrounds */
.ss-slide-bg {
    position: absolute !important;
    inset: 0 !important;
    background-size: cover !important;
    background-position: center top !important;
    background-repeat: no-repeat !important;
    transform: scale(1.04);
    transition: transform 8s ease !important;
    width: 100% !important;
    height: 100% !important;
}
.swiper-slide-active .ss-slide-bg { transform: scale(1.0) !important; }

/* Dark overlay */
.ss-slide-dark {
    position: absolute !important;
    inset: 0;
    background: linear-gradient(120deg, rgba(0,34,102,0.88) 0%, rgba(0,56,147,0.65) 55%, rgba(0,0,0,0.25) 100%);
    z-index: 1;
}

/* Slide text */
.ss-slide-text {
    position: absolute;
    top: 44%;
    transform: translateY(-50%);
    z-index: 5;
    max-width: 640px;
    padding: 0 16px;
}

/* Quote panel — absolute at bottom */
.ss-quote-panel {
    position: absolute !important;
    bottom: 0;
    left: 0 !important;
    right: 0 !important;
    width: 100% !important;
    max-width: 100% !important;
    z-index: 10;
    padding: 0 !important;
}
.ss-quote-panel > .container,
.ss-quote-panel.container {
    max-width: 100% !important;
    padding: 0 !important;
}
.ss-quote-inner {
    background: rgba(255,255,255,0.96) !important;
    border-top: 5px solid #FECB00 !important;
    padding: 18px 32px !important;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
}

/* ─ Scroll-in animations ─ */
.anim-hidden {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.6s ease, transform 0.6s ease;
}
.anim-visible {
    opacity: 1 !important;
    transform: translateY(0) !important;
}

/* ─── FULL MOBILE RESPONSIVE ─── */
@media (max-width: 1200px) {
    .ss-hero { height: 85vh; }
}
@media (max-width: 992px) {
    .ss-hero { height: 80vh; min-height: 440px; }
    .ss-hero-title { font-size: 2.2rem; }
    .ss-section-heading { font-size: 1.75rem; }
    .ss-portrait { max-height: 360px; box-shadow: 6px 6px 0 var(--ss-blue, #003893); }
    .ss-portrait-label { left: 0; }
    .ss-timeline { padding-left: 18px; }
    .ss-tl-dot { left: -28px; width: 14px; height: 14px; }
    .ss-press-big { min-height: 280px; }
    .ss-news-social .row { flex-direction: column; }
}
@media (max-width: 768px) {
    .ss-hero { height: 78vh; min-height: 400px; }
    .ss-hero-title { font-size: 1.7rem; line-height: 1.25; }
    .ss-pre-title { font-size: 0.7rem; }
    .ss-hero-links { gap: 10px; }
    .ss-hero-link { font-size: 0.8rem; }
    .ss-section { padding: 44px 0; }
    .ss-section-heading { font-size: 1.5rem; }
    .ss-section-top { flex-direction: column; align-items: flex-start; }
    .ss-quote-inner { flex-direction: column; align-items: flex-start; padding: 14px 16px !important; gap: 10px; }
    .ss-quote-text { font-size: 0.9rem; }
    .ss-timeline::before { left: 10px; }
    .ss-timeline { padding-left: 26px; border-left-width: 2px; }
    .ss-tl-dot { left: -20px; top: 10px; }
    .ss-tl-card { padding: 14px 16px; }
    .ss-portrait-stats { flex-wrap: wrap; }
    .ss-stat { flex: 0 0 33.33%; }
    .ss-press-big { min-height: 220px; }
    .ss-ach-card { padding: 18px 12px; }
    .ss-contact-strip { padding: 32px 0; }
    .ss-contact-title { font-size: 1.4rem; }
    .ss-contact-details { flex-direction: column; gap: 8px; }
}
@media (max-width: 480px) {
    .ss-hero { height: 72vh; min-height: 360px; }
    .ss-hero-title { font-size: 1.35rem; }
    .identity-name { font-size: 1rem; }
    .ss-section { padding: 36px 0; }
    .ss-section-heading { font-size: 1.3rem; }
    .ss-social-btn { font-size: 0.82rem; padding: 9px 14px; }
    .ss-prev, .ss-next { width: 36px !important; height: 36px !important; }
    .ss-prev::after, .ss-next::after { font-size: 0.8rem !important; }
}
';

file_put_contents('style.css', "\n/* ═══ PHASE 6: HERO FIX + RESPONSIVE ═══ */\n" . $css . "\n", FILE_APPEND);
echo "Hero fix + Mobile CSS done!";
?>
