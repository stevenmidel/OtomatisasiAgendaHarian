<?php
require 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="icon" type="image/png" href="../aset/logo.png">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../stylecss/home.css">
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
      <h1 class="text-2xl font-bold text-gray-700">Dashboard</h1>
      <p class="mt-4 text-gray-600">Ini adalah halaman Dashboard</p>

      <div class="images-grid">
        <img src="../aset/home1.jpg" alt="Landscape Image 1">
        <img src="../aset/home2.jpg" alt="Landscape Image 2">
        <img src="../aset/home3.jpg" alt="Landscape Image 3">
        <img src="../aset/home4.jpg" alt="Landscape Image 4">
      </div>
    </main>
  </div>

</body>

</html>