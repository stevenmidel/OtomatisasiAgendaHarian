--Cara menjalankan database :
--Buka Xampp
--Buat database baru dengan nama : toko_skincare
--Buka database toko_skincare yang telah dibuat
--Klik pada bagian SQL
--Copy code database dibawah ini dan jalankan


--Buat Tabel Users
CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
);
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);


--Buat Tabel produk_pencuci
CREATE TABLE produk_pencuci (
  id int NOT NULL,
  nama_produk varchar(255) NOT NULL,
  deskripsi text,
  harga_produk decimal(10,2) NOT NULL,
  gambar_produk longblob
);

--Buat Tabel produk_krim
CREATE TABLE produk_krim (
  id int NOT NULL,
  nama_produk varchar(255) NOT NULL,
  deskripsi text,
  harga_produk decimal(10,2) NOT NULL,
  gambar_produk longblob
);