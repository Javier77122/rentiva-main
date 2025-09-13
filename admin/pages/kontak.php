<?php
include 'koneksi.php'; // Pastikan ini ke file koneksi database

if(isset($_POST['kirim'])){
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'] ?? '';
    $pesan = $_POST['pesan'];

    // Simpan ke tabel kontak
    $stmt = $conn->prepare("INSERT INTO kontak (nama, email, pesan) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama, $email, $pesan);
    $stmt->execute();
    $stmt->close();

    // Redirect kembali ke halaman kontak dengan pesan sukses
    header("Location: ../../pages/kontak.php?status=success");
    exit();
}
?>
<?php
include 'koneksi.php';

// Hapus data jika ada aksi hapus
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM kontak WHERE id=$id");
    header("Location: dashboard.php?page=kontak");
    exit();
}

// Ambil semua data
$result = $conn->query("SELECT * FROM kontak");
?>

<h2>Pesan Kontak</h2>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Email</th>
    <th>Pesan</th>
    <th>Aksi</th>
</tr>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['nama']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['pesan']; ?></td>
    <td>
        <a href="dashboard.php?page=kontak&delete=<?php echo $row['id']; ?>" onclick="return confirm('Hapus?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
