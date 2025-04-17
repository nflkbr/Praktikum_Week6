<?php
session_start();

include './DB/connection.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $result = $conn->query("SELECT * FROM mahasiswa WHERE id = $id");
    $row = $result->fetch_assoc();

    if (!$row) {
        echo "Data tidak ditemukan.";
        exit();
    }
} else {
    echo "ID tidak ditemukan.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nrp = $_POST["nrp"];
    $nama = $_POST["nama"];
    $jurusan = $_POST["jurusan"];

    if (isset($_FILES['foto'])) {
        $foto = $_FILES['foto'];
        $uploadDir = "./FotoMahasiswa/";
        $fileName = basename($foto["name"]);
        $filePath = $uploadDir . $fileName;

        if (move_uploaded_file($foto["tmp_name"], $filePath)) {
            $sql = "UPDATE mahasiswa SET nrp='$nrp', nama='$nama', jurusan='$jurusan', foto='$fileName' WHERE id='$id'";
            if ($conn->query($sql) === TRUE) {
                header("Location: ./index.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $sql = "UPDATE mahasiswa SET nrp='$nrp', nama='$nama', jurusan='$jurusan' WHERE id='$id'";
            if ($conn->query($sql) === TRUE) {
                header("Location: ./index.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        $sql = "UPDATE mahasiswa SET nrp='$nrp', nama='$nama', jurusan='$jurusan' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            header("Location: ./index.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="style.css">
    
</head>

<body>
    <div class="container">
        <h2>Edit Data</h2>
        <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <div class="form-group">
                <label for="nrp">NRP:</label>
                <input type="text" name="nrp" class="form-control" value="<?php echo($row['nrp']); ?>" required>
            </div> 
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" class="form-control" value="<?php echo($row['nama']); ?>" required>
            </div> 
            <div class="form-group">
                <label for="jurusan">Jurusan:</label>
                <input type="text" name="jurusan" class="form-control" value="<?php echo($row['jurusan']); ?>" required>
            </div>
            <div class="form-group">
                <label for="foto">Foto:</label>
                <input type="file" name="foto" class="form-control" value="<?php echo($row['foto']); ?>" required>
            </div>
            <button type="submit">Simpan</button>
            <button type="button" onclick="history.back()" class="cancel-btn">Batal</button>
        </form>
    </div>
</body>

</html>