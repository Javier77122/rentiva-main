<?php
include 'koneksi.php';

// Tambah pembelian
if(isset($_POST['add'])){
    $nama = $_POST['nama_barang'];
    $tanggal = $_POST['tanggal'];
    $harga = $_POST['harga'];
    $conn->query("INSERT INTO pembelian (nama_barang,tanggal,harga) VALUES ('$nama','$tanggal','$harga')");
    header("Location: dashboard.php?page=pembelian");
    exit();
}

// Hapus pembelian
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM pembelian WHERE id=$id");
    header("Location: dashboard.php?page=pembelian");
    exit();
}

// Ambil semua data
$result = $conn->query("SELECT * FROM pembelian");
?>

<h2>Pembelian</h2>

<form method="POST" style="margin-bottom:20px;">
    Nama Barang: <input type="text" name="nama_barang" required>
    Tanggal: <input type="date" name="tanggal" required>
    Harga: <input type="number" name="harga" required>
    <button type="submit" name="add">Tambah</button>
</form>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Nama Barang</th>
    <th>Tanggal</th>
    <th>Harga</th>
    <th>Aksi</th>
</tr>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['nama_barang']; ?></td>
    <td><?php echo $row['tanggal']; ?></td>
    <td><?php echo $row['harga']; ?></td>
    <td>
        <a href="dashboard.php?page=pembelian&delete=<?php echo $row['id']; ?>" onclick="return confirm('Hapus?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
