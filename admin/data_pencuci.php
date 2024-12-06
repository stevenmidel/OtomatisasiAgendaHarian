<?php
require 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Pencuci</title>
  <link rel="icon" type="image/png" href="../aset/logo.png">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    table {
      table-layout: fixed;
      width: 100%;
    }

    td,
    th {
      white-space: pre-wrap;
      /* Mengatur teks agar turun ke bawah */
      word-break: break-word;
      /* Memotong kata panjang */
      text-align: left;
      /* Merapikan teks ke kiri */
    }
  </style>
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
    <main class="flex-1 p-6">
      <h1 class="text-2xl font-bold text-gray-700">Data Keseluruhan Produk Pencuci-Muka</h1>
      <p class="mt-4 text-gray-600">Anda Bisa Mengedit dan Menghapus Data Disini</p>

      <!-- Tabel dengan Styling Responsif -->
      <div class="overflow-x-auto mt-6">
        <table class="table-fixed min-w-full border-collapse bg-white shadow-md rounded-lg">
          <thead class="bg-gray-200 text-gray-600">
            <tr>
              <th class="px-2 py-3 border-b text-center w-12">ID</th> <!-- Lebar kecil untuk ID -->
              <th class="px-6 py-3 border-b text-center">Nama Produk</th>
              <th class="px-6 py-3 border-b text-center">Deskripsi</th>
              <th class="px-6 py-3 border-b text-center">Harga Produk</th>
              <th class="px-6 py-3 border-b text-center">Gambar Produk</th>
              <th class="px-3 py-3 border-b text-center w-24">Edit</th> <!-- Lebar lebih besar -->
              <th class="px-3 py-3 border-b text-center w-24">Hapus</th> <!-- Lebar lebih besar -->
            </tr>
          </thead>


          <tbody class="text-gray-700">
            <?php
            include 'koneksi.php'; // Pastikan file koneksi sudah benar

            // Query untuk mengambil data dari tabel produk_krim
            $sql = "SELECT id, nama_produk, deskripsi, harga_produk, gambar_produk FROM produk_pencuci";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              // Loop untuk menampilkan setiap baris data
              while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td class='px-6 py-3 border-b text-center'>{$row['id']}</td>";
                echo "<td class='px-6 py-3 border-b text-center'>{$row['nama_produk']}</td>";
                echo "<td class='px-6 py-3 border-b text-center'>{$row['deskripsi']}</td>";
                echo "<td class='px-6 py-3 border-b text-center'>Rp " . number_format($row['harga_produk'], 0, ',', '.') . "</td>";

                // Menampilkan gambar (base64 encoding)
                echo "<td class='px-6 py-3 border-b text-center'><img src='data:image/jpeg;base64," . base64_encode($row['gambar_produk']) . "' alt='Gambar Produk' class='w-20 h-20 object-cover mx-auto'></td>";


                // Tombol Edit dan Hapus dengan ikon
                echo "<td class='px-6 py-3 border-b text-center'><a href='edit_pencuci.php?id={$row['id']}' class='text-blue-500 hover:text-blue-700'><i class='fas fa-edit'></i></a></td>";
                echo "<td class='px-6 py-3 border-b text-center'><a href='hapus_pencuci.php?id={$row['id']}' class='text-red-500 hover:text-red-700' onclick=\"return confirm('Yakin ingin menghapus produk ini?');\"><i class='fas fa-trash-alt'></i></a></td>";
                echo "</tr>";
              }
            } else {
              echo "<tr><td colspan='7' class='px-6 py-3 border-b text-center'>Tidak ada data tersedia.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>

</body>

</html>