import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    // Toggle Sidebar
    const toggleBtn = document.querySelector('#sidebar button');
    const sidebar = document.getElementById('sidebar');
    const labels = sidebar ? sidebar.querySelectorAll('.label') : [];
    const mainContent = document.getElementById('mainContent');

    if (toggleBtn && sidebar && mainContent) {
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('w-[220px]');
            sidebar.classList.toggle('w-[90px]');

            labels.forEach(label => label.classList.toggle('hidden'));

            mainContent.classList.toggle('ml-[240px]');
            mainContent.classList.toggle('ml-[80px]');
        });
    } else {
        console.error('One or more sidebar elements not found:', { toggleBtn, sidebar, mainContent });
    }

    // Logout Popup
    const logoutLinks = document.querySelectorAll('a .label');
    const logoutPopup = document.getElementById('logoutPopup');
    const confirmLogoutBtn = document.getElementById('confirmLogout');
    const cancelLogoutBtn = document.getElementById('cancelLogout');

    if (logoutLinks.length > 0 && logoutPopup && confirmLogoutBtn && cancelLogoutBtn) {
        logoutLinks.forEach(link => {
            if (link.textContent.trim() === 'Log out') {
                const logoutLink = link.closest('a');
                logoutLink.addEventListener('click', (e) => {
                    e.preventDefault();
                    logoutPopup.classList.remove('hidden');
                });
            }
        });

        confirmLogoutBtn.addEventListener('click', () => {
            document.getElementById('logoutForm').submit();
            logoutPopup.classList.add('hidden');
        });

        cancelLogoutBtn.addEventListener('click', () => {
            logoutPopup.classList.add('hidden');
        });
    } else {
        console.error('Logout elements not found:', {
            logoutLinks,
            logoutPopup,
            confirmLogoutBtn,
            cancelLogoutBtn
        });
    }
});