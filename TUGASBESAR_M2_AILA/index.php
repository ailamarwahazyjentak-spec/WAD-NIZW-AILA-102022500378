<?php
include 'koneksi.php';

$query = "SELECT users.id, users.name, users.email, customer_profiles.phone_number, customer_addresses.full_address 
          FROM users 
          LEFT JOIN customer_profiles ON users.id = customer_profiles.user_id
          LEFT JOIN customer_addresses ON users.id = customer_addresses.user_id";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Modul Pelanggan & Alamat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Daftar Pelanggan & Alamat Pengiriman</h2>
        <a href="tambah-pelanggan.php" class="btn-tambah">+ Tambah Pelanggan Baru</a>

        <table>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No. HP</th>
                <th>Alamat Pengiriman</th>
                <th>Aksi</th>
            </tr>
            <?php 
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) : 
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['name']); ?></td>
                <td><?= htmlspecialchars($row['email']); ?></td>
                <td><?= htmlspecialchars($row['phone_number'] ?? '-'); ?></td>
                <td><?= htmlspecialchars($row['full_address'] ?? '-'); ?></td>
                <td>
                    <a href="edit-pelanggan.php?id=<?= $row['id']; ?>" class="action-edit">Edit</a> | 
                    <a href="hapus-pelanggan.php?id=<?= $row['id']; ?>" class="action-delete" onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>