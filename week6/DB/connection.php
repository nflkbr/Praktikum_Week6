<?php
$conn = mysqli_connect("localhost", "root", "", "tugas_akhir4");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}