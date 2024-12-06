<?php
session_start();

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'User';

// Jika session belum ada, arahkan ke halaman login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>