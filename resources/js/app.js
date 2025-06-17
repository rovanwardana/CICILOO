import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.querySelector('#sidebar button');
    const sidebar = document.getElementById('sidebar');
    const labels = sidebar.querySelectorAll('.label');
    const mainContent = document.getElementById('mainContent');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('w-[220px]');
        sidebar.classList.toggle('w-[90px]');

        labels.forEach(label => label.classList.toggle('hidden'));

        mainContent.classList.toggle('ml-[240px]');
        mainContent.classList.toggle('ml-[80px]');
    });
});
