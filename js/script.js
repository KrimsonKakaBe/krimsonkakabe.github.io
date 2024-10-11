function updateDate() {
    const now = new Date();
    const utcOffset = 3; // UTC+3
    const localDate = new Date(now.getTime() + utcOffset * 60 * 60 * 1000);
    const formattedDate = localDate.toLocaleDateString('fr-FR', {
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
    document.getElementById('current-date').textContent = formattedDate;
}

window.onload = function() {
    updateDate();
    setInterval(updateDate, 60000); // Mise à jour chaque minute
}

// Menu
function toggleMenu() {
    const menuItems = document.querySelector('.menu-items');
    menuItems.classList.toggle('active');
}

