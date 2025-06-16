import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.querySelector('#sidebar button'); // ambil tombol pertama di sidebar
    const sidebar = document.getElementById('sidebar');
    const labels = sidebar.querySelectorAll('span'); // ambil semua label menu di sidebar

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('w-[220px]');
        sidebar.classList.toggle('w-[60px]');

        labels.forEach(label => {
            label.classList.toggle('hidden');
        });
    });
});

const mainContent = document.getElementById('mainContent');

toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('w-[220px]');
    sidebar.classList.toggle('w-[60px]');
    labels.forEach(label => label.classList.toggle('hidden'));

    mainContent.classList.toggle('ml-[220px]');
    mainContent.classList.toggle('ml-[60px]');
});

