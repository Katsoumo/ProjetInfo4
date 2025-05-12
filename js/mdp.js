document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('input[type="password"]').forEach(passwordInput => {
      const btn = document.createElement('button');
      btn.type = 'button';
      btn.className = 'toggle-password';
      btn.innerHTML = '👁️';
      passwordInput.parentNode.insertBefore(btn, passwordInput.nextSibling);
      btn.addEventListener('click', () => {
        passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
      });
    });
  });
  