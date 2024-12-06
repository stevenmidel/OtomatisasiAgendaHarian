<?php
include 'koneksi.php';
require 'auth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nama_produk = htmlspecialchars(trim($_POST['nama_produk']));
  $deskripsi = htmlspecialchars(trim($_POST['deskripsi']));
  $harga_produk = htmlspecialchars(trim($_POST['harga_produk']));

  if (empty($nama_produk) || empty($harga_produk)) {
    die("Nama produk dan harga wajib diisi.");
  }

  if (!is_numeric($harga_produk)) {
    die("Harga produk harus berupa angka.");
  }

  if (!isset($_FILES['gambar_produk']) || $_FILES['gambar_produk']['error'] != 0) {
    die("Gambar produk wajib diunggah.");
  }

  $file_tmp = $_FILES['gambar_produk']['tmp_name'];
  $file_size = $_FILES['gambar_produk']['size'];
  $file_type = $_FILES['gambar_produk']['type'];

  if ($file_size > 2 * 1024 * 1024) {
    die("Ukuran file maksimal 2 MB.");
  }

  $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
  if (!in_array($file_type, $allowed_types)) {
    die("Tipe file harus berupa JPEG, PNG, atau GIF.");
  }

  $gambar_produk = file_get_contents($file_tmp);

  $stmt = $conn->prepare("INSERT INTO produk_pencuci (nama_produk, deskripsi, harga_produk, gambar_produk) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssds", $nama_produk, $deskripsi, $harga_produk, $gambar_produk);

  if ($stmt->execute()) {
    echo "<script>alert('Produk berhasil ditambahkan!'); window.location.href='tambah_pencuci.php';</script>";
  } else {
    die("Kesalahan: " . $stmt->error);
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Pencuci</title>
  <link rel="icon" type="image/png" href="../aset/logo.png">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="h-screen flex bg-gray-100">

  <!-- Sidebar -->
  <aside class="w-72 bg-blue-600 text-white flex flex-col transition-all duration-300 ease-in-out">
    <!-- Sidebar Header -->
    <div class="text-2xl font-semibold p-4 border-b border-blue-800 text-center">
      Menu
    </div>

    <!-- Sidebar Navigation -->
    <nav class="flex-1 overflow-y-auto">
      <ul class="space-y-2">
        <li class="hover:bg-blue-700 cursor-pointer px-4 py-3 border-b border-blue-700 transition duration-300 ease-in-out">
          <a href="tambah_krim.php" class="block w-full text-lg font-semibold">Tambah Barang Krim-Malam</a>
        </li>
        <li class="hover:bg-blue-700 cursor-pointer px-4 py-3 border-b border-blue-700 transition duration-300 ease-in-out">
          <a href="tambah_pencuci.php" class="block w-full text-lg font-semibold">Tambah Barang Pencuci-Muka</a>
        </li>
        <li class="hover:bg-blue-700 cursor-pointer px-4 py-3 border-b border-blue-700 transition duration-300 ease-in-out">
          <a href="data_krim.php" class="block w-full text-lg font-semibold">Data Krim-Malam</a>
        </li>
        <li class="hover:bg-blue-700 cursor-pointer px-4 py-3 border-b border-blue-700 transition duration-300 ease-in-out">
          <a href="data_pencuci.php" class="block w-full text-lg font-semibold">Data Pencuci-Muka</a>
        </li>
        <li class="hover:bg-blue-700 cursor-pointer px-4 py-3 border-b border-blue-700 transition duration-300 ease-in-out">
          <a href="logout.php" class="block w-full text-lg font-semibold">Logout</a>
        </li>
      </ul>
    </nav>

    <!-- Logo Section -->
    <div class="p-4 flex justify-center items-center">
      <img src="../aset/logo.png" alt="Logo" class="w-30 h-30 object-contain">
    </div>
  </aside>

  <!-- Optional Custom Styling for fonts -->
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>


  <!-- Main Content -->
  <div class="flex-1 flex flex-col">
    <!-- Navbar -->
    <header class="h-16 bg-white shadow flex justify-between items-center px-6">
      <div class="text-lg font-bold flex items-center">
        <i class="fas fa-home mr-2"></i>
        <a href="home.php">Home</a>
      </div>
      <div class="text-gray-700 font-semibold">Welcome <?php echo htmlspecialchars($username); ?></div>
    </header>

    <!-- Page Content -->
    <main class="flex flex-col items-center p-6">
      <h1 class="text-2xl font-bold text-gray-700 mb-6">Tambah Produk</h1>
      <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg">
        <form action="tambah_pencuci.php" method="POST" enctype="multipart/form-data">
          <!-- Nama Produk -->
          <div class="mb-4">
            <label for="nama_produk" class="block text-gray-700 font-semibold mb-2">Nama Produk</label>
            <input
              type="text"
              name="nama_produk"
              id="nama_produk"
              class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
              placeholder="Nama produk"
              required />
          </div>

          <!-- Deskripsi -->
          <div class="mb-4">
            <label for="deskripsi" class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
            <textarea
              name="deskripsi"
              id="deskripsi"
              rows="4"
              class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
              placeholder="Deskripsi produk"
              required></textarea>
          </div>

          <!-- Harga Produk -->
          <div class="mb-4">
            <label for="harga_produk" class="block text-gray-700 font-semibold mb-2">Harga Produk</label>
            <input
              type="number"
              name="harga_produk"
              id="harga_produk"
              class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
              placeholder="Harga produk"
              required />
          </div>

          <!-- Gambar Produk -->
          <div class="mb-4">
            <label for="gambar_produk" class="block text-gray-700 font-semibold mb-2">Gambar Produk</label>
            <input
              type="file"
              name="gambar_produk"
              id="gambar_produk"
              accept="image/*"
              class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
              required />
          </div>

          <!-- Tombol Submit -->
          <button
            type="submit"
            class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 font-semibold">
            Tambah Produk
          </button>
        </form>
      </div>
    </main>

</body>

</html>