<?php
// Sertakan file koneksi
include '../admin/koneksi.php'; // Pastikan file koneksi.php berisi konfigurasi koneksi ke database

// Query untuk mengambil data dari tabel produk_pencuci
$query = "SELECT gambar_produk, nama_produk, deskripsi, harga_produk FROM produk_krim";
$result = mysqli_query($conn, $query);

// Periksa apakah query berhasil
if (!$result) {
  die("Query gagal dijalankan: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Krim Malam</title>
  <link rel="icon" type="image/png" href="../aset/logo.png">
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../stylecss/index3.css">
</head>

<body class="font-roboto">
  <!-- Header -->
  <header class="bg-blue-700 text-white">
    <div class="container mx-auto flex justify-between items-center py-2 px-4">
      <div class="flex items-center space-x-4">
        <i class="fas fa-envelope">
        </i>
        <span>
          support@SkincareKu.com
        </span>
        <i class="fas fa-phone">
        </i>
        <span>
          (+62) 4587 880
        </span>
      </div>
      <div class="flex items-center space-x-4">
        <a href="../admin/login.php" target="_blank" class="flex items-center space-x-2 group">
          <!-- Logo User -->
          <div class="relative w-6 h-6 bg-gray-500 rounded-full flex items-center justify-center">
            <!-- Kepala User -->
            <div class="absolute top-1 w-2 h-2 bg-white rounded-full"></div>
            <!-- Badan User -->
            <div class="absolute bottom-1 w-4 h-1 bg-white rounded-full"></div>
          </div>
          <span class="text-white group-hover:text-gray-300 font-awsome">Admin</span>
        </a>
      </div>
    </div>
  </header>

  <!-- Navigation -->
  <nav class="bg-white shadow">
    <div class="container mx-auto flex justify-between items-center py-4 px-4">
      <div class="text-2xl font-bold">
        SkincareKu.
      </div>
      <ul class="flex space-x-6">
        <li>
          <a class="nav-item" href="index1.php">
            <strong>Home</strong>
          </a>
        </li>
        <li>
          <a class="nav-item" href="index2.php">
            <strong>Pencuci Muka</strong>
          </a>
        </li>
        <li>
          <a class="nav-item text-blue-500" href="index3.php">
            <strong>Krim Malam</strong>
          </a>
        </li>
      </ul>
    </div>
  </nav>


  <!-- Main Banner -->
<section class="bg-gray-100 py-16">
  <div class="flex flex-col md:flex-row items-center pl-4 md:pl-8 pr-4">
    <div class="md:w-1/2 text-center md:text-left">
      <h1 class="text-4xl font-bold mb-4">
        Krim Malam
      </h1>
      <p class="text-gray-600 mb-6">
        Selamat Berbelanja
      </p>
      <p class="text-gray-600 mb-6">
        Nikmati Wajah Cerah dan Berkilai dengan Krim Malam produk kami
      </p>
    </div>
  </div>
</section>


  <!-- Features Section -->
  <section class="bg-white py-8">
    <div class="container mx-auto flex flex-wrap justify-around text-center">
      <div class="w-1/2 md:w-1/5 p-4">
        <i class="fas fa-shipping-fast text-3xl text-blue-700">
        </i>
        <h3 class="mt-2 font-semibold">
          Gratis Ongkir
        </h3>
        <p>
          Setiap Hari Minggu
        </p>
      </div>
      <div class="w-1/2 md:w-1/5 p-4">
        <i class="fas fa-lock text-3xl text-blue-700">
        </i>
        <h3 class="mt-2 font-semibold">
          Pembayaran Aman
        </h3>
        <p>
          Pemesanan langsung pada owner
        </p>
      </div>
      <div class="w-1/2 md:w-1/5 p-4">
        <i class="fas fa-undo text-3xl text-blue-700">
        </i>
        <h3 class="mt-2 font-semibold">
          100% Uang Kembali
        </h3>
        <p>
          Jika Barang Cacat
        </p>
      </div>
      <div class="w-1/2 md:w-1/5 p-4">
        <i class="fas fa-headset text-3xl text-blue-700">
        </i>
        <h3 class="mt-2 font-semibold">
          Komunitas Luas
        </h3>
        <p>
          Komunitas Terbesar Se-Indonesia
        </p>
      </div>
    </div>
  </section>
  <!-- Promotions -->
  <section class="bg-gray-100 py-16">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
      <?php
      // Iterasi data produk
      while ($row = mysqli_fetch_assoc($result)) {
        // Ambil data dari setiap baris
        $gambar_produk = $row['gambar_produk'];
        $nama_produk = $row['nama_produk'];
        $deskripsi = $row['deskripsi'];
        $harga_produk = $row['harga_produk'];
      ?>
        <div class="bg-white p-8">
          <img alt="Produk" class="mb-4 gambar-produk" src="data:image/jpeg;base64,<?php echo base64_encode($gambar_produk); ?>" />
          <h3 class="text-xl font-bold mb-2">
            <?php echo htmlspecialchars($nama_produk); ?>
          </h3>
          <p class="text-gray-600 mb-2">
            <?php echo htmlspecialchars($deskripsi); ?>
          </p>
          <p class="text-gray-600">
            Rp <?php echo number_format($harga_produk, 0, ',', '.'); ?>
          </p>
          <button class="button-style" onclick="konfirmasiPembelian()">Beli Sekarang!</button>
        </div>
      <?php
      }
      ?>
    </div>
  </section>

  <!--Footer-->
  <div class="bg-green-900 text-white">
    <footer class="bg-blue-800 text-white py-12">
      <div class="container mx-auto px-4">
        <!-- Section 1 - About and Links -->
        <div class="flex flex-col md:flex-row justify-between space-y-8 md:space-y-0">
          <div class="mb-8 md:mb-0">
            <h1 class="text-3xl font-bold text-green-400 mb-4">SkincareKu</h1>
            <ul class="space-y-2 text-lg">
              <li><a href="#" class="hover:text-green-400 transition-all">Privacy</a></li>
              <li><a href="#" class="hover:text-green-400 transition-all">Tentang Kami</a></li>
              <li><a href="#" class="hover:text-green-400 transition-all">Kontak</a></li>
              <li><a href="#" class="hover:text-green-400 transition-all">Cookies</a></li>
            </ul>
          </div>

          <!-- Section 2 - Reseller and Registration -->
          <div class="mb-8 md:mb-0">
            <ul class="space-y-2 text-lg">
              <li><a href="#" class="hover:text-green-400 transition-all">Ingin Menjadi Reseller?</a></li>
              <li><a href="#" class="hover:text-green-400 transition-all">Daftarkan</a></li>
              <li><a href="#" class="hover:text-green-400 transition-all">Dirimu</a></li>
              <li><a href="#" class="hover:text-green-400 transition-all">Sekarang Juga!</a></li>
            </ul>
          </div>

          <!-- Section 3 - Subscribe -->
          <div class="mb-8 md:mb-0">
            <h2 class="text-xl font-bold mb-4">Ikuti Kami</h2>
            <form class="flex flex-col space-y-2">
              <input type="email" placeholder="Masukkan Email Kamu" class="p-3 text-black rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500">
              <button type="submit" class="bg-green-400 text-white p-3 rounded-lg shadow hover:bg-green-500 transition-all">Submit</button>
              <label class="flex items-center text-sm">
                <input type="checkbox" class="mr-2 text-green-400">
                Jangan Lupa Di Centang
              </label>
            </form>
          </div>
        </div>

        <!-- Social Icons -->
        <div class="flex justify-center space-x-6 my-8">
          <a href="https://www.instagram.com/msglowbeauty/" class="text-white hover:text-green-400 transition-all text-2xl">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="https://www.instagram.com/msglowbeauty/" class="text-white hover:text-green-400 transition-all text-2xl">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="https://www.instagram.com/msglowbeauty/" class="text-white hover:text-green-400 transition-all text-2xl">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="https://www.instagram.com/msglowbeauty/" class="text-white hover:text-green-400 transition-all text-2xl">
            <i class="fab fa-pinterest"></i>
          </a>
        </div>
      </div>

      <!-- Footer Bottom -->
      <div class="text-center text-sm py-4 bg-blue-900">
        <p>&copy; 2024 SkincareKu.ID | All Rights Reserved</p>
      </div>
    </footer>
  </div>

  <!-- Modal Pop-up Pembelian -->
  <div id="modal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        Konfirmasi Pembelian
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin ingin memesan produk ini?</p>
      </div>
      <div class="modal-footer">
        <button onclick="okPembelian()">OK</button>
        <button class="cancel-btn" onclick="closeModal()">Batal</button>
      </div>
    </div>
  </div>

  <script src="../javascript/index3.js"></script>
</body>

</html>