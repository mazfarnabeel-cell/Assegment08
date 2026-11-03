
<?php
session_start();

// Daftar barang
$barang = [
    1 => "Buku",
    2 => "Pulpen",
    3 => "Pensil",
    4 => "Penghapus"
];

// Keranjang belanja
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

// Proses tombol Add dan Remove
if (isset($_POST['aksi']) && isset($_POST['id'])) {

    $id = (int) $_POST['id'];

    if (isset($barang[$id])) {

        if ($_POST['aksi'] == 'add') {

            // Menambah kuantitas
            if (isset($_SESSION['keranjang'][$id])) {
                $_SESSION['keranjang'][$id]++;
            } else {
                $_SESSION['keranjang'][$id] = 1;
            }

        } elseif ($_POST['aksi'] == 'remove') {

            // Mengurangi kuantitas
            if (isset($_SESSION['keranjang'][$id])) {
                $_SESSION['keranjang'][$id]--;

                // Hapus barang jika kuantitas nol
                if ($_SESSION['keranjang'][$id] <= 0) {
                    unset($_SESSION['keranjang'][$id]);
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Latihan Minggu 08</title>
</head>
<body>

<h2>Aplikasi Kuantitas Barang</h2>

<h3>Daftar Barang</h3>

<table border="1" cellpadding="10">
    <tr>
        <th>Nama Barang</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($barang as $id => $nama) { ?>
    <tr>
        <td><?php echo $nama; ?></td>
        <td>
            <form method="post">
                <input type="hidden" name="id"
                       value="<?php echo $id; ?>">

                <button type="submit" name="aksi"
                        value="add">Add</button>

                <button type="submit" name="aksi"
                        value="remove">Remove</button>
            </form>
        </td>
    </tr>
    <?php } ?>

</table>

<h3>Keranjang Barang</h3>

<table border="1" cellpadding="10">
    <tr>
        <th>Nama Barang</th>
        <th>Kuantitas</th>
    </tr>

    <?php
    foreach ($_SESSION['keranjang'] as $id => $jumlah) {
    ?>
    <tr>
        <td><?php echo $barang[$id]; ?></td>
        <td><?php echo $jumlah; ?></td>
    </tr>
    <?php } ?>

    <?php if (empty($_SESSION['keranjang'])) { ?>
    <tr>
        <td colspan="2">Belum ada barang.</td>
    </tr>
    <?php } ?>

</table>

</body>
</html>
