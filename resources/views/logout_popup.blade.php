<div id="logoutPopup" class="hidden fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-white dark:bg-[#1D0002] rounded-lg shadow-lg p-6 w-[300px] text-[#1b1b18] dark:text-[#EDEDEC]">
        <h2 class="text-xl font-semibold mb-4">Konfirmasi Logout</h2>
        <p class="mb-6 text-sm">Apakah Anda yakin ingin logout?</p>
        <div class="flex justify-end gap-4">
            <button id="cancelLogout" class="px-4 py-2 bg-gray-200 dark:bg-[#3E3E3A] rounded-md hover:bg-gray-300 dark:hover:bg-[#62605b] text-sm text-[#1b1b18] dark:text-[#A1A09A]">
                Tidak
            </button>
            <button id="confirmLogout" class="px-4 py-2 bg-red-600 dark:bg-[#F61500] rounded-md hover:bg-red-700 dark:hover:bg-[#FF4433] text-sm text-white">
                Ya
            </button>
        </div>
    </div>
</div>

<form id="logoutForm" method="POST" action="{{ route('logout') }}" style="display: none;">
    @csrf
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Pastikan ikon logout ada
        const logoutIcon = document.querySelector('img[alt="Logout"]');
        if (logoutIcon) {
            logoutIcon.addEventListener('click', function() {
                document.getElementById('logoutPopup').classList.remove('hidden');
            });
        } else {
            console.error('Ikon logout tidak ditemukan di DOM.');
        }

        // Tombol Batal
        const cancelButton = document.getElementById('cancelLogout');
        if (cancelButton) {
            cancelButton.addEventListener('click', function() {
                document.getElementById('logoutPopup').classList.add('hidden');
            });
        } else {
            console.error('Tombol Batal tidak ditemukan di DOM.');
        }

        // Tombol Konfirmasi Logout
        const confirmButton = document.getElementById('confirmLogout');
        if (confirmButton) {
            confirmButton.addEventListener('click', function() {
                window.location.href = "{{ route('logout') }}"; // Sesuaikan rute sesuai kebutuhan
            });
        } else {
            console.error('Tombol Konfirmasi Logout tidak ditemukan di DOM.');
        }
    });
</script>