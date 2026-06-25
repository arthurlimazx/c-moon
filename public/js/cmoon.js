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

function cmxConfirm(message, title = 'Confirmar ação') {
  return new Promise(resolve => {
    let overlay = document.getElementById('cmxModalOverlay');
    if (!overlay) {
      overlay = document.createElement('div');
      overlay.id = 'cmxModalOverlay';
      overlay.className = 'cmx-modal-overlay';
      overlay.innerHTML = `
        <div class="cmx-modal-box" role="alertdialog" aria-modal="true">
          <div class="cmx-modal-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 9v4M12 17h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"/>
            </svg>
          </div>
          <div class="cmx-modal-title"></div>
          <div class="cmx-modal-msg"></div>
          <div class="cmx-modal-actions">
            <button type="button" class="cmx-modal-btn cmx-modal-btn-cancel">Cancelar</button>
            <button type="button" class="cmx-modal-btn cmx-modal-btn-confirm">Confirmar</button>
          </div>
        </div>`;
      document.body.appendChild(overlay);
    }

    overlay.querySelector('.cmx-modal-title').textContent = title;
    overlay.querySelector('.cmx-modal-msg').textContent   = message;

    const btnCancel  = overlay.querySelector('.cmx-modal-btn-cancel');
    const btnConfirm = overlay.querySelector('.cmx-modal-btn-confirm');

    const close = result => {
      overlay.classList.remove('is-open');
      document.removeEventListener('keydown', onKeydown);
      btnCancel.removeEventListener('click', onCancel);
      btnConfirm.removeEventListener('click', onConfirm);
      overlay.removeEventListener('click', onBackdrop);
      resolve(result);
    };
    const onCancel   = () => close(false);
    const onConfirm  = () => close(true);
    const onBackdrop = e => { if (e.target === overlay) close(false); };
    const onKeydown  = e => { if (e.key === 'Escape') close(false); };

    btnCancel.addEventListener('click', onCancel);
    btnConfirm.addEventListener('click', onConfirm);
    overlay.addEventListener('click', onBackdrop);
    document.addEventListener('keydown', onKeydown);

    overlay.classList.add('is-open');
    btnCancel.focus();
  });
}

(function () {
  document.querySelectorAll('[data-confirm]').forEach(btn => {
    btn.addEventListener('click', e => {
      e.preventDefault();
      const msg = btn.dataset.confirm || 'Confirmar exclusão?';
      cmxConfirm(msg, 'Confirmar exclusão').then(ok => {
        if (!ok) return;
        if (btn.form) btn.form.submit();
        else if (btn.tagName === 'A' && btn.href) window.location.href = btn.href;
      });
    });
  });
})();

(function () {
  document.querySelectorAll('tbody tr').forEach((row, i) => {
    row.style.opacity   = '0';
    row.style.animation = `fadeUp .35s ${i * 0.04}s ease both`;
  });
})();

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
