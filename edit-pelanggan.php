<?php
include 'koneksi.php';

$id = $_GET['id'];

$query = "SELECT users.*, customer_profiles.phone_number, customer_addresses.full_address 
          FROM users 
          LEFT JOIN customer_profiles ON users.id = customer_profiles.user_id
          LEFT JOIN customer_addresses ON users.id = customer_addresses.user_id
          WHERE users.id = '$id'";
$result = mysqli_query($conn, $query);
$data   = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $name         = $_POST['name'];
    $email        = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $full_address = $_POST['full_address'];

    mysqli_query($conn, "UPDATE users SET name='$name', email='$email' WHERE id='$id'");
    mysqli_query($conn, "UPDATE customer_profiles SET phone_number='$phone_number' WHERE user_id='$id'");
    mysqli_query($conn, "UPDATE customer_addresses SET phone_number='$phone_number', full_address='$full_address' WHERE user_id='$id'");

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pelanggan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Data Pelanggan</h2>
        <form method="POST" action="">
            <label>Nama Lengkap:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($data['name']); ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($data['email']); ?>" required>

            <label>No. HP / Telepon:</label>
            <input type="text" name="phone_number" value="<?= htmlspecialchars($data['phone_number']); ?>" required>

            <label>Alamat Lengkap Pengiriman:</label>
            <textarea name="full_address" rows="4" required><?= htmlspecialchars($data['full_address']); ?></textarea>

            <button type="submit" name="update">Simpan Perubahan</button>
            <a href="index.php" class="btn-batal">Batal</a>
        </form>
    </div>
</body>
</html>