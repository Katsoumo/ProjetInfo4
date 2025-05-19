console.log('⚙️ editionprofil.js chargé');

document.addEventListener('DOMContentLoaded', function() {
    const profileForm = document.getElementById('profile-form');
    if (!profileForm) return;

    const submitBtn = document.getElementById('submit-profile');
    submitBtn.style.display = 'none';

    // Activer l'édition des champs
    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', function() {
            const fieldName = this.getAttribute('data-field');
            const inputField = document.getElementById(fieldName);
            
            if (inputField.readOnly) {
                // Passer en mode édition
                inputField.readOnly = false;
                inputField.classList.add('editing');
                this.textContent = 'Annuler';
                submitBtn.style.display = 'block';
            } else {
                // Revenir en mode lecture
                inputField.readOnly = true;
                inputField.classList.remove('editing');
                this.textContent = 'Edit';
                
                // Vérifier si d'autres champs sont en édition
                const editingFields = document.querySelectorAll('.editing');
                if (editingFields.length === 0) {
                    submitBtn.style.display = 'none';
                }
            }
        });
    });

    // Gestion de la soumission du formulaire
    profileForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Afficher un message de confirmation
        const confirmation = confirm('Voulez-vous vraiment enregistrer les modifications ?');
        if (!confirmation) return;
        
        // Soumettre le formulaire
        this.submit();
    });
});