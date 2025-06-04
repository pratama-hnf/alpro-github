<?php
session_start();
if(isset($_POST['username'], $_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Koneksi ke database
    $conn = new mysqli('localhost', 'root', '', 'p5alpro'); // Assumed dbname p5alprog from page 28 image

    // Periksa koneksi
    if($conn->connect_error){
        echo "koneksi gagal";
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Query untuk mencari user dengan username dan password yang sesuai
    $query = "SELECT * FROM login WHERE username='$username' AND password='$password'"; // Assuming table name is 'login'
    $result = $conn->query($query);

    // Periksa apakah hasil query menghasilkan baris (user yang valid)
    if($result->num_rows > 0){
        // Login berhasil
        $_SESSION['username'] = $username;
        header("Location: dashboard.html"); // Redirect ke halaman dashboard atau halaman lainnya
        exit;
    } else {
        // Login gagal
        echo "Login gagal. Periksa kembali username dan password anda.";
    }
    $conn->close();
}
?>