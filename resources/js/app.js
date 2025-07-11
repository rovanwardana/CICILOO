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

    // Notification Functionality
    const notificationButton = document.getElementById('notificationButton');
    const notificationPanel = document.getElementById('notificationPanel');
    const notificationList = document.getElementById('notificationList');
    const notificationBadge = document.getElementById('notification-badge');

    if (notificationButton && notificationPanel && notificationList && notificationBadge) {
        // Ambil data notifikasi saat halaman dimuat
        fetch('/notifications')
            .then(response => response.json())
            .then(data => {
                const count = data.count;

                // Update badge
                if (count > 0) {
                    notificationBadge.textContent = count;
                    notificationBadge.classList.remove('hidden');
                }

                // Masukkan HTML Blade
                notificationList.innerHTML = data.html;
            })
            .catch(error => console.error('Error fetching notifications:', error));


        // Toggle panel
        notificationButton.addEventListener('click', () => {
            notificationPanel.classList.toggle('hidden');
        });

        // Tutup panel saat klik di luar
        document.addEventListener('click', (event) => {
            if (!notificationButton.contains(event.target) && !notificationPanel.contains(event.target)) {
                notificationPanel.classList.add('hidden');
            }
        });
    } else {
        console.error('Notification elements not found:', { notificationButton, notificationPanel, notificationList, notificationBadge });
    }

    // New Bill functionality
    initializeNewBillForm();
});
