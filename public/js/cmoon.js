/* C-MOON — cmoon.js — animations · editorial tweaks */

// ── STARFIELD ──────────────────────────────────────────────
(function () {
  const canvas = document.getElementById('stars');
  if (!canvas) return;
  const ctx = canvas.getContext('2d');
  let W, H, stars = [];

  function resize() {
    W = canvas.width  = window.innerWidth;
    H = canvas.height = window.innerHeight;
  }

  function buildStars(n) {
    stars = [];
    for (let i = 0; i < n; i++) {
      const size = Math.random();
      stars.push({
        x: Math.random() * W,
        y: Math.random() * H,
        r: size < .72 ? .4 : size < .92 ? .9 : 1.4,
        a: Math.random() * 0.7 + 0.15,
        speed: 0.0008 + Math.random() * 0.0018,
        twinkleOffset: Math.random() * Math.PI * 2
      });
    }
  }

  let t = 0;
  function draw() {
    ctx.clearRect(0, 0, W, H);
    t += 0.006;
    stars.forEach(s => {
      const alpha = s.a * (0.45 + 0.55 * Math.sin(t + s.twinkleOffset));
      ctx.beginPath();
      ctx.arc(s.x, s.y, s.r, 0, Math.PI * 2);
      ctx.fillStyle = `rgba(255,255,255,${alpha})`;
      ctx.fill();
    });
    requestAnimationFrame(draw);
  }

  resize();
  buildStars(320);
  draw();
  window.addEventListener('resize', () => { resize(); buildStars(320); });
})();

// ── NAVBAR SCROLL ──────────────────────────────────────────
(function () {
  const nav = document.querySelector('.navbar');
  if (!nav) return;
  window.addEventListener('scroll', () => {
    if (window.scrollY > 8) {
      nav.style.background    = 'rgba(6,8,15,0.97)';
      nav.style.borderBottom  = '1px solid rgba(255,255,255,0.08)';
    } else {
      nav.style.background    = 'rgba(6,8,15,0.85)';
      nav.style.borderBottom  = '1px solid rgba(255,255,255,0.06)';
    }
  }, { passive: true });
})();

// ── ALERT AUTO-DISMISS ─────────────────────────────────────
(function () {
  document.querySelectorAll('.alert[data-auto-dismiss]').forEach(el => {
    setTimeout(() => {
      el.style.transition = 'opacity .4s, transform .4s';
      el.style.opacity    = '0';
      el.style.transform  = 'translateY(-10px)';
      setTimeout(() => el.remove(), 420);
    }, 3500);
  });
})();

// ── DELETE CONFIRM ─────────────────────────────────────────
(function () {
  document.querySelectorAll('[data-confirm]').forEach(btn => {
    btn.addEventListener('click', e => {
      const msg = btn.dataset.confirm || 'Confirmar exclusão?';
      if (!confirm(msg)) e.preventDefault();
    });
  });
})();

// ── STAGGER ROWS ──────────────────────────────────────────
(function () {
  document.querySelectorAll('tbody tr').forEach((row, i) => {
    row.style.opacity   = '0';
    row.style.animation = `fadeUp .35s ${i * 0.04}s ease both`;
  });

  document.querySelectorAll('.feature-card, .stat-card').forEach((card, i) => {
    card.style.opacity   = '0';
    card.style.animation = `fadeUp .5s ${i * 0.09}s ease both`;
  });
})();

// ── FEATURE CARD MOUSE-GLOW ────────────────────────────────
(function () {
  document.querySelectorAll('.feature-card').forEach(card => {
    card.addEventListener('mousemove', e => {
      const r = card.getBoundingClientRect();
      card.style.setProperty('--mx', ((e.clientX - r.left) / r.width  * 100) + '%');
      card.style.setProperty('--my', ((e.clientY - r.top)  / r.height * 100) + '%');
    });
  });
})();

// ── ORBIT RING PARALLAX (.orbit-decoration) ────────────────
(function () {
  const orbit = document.querySelector('.orbit-decoration');
  if (!orbit) return;
  document.addEventListener('mousemove', e => {
    const dx = (e.clientX / window.innerWidth  - .5) * 20;
    const dy = (e.clientY / window.innerHeight - .5) * 20;
    orbit.style.transform = `translateY(calc(-50% + ${dy}px)) translateX(${dx}px)`;
  });
})();

// ── AUTH — password toggle & strength ─────────────────────
(function () {
  // Toggle show/hide
  document.querySelectorAll('.auth-toggle-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const input = document.getElementById(btn.dataset.target);
      if (!input) return;
      const isText = input.type === 'text';
      input.type = isText ? 'password' : 'text';
      btn.querySelector('.icon-eye')    .style.display = isText ? 'block' : 'none';
      btn.querySelector('.icon-eye-off').style.display = isText ? 'none'  : 'block';
    });
  });

  // Strength meter
  const pwdInput     = document.getElementById('password');
  const strengthWrap = document.getElementById('authStrength');
  if (!pwdInput || !strengthWrap) return;

  const bars  = strengthWrap.querySelectorAll('.auth-strength-bar');
  const label = strengthWrap.querySelector('.auth-strength-label');

  pwdInput.addEventListener('input', () => {
    const val = pwdInput.value;
    if (!val) { strengthWrap.classList.remove('visible'); return; }
    strengthWrap.classList.add('visible');

    let score = 0;
    if (val.length >= 8)  score++;
    if (val.length >= 12) score++;
    if (/[A-Z]/.test(val) && /[a-z]/.test(val)) score++;
    if (/[0-9]/.test(val) && /[^A-Za-z0-9]/.test(val)) score++;

    const cfgs = [
      { color: 'var(--danger)',   text: 'Fraca',    active: 1 },
      { color: 'var(--warning)',  text: 'Razoável', active: 2 },
      { color: 'var(--accent)',   text: 'Boa',      active: 3 },
      { color: 'var(--accent-3)', text: 'Forte',    active: 4 },
    ];
    const cfg = cfgs[Math.max(0, score - 1)];
    bars.forEach((b, i) => {
      b.style.background = i < cfg.active ? cfg.color : 'var(--border)';
    });
    label.textContent = cfg.text;
    label.style.color = cfg.color;
  });
})();

// ── HOME — ORBIT PARALLAX (#orbitDeco) ─────────────────────
(function () {
  const orbit = document.getElementById('orbitDeco');
  if (!orbit) return;
  document.addEventListener('mousemove', e => {
    const dx = (e.clientX / window.innerWidth  - .5) * 26;
    const dy = (e.clientY / window.innerHeight - .5) * 26;
    orbit.style.transform = `translateY(calc(-50% + ${dy}px)) translateX(${dx}px)`;
  });
})();

// ── HOME — INTERSECTION OBSERVER (dash/feature cards) ──────
(function () {
  const targets = document.querySelectorAll('.dash-card, .feature-card');
  if (!targets.length) return;
  const io = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const idx = Array.from(targets).indexOf(entry.target);
        entry.target.style.animation = `fadeUp .55s ${idx * 0.07}s ease both`;
        entry.target.style.opacity   = '1';
        io.unobserve(entry.target);
      }
    });
  }, { threshold: 0.08 });
  targets.forEach(el => { el.style.opacity = '0'; io.observe(el); });
})();

// ── HOME — STATS COUNTER ANIMATION ─────────────────────────
(function () {
  const statValues = document.querySelectorAll('.stat-value[data-count]');
  if (!statValues.length) return;

  const io = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      const el  = entry.target;
      const end = parseInt(el.dataset.count, 10);
      const dur = 1200;
      const step = 16;
      let current = 0;
      const increment = end / (dur / step);
      const timer = setInterval(() => {
        current = Math.min(current + increment, end);
        el.textContent = Math.floor(current);
        if (current >= end) clearInterval(timer);
      }, step);
      io.unobserve(el);
    });
  }, { threshold: 0.3 });

  statValues.forEach(el => io.observe(el));
})();

// ── HOME — PROFILE DROPDOWN ─────────────────────────────────
(function () {
  const dd   = document.getElementById('userDropdown');
  const menu = document.getElementById('userMenu');
  if (!dd || !menu) return;

  window.toggleUserDropdown = function () {
    dd.classList.toggle('open');
  };

  document.addEventListener('click', e => {
    if (!menu.contains(e.target)) dd.classList.remove('open');
  });
})();