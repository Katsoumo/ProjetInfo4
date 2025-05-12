console.log('⚙️ editionprofil.js chargé');
document.addEventListener('DOMContentLoaded', () => {
    const profileForm = document.querySelector('#profile-form');
    if (!profileForm) return;
  
    profileForm.querySelectorAll('.info-group').forEach(group => {
      const input = group.querySelector('input, textarea');
      const editBtn = group.querySelector('.edit-button');
      const originalValue = input.value;
  
      const saveBtn = document.createElement('button');
      saveBtn.type = 'button';
      saveBtn.textContent = 'Valider';
      saveBtn.className = 'save-button';
      saveBtn.style.display = 'none';
  
      const cancelBtn = document.createElement('button');
      cancelBtn.type = 'button';
      cancelBtn.textContent = 'Annuler';
      cancelBtn.className = 'cancel-button';
      cancelBtn.style.display = 'none';
  
      editBtn.insertAdjacentElement('afterend', cancelBtn);
      editBtn.insertAdjacentElement('afterend', saveBtn);
  
      editBtn.addEventListener('click', () => {
        input.removeAttribute('disabled');
        editBtn.style.display = 'none';
        saveBtn.style.display = 'inline-block';
        cancelBtn.style.display = 'inline-block';
      });
  
      saveBtn.addEventListener('click', () => {
        input.setAttribute('disabled', 'disabled');
        saveBtn.style.display = 'none';
        cancelBtn.style.display = 'none';
        editBtn.style.display = 'inline-block';
        if (!document.querySelector('#submit-profile')) {
          const submit = document.createElement('button');
          submit.type = 'submit';
          submit.id = 'submit-profile';
          submit.textContent = 'Enregistrer les modifications';
          profileForm.appendChild(submit);
        }
      });
  
      cancelBtn.addEventListener('click', () => {
        input.value = originalValue;
        input.setAttribute('disabled', 'disabled');
        saveBtn.style.display = 'none';
        cancelBtn.style.display = 'none';
        editBtn.style.display = 'inline-block';
      });
    });
  });