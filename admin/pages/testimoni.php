<?php
include 'koneksi.php';

// Tambah testimoni
if(isset($_POST['add'])){
    $nama = $_POST['nama'];
    $pesan = $_POST['pesan'];
    $conn->query("INSERT INTO testimoni (nama,pesan) VALUES ('$nama','$pesan')");
    header("Location: dashboard.php?page=testimoni");
    exit();
}

// Edit testimoni
if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $pesan = $_POST['pesan'];
    $conn->query("UPDATE testimoni SET nama='$nama', pesan='$pesan' WHERE id=$id");
    header("Location: dashboard.php?page=testimoni");
    exit();
}

// Hapus testimoni
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM testimoni WHERE id=$id");
    header("Location: dashboard.php?page=testimoni");
    exit();
}

// Ambil semua data
$result = $conn->query("SELECT * FROM testimoni");
?>

<h2>Testimoni</h2>

<!-- Form tambah -->
<form method="POST" style="margin-bottom:20px;">
    Nama: <input type="text" name="nama" required>
    Pesan: <input type="text" name="pesan" required>
    <button type="submit" name="add">Tambah</button>
</form>

<!-- Tabel data -->
<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Pesan</th>
    <th>Aksi</th>
</tr>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['nama']; ?></td>
    <td><?php echo $row['pesan']; ?></td>
    <td>
        <a href="dashboard.php?page=testimoni&edit_id=<?php echo $row['id']; ?>">Edit</a> |
        <a href="dashboard.php?page=testimoni&delete=<?php echo $row['id']; ?>" onclick="return confirm('Hapus?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

<?php
// Form edit muncul jika klik Edit
if(isset($_GET['edit_id'])){
    $id = $_GET['edit_id'];
    $data = $conn->query("SELECT * FROM testimoni WHERE id=$id")->fetch_assoc();
    ?>
    <h3>Edit Testimoni</h3>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
        Nama: <input type="text" name="nama" value="<?php echo $data['nama']; ?>" required>
        Pesan: <input type="text" name="pesan" value="<?php echo $data['pesan']; ?>" required>
        <button type="submit" name="edit">Simpan</button>
    </form>
    <?php
}
?>
