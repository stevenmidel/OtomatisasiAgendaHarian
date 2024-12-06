<?php
// Mulai session
session_start();

// Menghancurkan semua session yang ada
session_unset(); // Menghapus semua session variables
session_destroy(); // Menghancurkan session

// Mengalihkan pengguna ke halaman login atau halaman utama setelah logout
header("Location: login.php"); // Ganti dengan halaman tujuan Anda setelah logout
exit();
?>
