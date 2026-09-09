<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "Web-PHP";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi Database Gagal: " . mysqli_connect_error());
}

// Proses Simpan Form Contact
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kirim_pesan'])) {
    $nama  = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pesan = mysqli_real_escape_string($conn, $_POST['pesan']);

    $sql_insert = "INSERT INTO pesan_kontak (nama, email, pesan) VALUES ('$nama', '$email', '$pesan')";
    
    if (mysqli_query($conn, $sql_insert)) {
        header("Location: index.php?status=sukses#contact");
        exit();
    } else {
        header("Location: index.php?status=gagal#contact");
        exit();
    }
}
?>