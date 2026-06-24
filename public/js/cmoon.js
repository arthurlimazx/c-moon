/* C-MOON — cmoon.js — v2 editorial */

// ── SEM STARFIELD (removido) ───────────────────────────────

// ── NAVBAR SCROLL ──────────────────────────────────────────
(function () {
  const nav = document.querySelector('.navbar');
  if (!nav) return;
  window.addEventListener('scroll', () => {
    if (window.scrollY > 8) {
      nav.classList.add('scrolled');
    } else {
      nav.classList.remove('scrolled');
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
})();

// ── AUTH — password toggle & strength ─────────────────────
(function () {
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

// ── SCROLL REVEAL ─────────────────────────────────────────
(function () {
  const observer = new IntersectionObserver(entries => {
    entries.forEach(el => {
      if (el.isIntersecting) {
        el.target.classList.add('visible');
        observer.unobserve(el.target);
      }
    });
  }, { threshold: 0.10 });
  document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
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