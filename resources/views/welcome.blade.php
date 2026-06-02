<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>C-Moon — Exploração Espacial</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Bebas+Neue&family=Outfit:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/cmoon.css') }}">
  
<style>
:root {
  --gold: #c8a96e;
  --gold-light: #dfc08a;
  --bg-dark: #06080f;
  --bg-mid: #0c0f1a;
  --surface: #111525;
  --text: #e8eaf2;
  --text-muted: #7880a0;
  --text-dim: #3a4060;
  --border: rgba(255,255,255,0.06);
  --border-hover: rgba(200,169,110,0.2);
}



body {
  background: var(--bg-dark);
  color: var(--text);
  font-family: 'Outfit', sans-serif;
  overflow-x: hidden;
}

a { color: inherit; text-decoration: none; }
img { display: block; width: 100%; }

/* ── STARFIELD ── */
.starfield { position: fixed; inset: 0; pointer-events: none; z-index: 0; }
.starfield canvas { width: 100%; height: 100%; }


/* ══════════════════════════════════════
   HERO
══════════════════════════════════════ */
.hero {
  position: relative;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  overflow: hidden;
}

/* fundo estrelado + gradiente */
.hero-bg {
  position: absolute;
  inset: 0;
  background:
    linear-gradient(135deg, rgba(6,8,15,.45) 0%, rgba(6,8,15,.25) 100%),
    url('/img/nasa.jpg') center/cover fixed,
    radial-gradient(ellipse 80% 60% at 60% 40%, rgba(200,169,110,.07) 0%, transparent 60%),
    radial-gradient(ellipse 50% 80% at 20% 80%, rgba(124,159,255,.05) 0%, transparent 50%),
    var(--bg-dark);
}

/* grade sutil */
.hero-grid {
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px);
  background-size: 80px 80px;
  mask-image: radial-gradient(ellipse 100% 100% at 50% 0%, black 30%, transparent 100%);
}

.hero-inner {
  position: relative;
  z-index: 2;
  flex: 1;
  display: grid;
  grid-template-columns: 1fr 1fr;
  min-height: 100vh;
}

/* ── hero esquerda ── */
.hero-left {
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  padding: 140px 64px 80px;
  border-right: 1px solid var(--border);
}

.hero-eyebrow {
  display: flex;
  align-items: center;
  gap: 14px;
  font-size: 10px;
  font-weight: 500;
  letter-spacing: .24em;
  text-transform: uppercase;
  color: var(--gold);
  margin-bottom: 28px;
  opacity: 0;
  animation: fadeUp .8s .2s ease both;
}
.hero-eyebrow-line { width: 36px; height: 1px; background: var(--gold); flex-shrink: 0; }

.hero-title {
  font-family: 'Bebas Neue', sans-serif;
  font-size: clamp(72px, 8.5vw, 128px);
  line-height: .92;
  letter-spacing: .03em;
  color: var(--text);
  margin-bottom: 40px;
  opacity: 0;
  animation: fadeUp .9s .35s ease both;
}
.hero-title-accent { color: var(--gold); display: block; }

.hero-sub {
  font-size: 14px;
  font-weight: 300;
  color: var(--text-muted);
  line-height: 1.8;
  max-width: 340px;
  margin-bottom: 48px;
  opacity: 0;
  animation: fadeUp .8s .5s ease both;
}

.hero-cta {
  display: flex;
  align-items: center;
  gap: 20px;
  opacity: 0;
  animation: fadeUp .8s .65s ease both;
}

.btn-gold {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 14px 32px;
  background: var(--gold);
  color: #06080f;
  font-size: 11px;
  font-weight: 600;
  letter-spacing: .14em;
  text-transform: uppercase;
  border-radius: 40px;
  transition: all .25s;
  border: none; cursor: pointer;
  font-family: 'Outfit', sans-serif;
}
.btn-gold:hover { background: var(--gold-light); transform: translateY(-2px); box-shadow: 0 8px 28px rgba(200,169,110,.35); }

.btn-ghost-slim {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 11px;
  font-weight: 500;
  letter-spacing: .14em;
  text-transform: uppercase;
  color: var(--text-muted);
  transition: color .2s, gap .25s;
}
.btn-ghost-slim:hover { color: var(--gold); gap: 14px; }

/* ── hero direita ── */
.hero-right {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: flex-end;
  overflow: hidden;
 
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
}

/* planeta principal */
.hero-planet-wrap {
  position: relative;
  width: min(380px, 50vw);
  aspect-ratio: 1;
  opacity: 0;
  animation: fadeIn 1.2s .6s ease both;
}
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

.hero-planet {
  position: absolute;
  inset: 0;
  border-radius: 50%;
  background: radial-gradient(ellipse at 32% 28%,
    rgba(200,169,110,.28) 0%,
    rgba(17,21,37,.92) 40%,
    rgba(6,8,15,1) 100%
  );
  box-shadow:
    inset -28px -20px 60px rgba(0,0,0,.75),
    0 0 80px rgba(200,169,110,.05),
    0 0 200px rgba(200,169,110,.03);
}

/* anéis */
.planet-ring {
  position: absolute;
  inset: -18%;
  border-radius: 50%;
  border: 1px solid rgba(200,169,110,.09);
  animation: orbit 70s linear infinite;
}
.planet-ring-2 {
  inset: -5%;
  border-color: rgba(124,159,255,.05);
  animation-duration: 44s;
  animation-direction: reverse;
}
.planet-ring-3 {
  inset: -35%;
  border-color: rgba(93,214,176,.04);
  animation-duration: 100s;
}
@keyframes orbit { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

/* ponto orbital */
.planet-dot {
  position: absolute;
  width: 7px; height: 7px;
  border-radius: 50%;
  background: var(--gold);
  top: -3.5px; left: calc(50% - 3.5px);
  box-shadow: 0 0 12px var(--gold), 0 0 24px rgba(200,169,110,.4);
}
.planet-dot-wrap {
  position: absolute;
  inset: -18%;
  border-radius: 50%;
  animation: orbit 70s linear infinite;
}

/* texto flutuante */
.hero-float-text {
  position: absolute;
  right: 48px;
  bottom: 80px;
  font-size: 12px;
  font-weight: 300;
  color: var(--text);
  text-align: right;
  line-height: 1.7;
  max-width: 180px;
  opacity: 0;
  animation: fadeUp .8s 1s ease both;
  background: rgba(6,8,15,.6);
  padding: 16px 20px;
  border-radius: 8px;
  border: 1px solid rgba(200,169,110,.2);
}


/* contador inferior hero */
.hero-bottom {
  position: relative;
  z-index: 2;
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  border-top: 1px solid var(--border);
}
.hero-bottom-cell {
  padding: 28px 40px;
  display: flex;
  align-items: center;
  gap: 20px;
  border-right: 1px solid var(--border);
  opacity: 0;
  animation: fadeUp .6s ease both;
}
.hero-bottom-cell:last-child { border-right: none; }
.hero-bottom-cell:nth-child(1) { animation-delay: .7s; }
.hero-bottom-cell:nth-child(2) { animation-delay: .85s; }
.hero-bottom-cell:nth-child(3) { animation-delay: 1s; }

.hbc-num {
  font-family: 'Bebas Neue', sans-serif;
  font-size: 40px;
  line-height: 1;
  letter-spacing: .04em;
  color: var(--text);
}
.hbc-label {
  font-size: 11px;
  font-weight: 300;
  color: var(--text-muted);
  line-height: 1.5;
  letter-spacing: .04em;
}

/* ══════════════════════════════════════
   ABOUT SECTION
══════════════════════════════════════ */
.about {
  position: relative;
  z-index: 1;
  padding: 0;
  
}
.about-inner {
  display: grid;
  grid-template-columns: 1fr 1fr;
  border-top: 1px solid var(--border);
}

/* esquerda: texto */
.about-left {
  padding: 100px 64px 100px 0;
  border-right: 1px solid var(--border);
}
.about-micro {
  font-size: 10px;
  font-weight: 500;
  letter-spacing: .2em;
  text-transform: uppercase;
  color: var(--text-dim);
  margin-bottom: 16px;
}
.about-title {
  font-family: 'Bebas Neue', sans-serif;
  font-size: clamp(52px, 6vw, 88px);
  line-height: .95;
  letter-spacing: .05em;
  color: var(--text);
  margin-bottom: 36px;
  text-align: center;
}
.about-title-at {
  font-size: .38em;
  color: var(--text-dim);
  vertical-align: middle;
  letter-spacing: .15em;
  margin-right: 6px;
}
.about-body {
  font-size: 15px;
  font-weight: 300;
  color: var(--text-muted);
  line-height: 1.85;
  max-width: 400px;
  justify-self: center;


  
}

/* direita: stats grid */
.about-right {
  display: grid;
  grid-template-columns: 1fr 1fr;
}
.stat-cell {
  padding: 52px 44px;
  border-bottom: 1px solid var(--border);
  border-right: 1px solid var(--border);
  position: relative;
  transition: background .3s;
  overflow: hidden;
}
.stat-cell::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 2px;
  background: linear-gradient(90deg, var(--gold), transparent);
  opacity: 0;
  transition: opacity .4s;
}
.stat-cell:hover { background: rgba(200,169,110,.025); }
.stat-cell:hover::before { opacity: 1; }
.stat-cell:nth-child(even) { border-right: none; }
.stat-cell:nth-child(3),
.stat-cell:nth-child(4) { border-bottom: none; }

.stat-label {
  font-size: 12px;
  font-weight: 300;
  color: var(--text-muted);
  line-height: 1.6;
  margin-bottom: 24px;
}
.stat-val {
  font-family: 'Bebas Neue', sans-serif;
  font-size: clamp(60px, 7vw, 96px);
  line-height: 1;
  letter-spacing: .03em;
  color: var(--text);
}
.stat-cell.dark {
  background: var(--surface);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.stat-dark-text {
  font-family: 'Cormorant Garamond', serif;
  font-size: 18px;
  font-style: italic;
  font-weight: 300;
  color: var(--text-muted);
  line-height: 1.6;
}
.stat-dark-link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 11px;
  font-weight: 500;
  letter-spacing: .1em;
  text-transform: uppercase;
  color: var(--gold);
  transition: gap .25s;
  margin-top: 20px;
}
.stat-dark-link:hover { gap: 14px; }

/* ══════════════════════════════════════
   SERVIÇOS
══════════════════════════════════════ */
.services {
  position: relative;
  z-index: 1;
  border-top: 1px solid var(--border);
}
.services-header {
  display: grid;
  grid-template-columns: 1fr 1fr;
  border-bottom: 1px solid var(--border);
}
.services-header-left {
  padding: 80px 64px 80px 0;
  border-right: 1px solid var(--border);
}
.services-header-right {
  padding: 80px 0 80px 64px;
  display: flex;
  align-items: flex-end;
}
.services-header-desc {
  font-size: 14px;
  font-weight: 300;
  color: var(--text-muted);
  line-height: 1.85;
  max-width: 380px;
}

.section-eyebrow {
  font-size: 10px;
  font-weight: 500;
  letter-spacing: .22em;
  text-transform: uppercase;
  color: var(--gold);
  display: flex;
  align-items: center;
  gap: 12px;
  text-align: center;
  justify-content: center;
  margin-bottom: 20px;
}
.section-eyebrow::before {
  content: '';
  width: 28px; height: 1px;
  background: var(--gold);
}
.section-title {
  font-family: 'Bebas Neue', sans-serif;
  font-size: clamp(42px, 5vw, 72px);
  line-height: .95;
  letter-spacing: .04em;
  color: var(--text);
  text-align: center;
}

.services-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
}
.service-item {
  padding: 60px 52px;
  border-right: 1px solid var(--border);
  position: relative;
  transition: background .3s;
}
.service-item:last-child { border-right: none; }
.service-item:hover { background: rgba(255,255,255,.012); }
.service-item::after {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 1px;
  background: var(--gold);
  transform: scaleX(0);
  transform-origin: left;
  transition: transform .45s ease;
}
.service-item:hover::after { transform: scaleX(1); }

.service-num {
  font-family: 'Bebas Neue', sans-serif;
  font-size: 11px;
  letter-spacing: .2em;
  color: var(--text-dim);
  margin-bottom: 36px;
}
.service-icon { font-size: 26px; margin-bottom: 18px; display: block; }
.service-title {
  font-family: 'Bebas Neue', sans-serif;
  font-size: 26px;
  letter-spacing: .07em;
  color: var(--text);
  margin-bottom: 12px;
}
.service-desc {
  font-size: 13px;
  font-weight: 300;
  color: var(--text-muted);
  line-height: 1.75;
}
.service-link {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 10px;
  font-weight: 500;
  letter-spacing: .12em;
  text-transform: uppercase;
  color: var(--gold);
  margin-top: 24px;
  transition: gap .25s;
}
.service-link:hover { gap: 12px; }

/* ══════════════════════════════════════
   DESTAQUES (alternados)
══════════════════════════════════════ */
.highlight {
  position: relative;
  z-index: 1;
  border-top: 1px solid var(--border);
}
.highlight-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  border-bottom: 1px solid var(--border);
}
.highlight-row:last-child { border-bottom: none; }

.highlight-visual {
  position: relative;
  overflow: hidden;
  background: var(--bg-mid);
  min-height: 480px;
}
.highlight-planet-scene {
  position: absolute;
  inset: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  
}
.hl-planet {
  width: min(280px, 60%);
  aspect-ratio: 1;
  border-radius: 50%;
  position: relative;
}
.hl-planet-body {
  position: absolute;
  inset: 0;
  border-radius: 50%;
  transition: transform .6s ease;
}
.highlight-visual:hover .hl-planet-body { transform: scale(1.04); }
.hl-label {
  position: absolute;
  bottom: 28px; left: 28px;
  font-size: 10px;
  letter-spacing: .16em;
  text-transform: uppercase;
  color: var(--text-dim);
}

.highlight-text {
  padding: 80px 64px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  border-left: 1px solid var(--border);
}
.highlight-row.reverse .highlight-text {
  border-left: none;
  border-right: 1px solid var(--border);
  order: -1;
}
.highlight-tag {
  font-size: 10px;
  font-weight: 500;
  letter-spacing: .2em;
  text-transform: uppercase;
  color: var(--gold);
  margin-bottom: 24px;
}
.highlight-title {
  font-family: 'Bebas Neue', sans-serif;
  font-size: clamp(36px, 4vw, 58px);
  letter-spacing: .05em;
  color: var(--text);
  line-height: 1;
  margin-bottom: 24px;
}
.highlight-body {
  font-size: 14px;
  font-weight: 300;
  color: var(--text-muted);
  line-height: 1.85;
  max-width: 380px;
  margin-bottom: 36px;
}
.highlight-link {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  font-size: 11px;
  font-weight: 500;
  letter-spacing: .12em;
  text-transform: uppercase;
  color: var(--text);
  transition: gap .25s, color .2s;
  border-bottom: 1px solid var(--border);
  padding-bottom: 4px;
  width: fit-content;
}
.highlight-link:hover { gap: 16px; color: var(--gold); border-color: var(--gold); }

/* ══════════════════════════════════════
   DEPOIMENTOS
══════════════════════════════════════ */
.testimonials {
  position: relative;
  z-index: 1;
  border-top: 1px solid var(--border);
}
.testimonials-header {
  padding: 80px 0 60px;
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
  border-bottom: 1px solid var(--border);
}
.testimonials-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  border-bottom: 1px solid var(--border);
}
.testimonial-item {
  padding: 60px 48px;
  border-right: 1px solid var(--border);
  position: relative;
}
.testimonial-item:last-child { border-right: none; }
.testimonial-quote {
  font-family: 'Cormorant Garamond', serif;
  font-size: 72px;
  font-style: italic;
  color: var(--gold);
  line-height: .8;
  opacity: .3;
  margin-bottom: 20px;
}
.testimonial-text {
  font-family: 'Cormorant Garamond', serif;
  font-size: 17px;
  font-style: italic;
  font-weight: 300;
  color: var(--text-muted);
  line-height: 1.75;
  margin-bottom: 28px;
}
.testimonial-author {
  font-size: 11px;
  font-weight: 500;
  letter-spacing: .12em;
  text-transform: uppercase;
  color: var(--text-dim);
}
.testimonial-role {
  font-size: 11px;
  color: var(--text-dim);
  margin-top: 4px;
  font-weight: 300;
}

/* ══════════════════════════════════════
   DIFERENCIAIS
══════════════════════════════════════ */
.differentials {
  position: relative;
  z-index: 1;
  border-top: 1px solid var(--border);
}
.diff-inner {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  border-bottom: 1px solid var(--border);
}
.diff-item {
  padding: 52px 36px;
  border-right: 1px solid var(--border);
  text-align: center;
  transition: background .3s;
}
.diff-item:last-child { border-right: none; }
.diff-item:hover { background: rgba(200,169,110,.02); }
.diff-icon { font-size: 24px; margin: 0 auto 16px; }
.diff-title {
  font-family: 'Bebas Neue', sans-serif;
  font-size: 16px;
  letter-spacing: .1em;
  color: var(--text);
  margin-bottom: 8px;
}
.diff-desc {
  font-size: 12px;
  font-weight: 300;
  color: var(--text-muted);
  line-height: 1.65;
}

/* ══════════════════════════════════════
   FOOTER
══════════════════════════════════════ */
.footer {
  position: relative;
  z-index: 1;
  background: var(--bg-mid);
  border-top: 1px solid var(--border);
}
.footer-hero {
  padding: 100px 0 80px;
  border-bottom: 1px solid var(--border);
  text-align: center;
}
.footer-cta-title {
  font-family: 'Bebas Neue', sans-serif;
  font-size: clamp(56px, 7vw, 100px);
  letter-spacing: .05em;
  line-height: .95;
  color: var(--text);
  margin-bottom: 32px;
}
.footer-cta-title span { color: var(--gold); }

.footer-bottom {
  padding: 36px 0;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.footer-brand {
  font-family: 'Bebas Neue', sans-serif;
  font-size: 18px;
  letter-spacing: .12em;
  color: var(--text-muted);
  display: flex;
  align-items: center;
  gap: 10px;
}
.footer-brand-dot { width: 5px; height: 5px; border-radius: 50%; background: var(--gold); }
.footer-links { display: flex; gap: 28px; }
.footer-links a {
  font-size: 12px;
  font-weight: 300;
  color: var(--text-dim);
  letter-spacing: .06em;
  transition: color .2s;
}
.footer-links a:hover { color: var(--gold); }
.footer-copy { font-size: 12px; color: var(--text-dim); font-weight: 300; }

/* ══════════════════════════════════════
   ANIMAÇÕES
══════════════════════════════════════ */
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(20px); }
  to   { opacity: 1; transform: translateY(0); }
}

.reveal {
  opacity: 0;
  transform: translateY(30px);
  transition: opacity .8s ease, transform .8s ease;
}
.reveal.visible { opacity: 1; transform: translateY(0); }
.reveal-delay-1 { transition-delay: .1s; }
.reveal-delay-2 { transition-delay: .2s; }
.reveal-delay-3 { transition-delay: .3s; }
.reveal-delay-4 { transition-delay: .4s; }

/* ══════════════════════════════════════
   CONTAINER
══════════════════════════════════════ */
.wrap {
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 60px;
}

/* ══════════════════════════════════════
   RESPONSIVO
══════════════════════════════════════ */
@media (max-width: 1024px) {
  .nav { padding: 0 32px; }
  .wrap { padding: 0 32px; }
  .hero-title { font-size: 64px; }
  .hero-left { padding: 120px 40px 70px; }
  .services-grid { grid-template-columns: 1fr 1fr; }
  .service-item:nth-child(2) { border-right: none; }
  .service-item:nth-child(3) { border-top: 1px solid var(--border); grid-column: 1 / -1; }
  .diff-inner { grid-template-columns: repeat(3, 1fr); }
  .diff-item:nth-child(3) { border-right: none; }
  .diff-item:nth-child(4),
  .diff-item:nth-child(5) { border-top: 1px solid var(--border); }
}

@media (max-width: 768px) {
  .nav-links { display: none; }
  .hero-inner { grid-template-columns: 1fr; }
  .hero-right { min-height: 50vh; }
  .hero-left { padding: 100px 24px 60px; border-right: none; border-bottom: 1px solid var(--border); }
  .hero-bottom { grid-template-columns: 1fr 1fr; }
  .hero-bottom-cell:last-child { grid-column: 1 / -1; border-right: none; border-top: 1px solid var(--border); }
  .about-inner { grid-template-columns: 1fr; }
  .about-left { border-right: none; border-bottom: 1px solid var(--border); padding: 60px 24px; }
  .about-right { grid-template-columns: 1fr 1fr; }
  .services-header { grid-template-columns: 1fr; }
  .services-header-left { border-right: none; border-bottom: 1px solid var(--border); padding: 60px 24px; }
  .services-header-right { padding: 40px 24px; }
  .services-grid { grid-template-columns: 1fr; }
  .service-item { border-right: none; border-bottom: 1px solid var(--border); padding: 48px 24px; }
  .service-item:last-child { border-bottom: none; }
  .highlight-row { grid-template-columns: 1fr; }
  .highlight-visual { min-height: 320px; }
  .highlight-text { padding: 52px 24px; border-left: none !important; border-right: none !important; }
  .highlight-row.reverse .highlight-text { order: 0; }
  .testimonials-grid { grid-template-columns: 1fr; }
  .testimonial-item { border-right: none; border-bottom: 1px solid var(--border); }
  .testimonial-item:last-child { border-bottom: none; }
  .diff-inner { grid-template-columns: 1fr 1fr; }
  .diff-item:nth-child(2) { border-right: none; }
  .diff-item:nth-child(3) { border-top: 1px solid var(--border); }
  .footer-bottom { flex-direction: column; gap: 20px; text-align: center; }
  .wrap { padding: 0 24px; }
}
</style>
</head>
<body>

<div class="starfield"><canvas id="stars"></canvas></div>
<nav class="navbar">
  <a href="{{ route('welcome') }}" class="navbar-brand">
    <span class="dot"></span>
    C-Moon
  </a>

  <ul class="navbar-links">
    @auth
      <li><a href="{{ route('astronautas.index') }}">Astronautas</a></li>
      <li><a href="{{ route('corpos.index') }}">Corpos Celestes</a></li>
      <li><a href="{{ route('missoes.index') }}">Missões</a></li>
    @endauth
  </ul>

  <div class="navbar-actions">
    @auth
      <a href="{{ route('astronautas.index') }}" class="btn btn-ghost btn-sm">Dashboard</a>

      {{-- Dropdown de perfil --}}
      <div class="navbar-user" id="userMenu">
        <button class="navbar-user-btn" onclick="toggleUserDropdown()">
          <span class="navbar-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</span>
          {{ explode(' ', Auth::user()->name)[0] }}
          <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
            <path d="M3 4.5l3 3 3-3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
          </svg>
        </button>

        <div class="navbar-dropdown" id="userDropdown">
          <div class="navbar-dropdown-header">
            <div class="navbar-dropdown-name">{{ Auth::user()->name }}</div>
            <div class="navbar-dropdown-email">{{ Auth::user()->email }}</div>
          </div>

          <a href="{{ route('profile.edit') }}" class="navbar-dropdown-item">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M8 8a3 3 0 100-6 3 3 0 000 6z"/>
              <path d="M2 14s.5-4 6-4 6 4 6 4" stroke-linecap="round"/>
            </svg>
            Meu perfil
          </a>

          <a href="{{ route('astronautas.index') }}" class="navbar-dropdown-item">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
              <rect x="1" y="3" width="14" height="10" rx="1.5"/>
              <path d="M5 7h6M5 10h4" stroke-linecap="round"/>
            </svg>
            Dashboard
          </a>

          <div class="navbar-dropdown-divider"></div>

          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="navbar-dropdown-item danger">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M10 3h3a1 1 0 011 1v8a1 1 0 01-1 1h-3" stroke-linecap="round"/>
                <path d="M7 11l3-3-3-3M10 8H2" stroke-linecap="round"/>
              </svg>
              Sair
            </button>
          </form>
        </div>
      </div>
    @else
      <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Entrar</a>
      @if (Route::has('register'))
        <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Criar conta</a>
      @endif
    @endauth
  </div>
</nav>

{{-- ══ HERO ══ --}}
<section class="hero">
  <div class="hero-bg"></div>
  <div class="hero-grid"></div>
 

  <div class="hero-inner wrap" style="max-width:100%; padding:0;">
    <div class="hero-left">
      <div class="hero-eyebrow">
        <span class="hero-eyebrow-line"></span>
        Exploração espacial
      </div>
      <h1 class="hero-title">
        MISSÕES
        <span class="hero-title-accent">QUE MOLDAM</span>
        O COSMOS.
      </h1>
      <p class="hero-sub">
        Plataforma centralizada para gestão de astronautas,
        missões espaciais e corpos celestes. Dados precisos,
        decisões mais rápidas.
      </p>
      <div class="hero-cta">
        @auth
          <a href="{{ route('missoes.index') }}" class="btn-gold">Ver missões</a>
          <a href="{{ route('astronautas.index') }}" class="btn-ghost-slim">Dashboard →</a>
        @else
          <a href="{{ route('login') }}" class="btn-gold">Acessar sistema</a>
          <a href="#sobre" class="btn-ghost-slim">Saiba mais →</a>
        @endauth
      </div>
    </div>

    <div class="hero-right">
      
      <div class="hero-float-text">
        Dados precisos para<br>decisões mais rápidas<br>e exploração mais segura.
      </div>
    </div>
  </div>

</section>

{{-- ══ ABOUT ══ --}}
<section class="about" id="sobre">
  <div class="wrap" style="max-width:100%; padding:0;">
    <div class="about-inner">
      <div class="about-left reveal">
        <div class="about-micro">AT</div>
        <h2 class="about-title">C&#8209;MOON,</h2>
        <p class="about-body">
          Acreditamos que a exploração espacial vai além de dados —
          é sobre decisões mais rápidas, missões mais seguras e
          o avanço contínuo da humanidade além da atmosfera terrestre.
          Cada registro é uma peça fundamental da história da ciência.
        </p>
      </div>
      <div class="about-right">
        <div class="stat-cell reveal reveal-delay-1">
          <div class="stat-label">missões registradas desde o início do programa</div>
          <div class="stat-val">{{ \App\Models\Missao::count() }}</div>
        </div>
        <div class="stat-cell reveal reveal-delay-2">
          <div class="stat-label">astronautas ativos e prontos para operação</div>
          <div class="stat-val">{{ \App\Models\Astronauta::where('status','ativo')->count() }}</div>
        </div>
        <div class="stat-cell reveal reveal-delay-3">
          <div class="stat-label">corpos celestes catalogados no sistema</div>
          <div class="stat-val">{{ \App\Models\Corpo::count() }}</div>
        </div>
        <div class="stat-cell dark reveal reveal-delay-4">
          <p class="stat-dark-text">
            O universo não espera — nem sua operação deveria.
          </p>
          @auth
            <a href="{{ route('missoes.index') }}" class="stat-dark-link">Ver missões →</a>
          @else
            <a href="{{ route('login') }}" class="stat-dark-link">Entrar no sistema →</a>
          @endauth
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ══ SERVIÇOS ══ --}}
<section class="services" id="servicos">
  <div class="wrap" style="max-width:100%; padding:0;">
    <div class="services-header">
      <div class="services-header-left reveal">
        <div class="section-eyebrow">O que oferecemos</div>
        <h2 class="section-title">MÓDULOS<br>DO SISTEMA</h2>
      </div>
      <div class="services-header-right reveal reveal-delay-2">
        <p class="services-header-desc">
          Três módulos integrados para gestão completa da operação espacial.
          Cada um projetado para oferecer precisão, velocidade e controle total.
        </p>
      </div>
    </div>
   

{{-- ══ DESTAQUES ALTERNADOS ══ --}}
<section class="highlight">

  {{-- linha 1: visual | texto --}}
  <div class="highlight-row">
    <div class="highlight-visual">
      <div class="highlight-planet-scene">
        <div class="hl-planet">
         
        </div>
      </div>
      <div class="hl-label">Gestão de Astronautas</div>
    </div>
    <div class="highlight-text reveal">
      <div class="highlight-tag">Módulo 01</div>
      <h3 class="highlight-title">EQUIPE DE<br>VOO COMPLETA</h3>
      <p class="highlight-body">
        Gerencie cada tripulante com profundidade — especialidades, histórico de missões,
        status operacional e vinculações. Tudo em um só lugar, acessível em segundos.
      </p>
      @auth
        <a href="{{ route('astronautas.index') }}" class="highlight-link">Ver astronautas →</a>
      @else
        <a href="{{ route('login') }}" class="highlight-link">Acessar sistema →</a>
      @endauth
    </div>
  </div>

  {{-- linha 2: texto | visual --}}
  <div class="highlight-row reverse">
    <div class="highlight-visual">
      <div class="highlight-planet-scene">
        <div class="hl-planet">
         
        </div>
      </div>
      <div class="hl-label">Cartografia Espacial</div>
    </div>
    <div class="highlight-text reveal">
      <div class="highlight-tag">Módulo 02</div>
      <h3 class="highlight-title">CARTOGRAFIA<br>DO COSMOS</h3>
      <p class="highlight-body">
        Catalogue o universo com precisão científica. Planetas, luas, asteroides,
        cometas e estrelas — cada objeto catalogado com dados técnicos completos.
      </p>
      @auth
        <a href="{{ route('corpos.index') }}" class="highlight-link">Ver corpos celestes →</a>
      @else
        <a href="{{ route('login') }}" class="highlight-link">Acessar sistema →</a>
      @endauth
    </div>
  </div>

</section>




{{-- ══ FOOTER ══ --}}
<footer class="footer">
  <div class="wrap">
    <div class="footer-hero reveal">
      <h2 class="footer-cta-title">
        ALÉM DA<br><span>ATMOSFERA.</span>
      </h2>
      @auth
        <a href="{{ route('astronautas.index') }}" class="btn-gold">Acessar dashboard</a>
      @else
        <a href="{{ route('login') }}" class="btn-gold">Entrar no sistema</a>
      @endauth
    </div>
    <div class="footer-bottom">
      <span class="footer-brand">
        <span class="footer-brand-dot"></span>
        C-MOON
      </span>
      <div class="footer-links">
        @auth
          <a href="{{ route('astronautas.index') }}">Astronautas</a>
          <a href="{{ route('corpos.index') }}">Corpos Celestes</a>
          <a href="{{ route('missoes.index') }}">Missões</a>
          <a href="{{ route('profile.edit') }}">Perfil</a>
        @else
          <a href="{{ route('login') }}">Entrar</a>
          @if(Route::has('register'))<a href="{{ route('register') }}">Criar conta</a>@endif
        @endauth
      </div>
      <span class="footer-copy">Sistema de Exploração Espacial — {{ date('Y') }}</span>
    </div>
  </div>
</footer>

<script src="{{ asset('js/cmoon.js') }}"></script>
<script>
// Navbar scroll
const nav = document.getElementById('mainNav');
window.addEventListener('scroll', () => {
  nav.classList.toggle('scrolled', window.scrollY > 20);
}, { passive: true });

// Dropdown
function toggleDropdown() {
  document.getElementById('navDropdown').classList.toggle('open');
}
document.addEventListener('click', e => {
  const menu = document.getElementById('userMenu');
  if (menu && !menu.contains(e.target))
    document.getElementById('navDropdown')?.classList.remove('open');
});

// Parallax planeta hero
const planet = document.getElementById('heroPlanet');
if (planet) {
  document.addEventListener('mousemove', e => {
    const dx = (e.clientX / innerWidth - .5) * 18;
    const dy = (e.clientY / innerHeight - .5) * 18;
    planet.style.transform = `translate(calc(-50% + ${dx}px), calc(-50% + ${dy}px))`;
  });
}

// Scroll reveal
const observer = new IntersectionObserver(entries => {
  entries.forEach(el => {
    if (el.isIntersecting) { el.target.classList.add('visible'); observer.unobserve(el.target); }
  });
}, { threshold: 0.12 });
document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>
</body>
</html>