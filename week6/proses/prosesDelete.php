<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

include '../db/connection.php';

if(isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM mahasiswa WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>