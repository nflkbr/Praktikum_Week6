<?php
include "../DB/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $conn->real_escape_string($_POST["nama"]);
    $username = $conn->real_escape_string($_POST["username"]);
    $password = $conn->real_escape_string($_POST["password"]);

    $sql = "INSERT INTO akun (nama, username, password) VALUES ('$nama', '$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>