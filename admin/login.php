<!--PHP Script-->
<?php
// Menyertakan koneksi database
include 'koneksi.php';

// Memulai session untuk menyimpan informasi login pengguna
session_start();

// Memeriksa apakah form login telah disubmit menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil dan membersihkan data input dari form login
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars($_POST['password']);

    // Memeriksa apakah username atau password kosong
    if (empty($username) || empty($password)) {
        echo "<script>alert('Tolong Lengkapi Username dan Password!');</script>";
    } else {
        // Menyiapkan query untuk mencari pengguna berdasarkan username
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Memeriksa apakah ada hasil yang ditemukan (username ada)
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc(); // Mengambil data pengguna

            // Memverifikasi password yang dimasukkan dengan password yang terenkripsi di database
            if (password_verify($password, $user['password'])) {
                // Jika login berhasil, simpan ID dan username pengguna dalam session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                // Redirect ke halaman home setelah login berhasil
                echo "<script>alert('Login Berhasil!'); window.location.href='home.php';</script>";
            } else {
                // Jika password salah
                echo "<script>alert('Password Salah!');</script>";
            }
        } else {
            // Jika username tidak ditemukan
            echo "<script>alert('Username Belum Terdaftar!');</script>";
        }
        // Menutup statement setelah query selesai
        $stmt->close();
    }
}
?>
<!--HTML Script-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Sign In</title>
    <link rel="icon" type="image/png" href="../aset/logo.png">
    <!-- Menyertakan Tailwind CSS untuk styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Menyertakan FontAwesome untuk ikon eye password -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <script>
        // Fungsi untuk toggle visibility password
        function togglePassword() {
            var passwordInput = document.getElementById('password');
            var eyeIcon = document.getElementById('eye-icon');
            // Jika password sedang disembunyikan, ubah menjadi teks dan ubah ikon
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                // Jika password sedang terlihat, sembunyikan kembali dan ubah ikon
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
    </script>
</head>

<body class="bg-blue-500 flex items-center justify-center min-h-screen">
    <div class="bg-white rounded-lg shadow-lg flex w-full max-w-5xl">
        <!-- Bagian kiri (gambar/logo) -->
        <div class="w-1/2 p-12 flex flex-col justify-center items-center">
            <img alt="Illustration" class="mb-6" src="../aset/logo.png" height="400" width="400" />
        </div>

        <!-- Bagian kanan (form login) -->
        <div class="w-1/2 p-12">
            <h2 class="text-4xl font-semibold mb-4 text-gray-800">Sign In</h2>
            <p class="text-gray-600 mb-8 text-lg">
                Selamat datang! Silahkan isi username dan password
            </p>

            <!-- Form login -->
            <form method="POST" action="">
                <!-- Input username -->
                <div class="mb-6">
                    <label for="username" class="block text-xl text-gray-700 mb-2">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter username" class="w-full px-6 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-lg" required />
                </div>

                <!-- Input password -->
                <div class="mb-6">
                    <label for="password" class="block text-xl text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" placeholder="Enter password" class="w-full px-6 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-lg" required />
                        <!-- Ikon untuk toggle visibility password -->
                        <i class="fas fa-eye absolute right-4 top-4 text-gray-500 cursor-pointer" id="eye-icon" onclick="togglePassword()"></i>
                    </div>
                </div>

                <!-- Link untuk registrasi bagi pengguna yang belum punya akun -->
                <div class="mb-6 text-right">
                    <a href="registrasi.php" class="text-blue-500 text-lg">Belum Punya Akun? Daftar di sini</a>
                </div>

                <!-- Tombol untuk submit form login -->
                <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 text-xl">Sign In</button>
            </form>
        </div>
    </div>
</body>

</html>