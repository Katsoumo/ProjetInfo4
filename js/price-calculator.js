document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.search-form');
    
    if (form) {
        form.addEventListener('change', function() {
            let basePrice = 500; // Prix de base
            
            // Suppléments safari
            const safariType = document.getElementById('type-de-safari').value;
            if (safariType === 'aventure') basePrice += 50;
            if (safariType === 'prive') basePrice += 70;
            
            // Suppléments logement
            const logementType = document.getElementById('type-de-logement').value;
            if (logementType === 'ecolodge') basePrice -= 50;
            if (logementType === 'lodge') basePrice += 150;
            if (logementType === 'tented-camp') basePrice += 300;
            
            document.getElementById('price-display').textContent = `${basePrice}€`;
            document.getElementById('prix-final-input').value = basePrice;
        });
    }
});