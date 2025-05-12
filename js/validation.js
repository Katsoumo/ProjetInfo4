document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('form').forEach(form => {
      const email = form.querySelector('input[type="email"]');
      const password = form.querySelector('input[type="password"]');
      const submitBtn = form.querySelector('button[type="submit"]');
  
      const checkForm = () => {
        let valid = true;
        if (email) {
          const reEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          if (!reEmail.test(email.value)) {
            email.setCustomValidity('Veuillez entrer une adresse email valide');
            valid = false;
          } else {
            email.setCustomValidity('');
          }
        }
        if (password) {
          if (password.value.length < 6) {
            password.setCustomValidity('Le mot de passe doit contenir au moins 6 caractères');
            valid = false;
          } else {
            password.setCustomValidity('');
          }
        }
        if (submitBtn) submitBtn.disabled = !valid;
      };
  
      if (email) email.addEventListener('input', checkForm);
      if (password) password.addEventListener('input', checkForm);
      checkForm();
    });
  });