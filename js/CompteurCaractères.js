document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('input[maxlength]').forEach(input => {
      const max = input.getAttribute('maxlength');
      const counter = document.createElement('div');
      counter.className = 'char-counter';
      counter.textContent = `0 / ${max}`;
      input.parentNode.insertBefore(counter, input.nextSibling);
      input.addEventListener('input', () => {
        counter.textContent = `${input.value.length} / ${max}`;
      });
    });
  });