
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
  
function checkPasswordMatch() {
  const pwd          = document.getElementById('password');
  const confirm      = document.getElementById('confirm_password');
  const pwdError     = document.getElementById('password-error');
  const confirmError = document.getElementById('confirm-error');

  // Réinitialisation
  pwdError.textContent     = '';
  confirmError.textContent = '';

  // 1) longueur minimale
  if (pwd.value.length > 0 && pwd.value.length < 8) {
    pwdError.textContent = 'Il faut 8 caractères minimum';
  }
  // 2) correspondance
  if (confirm.value && confirm.value !== pwd.value) {
    confirmError.textContent = 'Les mots de passe ne correspondent pas';
  }
}