document.addEventListener('DOMContentLoaded', function () {


    const formTambah = document.getElementById('tambahForm');
    const formEdit = document.getElementById('editForm');

    function validasiHarga(event) {
        const hargaBeli = parseFloat(document.getElementById('hargaBeli').value);
        const hargaSekarang = parseFloat(document.getElementById('hargaSekarang').value);

        if (hargaBeli < 0 || hargaSekarang < 0) {
            alert('Peringatan: Harga investasi tidak boleh bernilai minus!');
            event.preventDefault();
        }
    }

    if (formTambah) {
        formTambah.addEventListener('submit', validasiHarga);
    }
    if (formEdit) {
        formEdit.addEventListener('submit', validasiHarga);
    }

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('action-hapus')) {
            const konfirmasi = confirm('Apakah Anda yakin ingin menghapus data investasi barang ini?');
            if (!konfirmasi) {
                event.preventDefault();
            }
        }
    });
});

// Aset JavaScript Modular - Sinkronisasi Tema Halaman
document.addEventListener('DOMContentLoaded', () => {
    const themeToggleBtn = document.getElementById('theme-toggle');
    const currentTheme = localStorage.getItem('theme');

    // 1. Cek preferensi tema sebelumnya di browser
    if (currentTheme === 'dark') {
        document.body.classList.add('dark-mode');
        if (themeToggleBtn) themeToggleBtn.innerText = "☀️ Light Mode";
    } else {
        if (themeToggleBtn) themeToggleBtn.innerText = "🌙 Dark Mode";
    }

    // 2. Operasi klik sakelar tema (Berlaku global untuk semua halaman)
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');

            let theme = 'light';
            if (document.body.classList.contains('dark-mode')) {
                theme = 'dark';
                themeToggleBtn.innerText = "☀️ Light Mode";
            } else {
                themeToggleBtn.innerText = "🌙 Dark Mode";
            }

            // Simpan preferensi agar tema tetap konsisten saat berpindah halaman
            localStorage.setItem('theme', theme);
        });
    }
});