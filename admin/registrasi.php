<?php
// Menghubungkan file koneksi.php untuk menyambung ke database
include 'koneksi.php';

// Mengecek apakah metode request adalah POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Menangkap input dari form dan membersihkan data agar aman
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);

    // Memastikan semua field telah diisi
    if (empty($username) || empty($password) || empty($confirm_password)) {
        echo "<script>alert('Semua field harus diisi!');</script>";
    }
    // Memeriksa apakah password dan confirm password cocok
    elseif ($password !== $confirm_password) {
        echo "<script>alert('Password dan Confirm Password tidak cocok!');</script>";
    } else {
        // Memeriksa apakah username sudah ada di database
        $checkStmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $checkStmt->bind_param("s", $username);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            // Jika username sudah terdaftar
            echo "<script>alert('Username sudah terdaftar. Silakan coba dengan username lain.');</script>";
        } else {
            // Meng-hash password sebelum menyimpannya di database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Menyimpan data user baru ke dalam database
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed_password);

            // Mengeksekusi query dan memberikan feedback
            if ($stmt->execute()) {
                echo "<script>alert('Registrasi berhasil! Silahkan Login.'); window.location.href='login.php';</script>";
            } else {
                echo "<script>alert('Error: Registrasi Gagal!');</script>";
            }
            $stmt->close();
        }
        $checkStmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Register</title>
    <link rel="icon" type="image/png" href="../aset/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <script>
        // Fungsi untuk toggle visibilitas password
        function togglePassword(id, iconId) {
            var passwordInput = document.getElementById(id);
            var eyeIcon = document.getElementById(iconId);

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }

        // Fungsi untuk validasi form, memastikan password dan confirm password cocok
        function validateForm(event) {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm-password").value;

            if (password !== confirmPassword) {
                event.preventDefault(); // Mencegah form untuk disubmit jika password tidak cocok
                alert("Password dan Confirm Password tidak cocok.");
            }
        }
    </script>
</head>

<body class="bg-blue-500 flex items-center justify-center min-h-screen">
    <div class="bg-white rounded-lg shadow-lg flex flex-col md:flex-row w-full max-w-5xl">
        <!-- Bagian kiri: Logo atau gambar -->
        <div class="md:w-1/2 w-full p-12 flex flex-col justify-center items-center">
            <img src="../aset/logo.png" alt="Logo atau ilustrasi" class="mb-6" width="300" height="300" />
        </div>

        <!-- Bagian kanan: Form Registrasi -->
        <div class="md:w-1/2 w-full p-12">
            <h2 class="text-4xl font-semibold mb-4 text-gray-800">Registrasi</h2>
            <p class="text-gray-600 mb-8 text-lg">Isi data Anda dengan benar untuk membuat akun!</p>

            <!-- Form Registrasi -->
            <form onsubmit="validateForm(event)" method="POST">
                <div class="mb-6">
                    <label for="username" class="block text-xl text-gray-700 mb-2">Username</label>
                    <input type="text" id="username" name="username" placeholder="Masukkan username" class="w-full px-6 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-lg" required />
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-xl text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" placeholder="Masukkan password" class="w-full px-6 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-lg" required />
                        <i class="fas fa-eye absolute right-4 top-4 text-gray-500 cursor-pointer" id="password-eye-icon" onclick="togglePassword('password', 'password-eye-icon')"></i>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="confirm-password" class="block text-xl text-gray-700 mb-2">Confirm Password</label>
                    <div class="relative">
                        <input type="password" id="confirm-password" name="confirm_password" placeholder="Konfirmasi password" class="w-full px-6 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-lg" required />
                        <i class="fas fa-eye absolute right-4 top-4 text-gray-500 cursor-pointer" id="confirm-password-eye-icon" onclick="togglePassword('confirm-password', 'confirm-password-eye-icon')"></i>
                    </div>
                </div>

                <div class="mb-6 text-right">
                    <a href="login.php" class="text-blue-500 text-lg">Sudah punya akun? Login di sini</a>
                </div>

                <!-- Tombol untuk mengirimkan form -->
                <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 text-xl">
                    Registrasi
                </button>
            </form>
        </div>
    </div>
</body>

</html>