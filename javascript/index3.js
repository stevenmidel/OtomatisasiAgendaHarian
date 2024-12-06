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
