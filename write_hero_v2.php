<?php
$css = '
/* PHASE 7: SS-V2 HERO Split Layout + Header Fix */

/* V2 Hero */
.ss-hero-v2 {
  position: relative;
  overflow: hidden;
  background: #eaf2ff;
}
.ss-hero-v2 .swiper,
.ss-hero-v2 .swiper-wrapper { height: auto; }

.ss-slide-v2 {
  display: flex !important;
  min-height: 88vh;
  align-items: stretch;
}
.ss-slide-left {
  flex: 0 0 48%;
  display: flex;
  align-items: center;
  padding: 64px 5% 100px;
  background: linear-gradient(135deg, #eaf2ff 0%, #f0f6ff 60%, #e8f0fd 100%);
  position: relative;
  z-index: 2;
}
.ss-slide-content { max-width: 520px; }

.ss-slide-label {
  font-size: 0.72rem;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: #FF6F00;
  margin: 0 0 14px;
}
.ss-slide-heading {
  font-family: "Mukta", "Noto Sans Devanagari", sans-serif;
  font-size: 2.4rem;
  font-weight: 800;
  color: #003893;
  line-height: 1.2;
  margin: 0 0 24px;
}
.ss-slide-heading span { color: #FF6F00; display: inline; }

.ss-slide-actions {
  display: flex;
  gap: 14px;
  flex-wrap: wrap;
  margin-bottom: 28px;
}
.ss-btn-slide-primary {
  background: #003893;
  color: #fff !important;
  padding: 13px 30px;
  border-radius: 4px;
  text-decoration: none;
  font-weight: 700;
  font-size: 0.9rem;
  transition: background 0.25s, transform 0.2s;
  display: inline-block;
}
.ss-btn-slide-primary:hover { background: #002266; transform: translateY(-2px); }

.ss-btn-slide-ghost {
  border: 2px solid #003893;
  color: #003893 !important;
  padding: 11px 28px;
  border-radius: 4px;
  text-decoration: none;
  font-weight: 600;
  font-size: 0.9rem;
  transition: all 0.25s;
  display: inline-block;
}
.ss-btn-slide-ghost:hover { background: #003893; color: #fff !important; }

.ss-slide-links {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
  margin-top: 8px;
}
.ss-slide-links a {
  color: #64748b;
  text-decoration: none;
  font-size: 0.82rem;
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 5px;
  transition: color 0.2s;
}
.ss-slide-links a i { color: #003893; }
.ss-slide-links a:hover { color: #003893; }

.ss-slide-right {
  flex: 0 0 52%;
  background-size: cover;
  background-position: center top;
  background-repeat: no-repeat;
  min-height: 400px;
  position: relative;
}

/* Swiper controls V2 */
.ss-prev-v2, .ss-next-v2 {
  color: #fff !important;
  background: #003893 !important;
  width: 44px !important;
  height: 44px !important;
  border-radius: 50% !important;
  opacity: 0.9;
}
.ss-prev-v2::after, .ss-next-v2::after {
  font-size: 0.85rem !important;
  font-weight: 900;
}
.ss-prev-v2:hover, .ss-next-v2:hover { opacity: 1; }

.ss-dots-v2 {
  bottom: 90px !important;
  left: 5% !important;
  width: auto !important;
  text-align: left !important;
}
.ss-dots-v2 .swiper-pagination-bullet {
  background: rgba(0,56,147,0.25);
  width: 28px;
  height: 4px;
  border-radius: 2px;
  margin: 0 3px !important;
}
.ss-dots-v2 .swiper-pagination-bullet-active {
  background: #003893;
}

/* Bottom gradient strip */
.ss-hero-strip {
  background: linear-gradient(90deg, #003893 0%, #D21034 100%);
  padding: 13px 0;
}
.ss-hero-strip-inner {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 20px;
}
.ss-hero-strip p {
  color: rgba(255,255,255,0.9);
  font-size: 0.87rem;
  font-weight: 500;
  margin: 0;
  flex: 1;
}
.ss-hero-strip a {
  color: #FECB00;
  font-weight: 700;
  text-decoration: none;
  font-size: 0.88rem;
  white-space: nowrap;
}

/* Responsive Hero V2 */
@media (max-width: 1100px) {
  .ss-slide-v2 { min-height: 80vh; }
  .ss-slide-heading { font-size: 2rem; }
}
@media (max-width: 900px) {
  .ss-slide-v2 { flex-direction: column !important; min-height: auto; }
  .ss-slide-left { flex: none; padding: 40px 20px 30px; }
  .ss-slide-right { min-height: 280px; flex: none; }
  .ss-slide-heading { font-size: 1.75rem; }
  .ss-dots-v2 { bottom: 12px !important; left: 50% !important; transform: translateX(-50%); text-align: center !important; }
}
@media (max-width: 576px) {
  .ss-slide-left { padding: 28px 16px 24px; }
  .ss-slide-heading { font-size: 1.3rem; }
  .ss-slide-actions { flex-direction: column; gap: 10px; }
  .ss-slide-right { min-height: 200px; }
  .ss-hero-strip-inner { flex-direction: column; gap: 6px; text-align: center; }
}
';

file_put_contents('style.css', "\n" . $css . "\n", FILE_APPEND);
echo "V2 Hero CSS done!";
?>
