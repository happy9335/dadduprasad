<?php
$css = '
/* ==================================
   DADDOO PRASAD - PREMIUM CSS
   Buddhist Flag Color System
   ================================== */

/* COLORS:
   Buddhist Blue:   #003893
   Yellow/Gold:     #FECB00
   Red:             #D21034
   Orange:          #FF6F00
   White:           #FFFFFF
*/

/* ===== BASE ===== */
:root {
    --dp-blue:   #003893;
    --dp-yellow: #FECB00;
    --dp-red:    #D21034;
    --dp-orange: #FF6F00;
    --dp-white:  #ffffff;
    --dp-dark:   #0f172a;
    --dp-gray:   #f8fafc;
    --dp-text:   #334155;
    --dp-muted:  #64748b;
}

*, *::before, *::after { box-sizing: border-box; }

body {
    font-family: "Hind", "Mukta", "Noto Sans Devanagari", sans-serif;
    background: #fff;
    color: var(--dp-text);
    scroll-behavior: smooth;
    margin: 0;
}

img { max-width: 100%; height: auto; }

/* ===== UTILITY ===== */
.dp-section { padding: 80px 0; }

.dp-section-label {
    display: inline-block;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--dp-orange);
    margin-bottom: 8px;
}
.dp-section-label-light {
    display: inline-block;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--dp-yellow);
    margin-bottom: 8px;
}

.dp-section-title {
    font-family: "Mukta", "Noto Sans Devanagari", sans-serif;
    font-size: 2.4rem;
    font-weight: 800;
    color: var(--dp-dark);
    line-height: 1.2;
    margin-bottom: 10px;
}

.dp-title-line {
    width: 60px;
    height: 4px;
    background: linear-gradient(90deg, var(--dp-blue), var(--dp-yellow));
    border-radius: 2px;
    margin-bottom: 24px;
}

.dp-section-head {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 40px;
    flex-wrap: wrap;
    gap: 16px;
}

.dp-view-all {
    color: var(--dp-blue);
    font-weight: 600;
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.2s;
}
.dp-view-all:hover { color: var(--dp-red); }

/* ===== BUTTONS ===== */
.dp-btn-primary {
    display: inline-block;
    background: var(--dp-blue);
    color: #fff !important;
    text-decoration: none;
    padding: 12px 28px;
    border-radius: 4px;
    font-weight: 600;
    font-size: 0.95rem;
    border: 2px solid var(--dp-blue);
    transition: all 0.25s ease;
    cursor: pointer;
}
.dp-btn-primary:hover {
    background: var(--dp-dark);
    border-color: var(--dp-dark);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,56,147,0.35);
}
.dp-btn-outline {
    display: inline-block;
    background: transparent;
    color: var(--dp-blue) !important;
    text-decoration: none;
    padding: 12px 28px;
    border-radius: 4px;
    font-weight: 600;
    font-size: 0.95rem;
    border: 2px solid var(--dp-blue);
    transition: all 0.25s ease;
    cursor: pointer;
}
.dp-btn-outline:hover {
    background: var(--dp-blue);
    color: #fff !important;
    transform: translateY(-2px);
}

/* ===== HERO ===== */
.dp-hero {
    position: relative;
    height: 94vh;
    min-height: 560px;
    overflow: hidden;
}

.dpswiper, .dp-slide {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
}

.dp-slide-bg {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-size: cover;
    background-position: center;
    transition: transform 8s ease;
    transform: scale(1.05);
}
.swiper-slide-active .dp-slide-bg {
    transform: scale(1.0);
}

.dp-slide-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: linear-gradient(
        135deg,
        rgba(0,56,147,0.85) 0%,
        rgba(0,30,80,0.6) 60%,
        rgba(0,0,0,0.2) 100%
    );
}

.dp-slide-content {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    transform: translateY(-52%);
    z-index: 5;
}

.dp-tagline-wrap { max-width: 620px; }

.dp-tagline-bar {
    width: 6px;
    height: 60px;
    background: var(--dp-yellow);
    border-radius: 3px;
    margin-bottom: 20px;
}

.dp-slide-title {
    font-family: "Mukta", "Noto Sans Devanagari", sans-serif;
    font-size: 3.6rem;
    font-weight: 800;
    color: #fff;
    line-height: 1.15;
    text-shadow: 0 2px 12px rgba(0,0,0,0.3);
    margin-bottom: 16px;
}

.dp-slide-sub {
    font-size: 1.1rem;
    color: rgba(255,255,255,0.88);
    font-weight: 500;
    letter-spacing: 1px;
    margin-bottom: 0;
}

/* Swiper arrows */
.dp-arrow-next, .dp-arrow-prev {
    color: #fff !important;
    background: rgba(0,56,147,0.5);
    width: 48px !important;
    height: 48px !important;
    border-radius: 50%;
    transition: background 0.3s;
}
.dp-arrow-next::after, .dp-arrow-prev::after { font-size: 1rem !important; font-weight: 900; }
.dp-arrow-next:hover, .dp-arrow-prev:hover { background: var(--dp-blue); }

.dp-pagination .swiper-pagination-bullet {
    background: rgba(255,255,255,0.6);
    width: 10px; height: 10px;
    opacity: 1;
}
.dp-pagination .swiper-pagination-bullet-active {
    background: var(--dp-yellow);
    width: 30px;
    border-radius: 5px;
}

/* Info Bar */
.dp-info-bar {
    position: absolute;
    bottom: 0; left: 0;
    width: 100%;
    z-index: 10;
    background: var(--dp-blue);
}
.dp-info-bar-inner {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 0;
    gap: 20px;
}
.dp-info-items {
    display: flex;
    gap: 30px;
}
.dp-info-item {
    color: rgba(255,255,255,0.85);
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 7px;
    transition: color 0.2s;
}
.dp-info-item i { color: var(--dp-yellow); }
.dp-info-item:hover { color: #fff; }
.dp-info-cta {
    color: var(--dp-yellow);
    font-weight: 700;
    text-decoration: none;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
    white-space: nowrap;
    border: 1px solid var(--dp-yellow);
    padding: 6px 18px;
    border-radius: 3px;
    transition: all 0.2s;
}
.dp-info-cta:hover {
    background: var(--dp-yellow);
    color: var(--dp-blue);
}

/* ===== ABOUT ===== */
.dp-about { background: #fff; padding-top: 90px; }

.dp-about-img-wrap {
    position: relative;
    display: inline-block;
    width: 100%;
}
.dp-about-photo {
    width: 100%;
    max-height: 520px;
    object-fit: cover;
    border-radius: 12px;
    box-shadow: 0 20px 50px rgba(0,56,147,0.18);
    border: 6px solid #fff;
    outline: 3px solid var(--dp-blue);
}
.dp-about-badge {
    position: absolute;
    bottom: -20px;
    right: -20px;
    background: var(--dp-yellow);
    color: var(--dp-dark);
    width: 110px;
    height: 110px;
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    font-weight: 800;
    font-size: 0.8rem;
    line-height: 1.3;
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    border: 4px solid #fff;
}
.dp-about-badge i { font-size: 1.4rem; margin-bottom: 4px; color: var(--dp-orange); }

.dp-about-lead {
    font-size: 1.05rem;
    color: var(--dp-muted);
    line-height: 1.85;
    margin-bottom: 20px;
}
.dp-highlight-box {
    background: linear-gradient(135deg, #f0f7ff 0%, #e8f0fd 100%);
    border-left: 4px solid var(--dp-blue);
    padding: 18px 20px;
    border-radius: 0 8px 8px 0;
    margin-bottom: 24px;
}
.dp-highlight-box i { color: var(--dp-blue); margin-right: 8px; opacity: 0.4; }
.dp-highlight-box strong { color: var(--dp-dark); font-size: 1.05rem; font-style: italic; line-height: 1.6; }

.dp-feature-list { display: flex; flex-direction: column; gap: 10px; margin-bottom: 10px; }
.dp-feat { display: flex; align-items: center; gap: 10px; font-size: 0.95rem; font-weight: 500; }
.dp-feat i { color: var(--dp-blue); font-size: 1rem; }

/* ===== PRESS NOTES ===== */
.dp-press-section { background: #f8fafc; }

.dp-press-card {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    transition: transform 0.3s, box-shadow 0.3s;
    height: 100%;
    display: flex;
    flex-direction: column;
}
.dp-press-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 16px 40px rgba(0,56,147,0.12);
}
.dp-press-img-wrap {
    position: relative;
    height: 220px;
    overflow: hidden;
}
.dp-press-img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.dp-press-card:hover .dp-press-img { transform: scale(1.05); }
.dp-press-img-placeholder {
    width: 100%; height: 100%;
    background: #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #94a3b8;
}
.dp-press-date-badge {
    position: absolute;
    bottom: 12px; left: 12px;
    background: var(--dp-blue);
    color: #fff;
    font-size: 0.8rem;
    font-weight: 600;
    padding: 4px 12px;
    border-radius: 4px;
}
.dp-press-body {
    padding: 20px 22px;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.dp-press-title {
    font-size: 1.05rem;
    font-weight: 700;
    color: var(--dp-dark);
    line-height: 1.5;
    flex: 1;
    margin-bottom: 16px;
}
.dp-read-more {
    color: var(--dp-blue);
    font-weight: 600;
    text-decoration: none;
    font-size: 0.88rem;
    transition: color 0.2s;
}
.dp-read-more:hover { color: var(--dp-red); }

/* ===== ACHIEVEMENTS ===== */
.dp-achievements {
    background: linear-gradient(135deg, var(--dp-blue) 0%, #001d5e 100%);
    position: relative;
    overflow: hidden;
}
.dp-achievements::before {
    content: "";
    position: absolute;
    top: -100px; right: -100px;
    width: 400px; height: 400px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(254,203,0,0.12) 0%, transparent 70%);
    pointer-events: none;
}

.dp-ach-card {
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.15);
    border-radius: 12px;
    padding: 28px 20px;
    text-align: center;
    transition: all 0.3s ease;
    backdrop-filter: blur(4px);
}
.dp-ach-card:hover {
    background: rgba(255,255,255,0.14);
    transform: translateY(-6px);
    border-color: var(--dp-yellow);
}
.dp-ach-icon {
    width: 70px; height: 70px;
    border-radius: 50%;
    background: rgba(254,203,0,0.15);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 18px;
    font-size: 1.8rem;
    color: var(--dp-yellow);
    border: 2px solid rgba(254,203,0,0.3);
}
.dp-ach-label {
    color: rgba(255,255,255,0.9);
    font-size: 0.95rem;
    font-weight: 600;
    line-height: 1.5;
    margin: 0;
}

/* ===== JOURNEY / TIMELINE ===== */
.dp-journey { background: #fff; }

.dp-journey-lead {
    max-width: 700px;
    color: var(--dp-muted);
    font-size: 1.05rem;
    line-height: 1.8;
}

.dp-timeline {
    position: relative;
    padding: 20px 0;
    max-width: 880px;
    margin: 0 auto;
}
.dp-timeline::before {
    content: "";
    position: absolute;
    left: 50%;
    top: 0; bottom: 0;
    width: 3px;
    background: linear-gradient(to bottom, var(--dp-blue), var(--dp-yellow));
    transform: translateX(-50%);
    opacity: 0.3;
}
.dp-timeline-item {
    position: relative;
    width: 46%;
    margin-bottom: 40px;
    padding-bottom: 4px;
}
.dp-timeline-item.left  { margin-right: auto; padding-right: 40px; text-align: right; }
.dp-timeline-item.right { margin-left: auto;  padding-left: 40px; text-align: left; }

.dp-timeline-dot {
    position: absolute;
    top: 18px;
    width: 18px; height: 18px;
    background: var(--dp-blue);
    border: 3px solid #fff;
    border-radius: 50%;
    box-shadow: 0 0 0 3px var(--dp-blue);
}
.dp-timeline-item.left  .dp-timeline-dot { right: -9px; }
.dp-timeline-item.right .dp-timeline-dot { left: -9px; }

.dp-timeline-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 20px 24px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.05);
    transition: box-shadow 0.3s;
}
.dp-timeline-card:hover { box-shadow: 0 8px 30px rgba(0,56,147,0.1); }
.dp-timeline-card h4 {
    color: var(--dp-blue);
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 8px;
}
.dp-timeline-card p {
    color: var(--dp-muted);
    font-size: 0.95rem;
    line-height: 1.7;
    margin: 0;
}

/* ===== NEWSLETTER ===== */
.dp-newsletter {
    background: var(--dp-orange);
    padding: 50px 0;
}
.dp-newsletter-inner {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 30px;
    flex-wrap: wrap;
}
.dp-newsletter h3 {
    color: #fff;
    font-size: 1.6rem;
    font-weight: 700;
    margin: 0 0 6px;
}
.dp-newsletter p {
    color: rgba(255,255,255,0.85);
    margin: 0;
    font-size: 0.95rem;
}
.dp-newsletter-form {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}
.dp-nl-input {
    padding: 13px 20px;
    border: none;
    border-radius: 4px;
    font-size: 0.95rem;
    min-width: 260px;
    outline: none;
    font-family: inherit;
}

/* ===== SOCIAL SECTION ===== */
.dp-social { background: #f8fafc; }

.dp-social-card {
    background: #fff;
    border-radius: 14px;
    padding: 28px 20px;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    border-top: 4px solid var(--sc, #003893);
    transition: transform 0.3s;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.dp-social-card:hover { transform: translateY(-6px); }
.dp-social-icon {
    width: 72px; height: 72px;
    border-radius: 50%;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 14px;
    color: var(--sc, #003893);
}
.dp-social-card h5 { font-weight: 700; margin-bottom: 4px; }
.dp-social-card .small { margin-bottom: 16px; }
.dp-social-btn {
    display: inline-block;
    padding: 10px 24px;
    border-radius: 30px;
    color: #fff !important;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.88rem;
    transition: opacity 0.2s, transform 0.2s;
    margin-top: auto;
}
.dp-social-btn:hover { opacity: 0.88; transform: scale(1.04); }
.dp-yt-embed { border-radius: 8px; overflow: hidden; width: 100%; }

/* ===== RESPONSIVE ===== */
@media (max-width: 992px) {
    .dp-slide-title { font-size: 2.8rem; }
    .dp-section-title { font-size: 2rem; }
    .dp-timeline-item { width: 100%; padding: 0 0 0 50px !important; text-align: left !important; margin-left: 0; margin-right: 0; }
    .dp-timeline::before { left: 16px; }
    .dp-timeline-dot { left: 7px !important; right: auto !important; }
    .dp-info-items { gap: 15px; }
    .dp-info-item span { display: none; }
}
@media (max-width: 768px) {
    .dp-hero { height: 85vh; }
    .dp-slide-title { font-size: 2rem; }
    .dp-section { padding: 55px 0; }
    .dp-info-bar-inner { flex-wrap: wrap; justify-content: center; gap: 10px; }
    .dp-about-badge { width: 80px; height: 80px; font-size: 0.65rem; }
    .dp-newsletter-inner { flex-direction: column; text-align: center; }
    .dp-newsletter-form { justify-content: center; }
    .dp-nl-input { min-width: 220px; }
}
';

file_put_contents('style.css', "\n/* ===== HOMEPAGE PREMIUM STYLES (Phase 4) ===== */\n" . $css . "\n", FILE_APPEND);
echo "CSS written!";
?>
