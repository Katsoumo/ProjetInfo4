document.addEventListener('DOMContentLoaded', function() {
    const themeToggle = document.createElement('button');
    themeToggle.className = 'theme-toggle';
    themeToggle.innerHTML = '🌓';
    document.body.appendChild(themeToggle);

    themeToggle.addEventListener('click', function() {
        const currentTheme = document.body.classList.contains('dark-mode') ? 'dark' : 'light';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        
        document.body.classList.remove(`${currentTheme}-mode`);
        document.body.classList.add(`${newTheme}-mode`);
        
        // Sauvegarde dans un cookie (30 jours)
        document.cookie = `theme=${newTheme}; path=/; max-age=${30*24*60*60}`;
    });

    // Vérifie le cookie au chargement
    const savedTheme = document.cookie.split('; ').find(row => row.startsWith('theme='))?.split('=')[1] || 'light';
    document.body.classList.add(`${savedTheme}-mode`);
});