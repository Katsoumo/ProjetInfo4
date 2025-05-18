console.log('[price-calculator] script chargé et exécuté');
// Placez tout votre code dans une IIFE qui s'exécute tout de suite :
(function() {
  const form        = document.querySelector('.search-form');
  console.log('[price-calculator] form =', form);

  const display     = document.getElementById('price-display');
  const hiddenInput = document.getElementById('prix-final-input');

  function updatePrice() {
    console.log('[price-calculator] recalcul en cours');
    let total = 500;
    const safariType = document.getElementById('type-de-safari').value;
    if (safariType === 'Aventure') total += 50;
    if (safariType === 'Privée')   total += 70;

    const logType = document.getElementById('type-de-logement').value;
    if (logType === 'Ecolodge')    total -= 50;
    if (logType === 'Lodge')       total += 150;
    if (logType === 'Tented-Camp') total += 300;

    display.textContent = `${total}€`;
    hiddenInput.value   = total;
  }

  // Premier calcul
  updatePrice();

  // Ré-écoute tous les changements
  form.addEventListener('change', updatePrice);
  form.addEventListener('input',  updatePrice);
})();
