<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>     
        <form action="./proses/prosesRegister.php" method="post">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" required>
            </div> 
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div> 
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="text" id="password" name="password" required>
            </div>
            <button type="submit">Register</button>
            <button type="button" onclick="history.back()" class="cancel-btn">Batal</button>
        </form>
    </div>
</body>
</html>