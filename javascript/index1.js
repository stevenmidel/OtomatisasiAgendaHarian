document.addEventListener("DOMContentLoaded", function () {
  // Set delay or trigger additional animations on page load
  const elements = document.querySelectorAll('.animate-text');
  elements.forEach((element, index) => {
    element.style.animationDelay = `${0.2 * (index + 1)}s`; // Delay for each element
  });
});

// Fungsi untuk membuka modal
function konfirmasiPembelian() {
  const modal = document.getElementById("modal");
  modal.style.display = "block";  // Menampilkan modal
  setTimeout(() => {
    modal.classList.add('show');  // Menambahkan efek animasi
  }, 10); // Menambahkan sedikit delay agar animasi dapat diterapkan
}

// Fungsi untuk menutup modal jika tombol "Batal" ditekan
function closeModal() {
  const modal = document.getElementById("modal");
  modal.classList.remove('show'); // Menghapus animasi modal
  setTimeout(() => {
    modal.style.display = "none"; // Menyembunyikan modal setelah animasi selesai
  }, 300); // Waktu sesuai durasi animasi
}

// Fungsi untuk mengarahkan ke halaman lain jika tombol "OK" ditekan
function okPembelian() {
  window.open("#", "_blank");  // Membuka link di tab baru
  closeModal();  // Menutup modal setelah konfirmasi
}

// Menambahkan event listener untuk link berpindah halaman
document.querySelectorAll('.nav-item').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault(); // Mencegah link langsung berpindah
    showLoading();     // Tampilkan loading sebelum berpindah halaman

    // Delay untuk menunggu loading muncul
    setTimeout(() => {
      window.location.href = anchor.getAttribute('href'); // Pindah ke halaman baru setelah delay
    }, 1000); // Waktu delay 1 detik (Anda bisa sesuaikan)
  });
});

// Fungsi untuk menampilkan loading
function showLoading() {
  document.getElementById('loading').style.display = 'flex'; // Tampilkan loading
}

// Fungsi untuk menyembunyikan loading
function hideLoading() {
  document.getElementById('loading').style.display = 'none'; // Sembunyikan loading
}




