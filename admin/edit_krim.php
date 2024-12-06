<?php
require 'auth.php';
include 'koneksi.php'; // Pastikan koneksi ke database sudah benar

// Mengecek jika ada id yang dikirimkan via URL untuk proses edit
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Query untuk mengambil data produk berdasarkan id dari tabel produk_krim
  $sql = "SELECT id, nama_produk, deskripsi, harga_produk, gambar_produk FROM produk_krim WHERE id = $id";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
  } else {
    echo "Data tidak ditemukan!";
    exit;
  }
}

// Proses update jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
  $nama_produk = $_POST['nama_produk'];
  $deskripsi = $_POST['deskripsi'];
  $harga_produk = $_POST['harga_produk'];

  // Mengelola gambar produk
  if ($_FILES['gambar_produk']['name'] != "") {
    // Jika ada gambar baru, upload gambar dan ambil data gambar
    $gambar = addslashes(file_get_contents($_FILES['gambar_produk']['tmp_name']));
  } else {
    // Jika tidak ada gambar baru, tetap gunakan gambar lama
    $gambar = $_POST['gambar_lama'];
  }

  // Query untuk mengupdate data produk pada tabel produk_krim
  $sql = "UPDATE produk_krim SET 
                nama_produk = '$nama_produk', 
                deskripsi = '$deskripsi', 
                harga_produk = '$harga_produk', 
                gambar_produk = '$gambar' 
            WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
    // Jika sukses, tampilkan alert dan alihkan ke halaman data produk
    echo "<script>alert('Data produk berhasil diperbarui!'); window.location.href='data_krim.php';</script>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Produk Krim Malam</title>
  <link rel="icon" type="image/png" href="../aset/logo.png">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body class="h-screen bg-gray-100">

  <div class="flex justify-center items-center h-full">
    <div class="w-full max-w-lg p-6 bg-white shadow-md rounded-lg">
      <h2 class="text-2xl font-bold text-center mb-6">Edit Produk Pencuci Muka</h2>

      <!-- Form Edit -->
      <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="hidden" name="gambar_lama" value="<?php echo base64_encode($row['gambar_produk']); ?>">

        <div class="mb-4">
          <label for="nama_produk" class="block text-gray-700">Nama Produk</label>
          <input type="text" id="nama_produk" name="nama_produk" value="<?php echo $row['nama_produk']; ?>" class="w-full px-4 py-2 border rounded-md" required>
        </div>

        <div class="mb-4">
          <label for="deskripsi" class="block text-gray-700">Deskripsi</label>
          <textarea id="deskripsi" name="deskripsi" class="w-full px-4 py-2 border rounded-md" required><?php echo $row['deskripsi']; ?></textarea>
        </div>

        <div class="mb-4">
          <label for="harga_produk" class="block text-gray-700">Harga Produk</label>
          <input type="number" id="harga_produk" name="harga_produk" value="<?php echo $row['harga_produk']; ?>" class="w-full px-4 py-2 border rounded-md" required>
        </div>

        <div class="mb-4">
          <label for="gambar_produk" class="block text-gray-700">Gambar Produk</label>
          <input type="file" id="gambar_produk" name="gambar_produk" class="w-full px-4 py-2 border rounded-md">
          <p class="text-gray-600 text-sm mt-2">Biarkan kosong jika tidak ingin mengganti gambar.</p>
        </div>

        <div class="flex justify-center">
          <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>

</body>

</html>