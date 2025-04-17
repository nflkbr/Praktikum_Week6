<?php
session_start();

include './DB/connection.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$result = $conn->query("SELECT * FROM mahasiswa");

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <link rel="stylesheet" href="style.css">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous" />
</head>

<body>
    <div class="main-container">
        <div class="mahasiswa">
            <h3>Data Mahasiswa</h3>
            <div class="tombol">
                <a type="button" class="add-btn" data-bs-toggle="modal" data-bs-target="#addData">Tambah Data</a>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
            <table class="table table-bordered table-striped mt-3 text-center">
                <thead>
                    <tr>
                        <th>NRP</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th colspan="2">Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nrp']); ?></td>
                            <td><?= htmlspecialchars($row['nama']); ?></td>
                            <td><?= htmlspecialchars($row['jurusan']); ?></td>
                            <td colspan="2">
                                <?php if ($row['foto'] != ''): ?>
                                    <img src="./FotoMahasiswa/<?= $row['foto']; ?>" alt="No Foto" width="250" height="250">
                                <?php else: ?>
                                    No Photo
                                <?php endif; ?>
                            </td>
                            <td>
                                <a type="button" class="btn btn-warning btn-sm" href="./edit.php?id=<?= $row['id']; ?>">Edit</a>
                                <a href="./proses/prosesDelete.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="addData" tabindex="-1" aria-labelledby="addDataModal" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Data</h1>
                    <button type="button" class="btn-close cancel-btn" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="./proses/prosesCreate.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nrp">NRP</label>
                            <input type="text" name="nrp" class="form-control" placeholder="NRP Anda" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama Anda" required>
                        </div>
                        <div class="mb-3">
                            <label for="jurusan">Jurusan</label>
                            <input type="text" name="jurusan" class="form-control" placeholder="Jurusan Anda">
                        </div>
                        <div class="mb-3">
                            <label for="foto">Foto</label>
                            <input type="file" name="foto" class="form-control" placeholder="Foto Anda">
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>