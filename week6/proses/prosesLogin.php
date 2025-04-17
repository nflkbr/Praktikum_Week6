<?php
session_start();

include '../DB/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (empty($username) || empty($password)) {
        header("Location: ../login.php?error=" . urlencode("Username dan password harus diisi"));
        exit;
    }

    $query = "SELECT username, password FROM akun WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        header("Location: ../index.php");
        exit;
    } else {
        header("Location: ../login.php?error=" . urlencode("Username atau password salah"));
        exit;
    }
} else {
    header("Location: ../login.php");
    exit;
}
?>