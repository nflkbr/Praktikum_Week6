<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

include "../DB/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nrp = $conn->real_escape_string($_POST["nrp"]);
    $nama = $conn->real_escape_string($_POST["nama"]);
    $jurusan = $conn->real_escape_string($_POST["jurusan"]);

    if (isset($_FILES['foto'])) {
        $foto = $_FILES['foto'];
        $uploadDir = "../FotoMahasiswa/";
        $fileName = basename($foto["name"]);
        $filePath = $uploadDir . $fileName;

        if (move_uploaded_file($foto["tmp_name"], $filePath)) {
            $sql = "INSERT INTO mahasiswa (nrp, nama, jurusan, foto) VALUES ('$nrp', '$nama', '$jurusan', '$fileName')";
            if ($conn->query($sql) === TRUE) {
                header("Location: ../index.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $sql = "INSERT INTO mahasiswa (nrp, nama, jurusan) VALUES ('$nrp', '$nama', '$jurusan')";
            if ($conn->query($sql) === TRUE) {
                header("Location: ../index.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        echo "Error: No file uploaded";
    }
}
$conn->close();
