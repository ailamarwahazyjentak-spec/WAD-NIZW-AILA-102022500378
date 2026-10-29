<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $name         = $_POST['name'];
    $email        = $_POST['email'];
    $password     = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone_number = $_POST['phone_number'];
    $full_address = $_POST['full_address'];

    $query_user = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    if (mysqli_query($conn, $query_user)) {
        $user_id = mysqli_insert_id($conn);

        $query_profile = "INSERT INTO customer_profiles (user_id, phone_number) VALUES ('$user_id', '$phone_number')";
        mysqli_query($conn, $query_profile);

        $query_address = "INSERT INTO customer_addresses (user_id, recipient_name, phone_number, full_address) 
                         VALUES ('$user_id', '$name', '$phone_number', '$full_address')";
        mysqli_query($conn, $query_address);

        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pelanggan Baru</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Tambah Data Pelanggan</h2>
        <form method="POST" action="">
            <label>Nama Lengkap:</label>
            <input type="text" name="name" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <label>No. HP / Telepon:</label>
            <input type="text" name="phone_number" required>

            <label>Alamat Lengkap Pengiriman:</label>
            <textarea name="full_address" rows="4" required></textarea>

            <button type="submit" name="simpan">Simpan Pelanggan</button>
            <a href="index.php" class="btn-batal">Batal</a>
        </form>
    </div>
</body>
</html>