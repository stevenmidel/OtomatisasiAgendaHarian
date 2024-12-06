<?php
include 'koneksi.php'; // Pastikan koneksi ke database sudah benar

// Mengecek jika ada id yang dikirimkan via URL untuk proses hapus
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data produk berdasarkan id dari tabel produk_krim
    $sql = "DELETE FROM produk_krim WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Jika sukses, tampilkan alert dan alihkan ke halaman data produk
        echo "<script>alert('Data produk berhasil dihapus!'); window.location.href='data_krim.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "ID produk tidak ditemukan!";
}
?>
