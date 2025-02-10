<!DOCTYPE html>
<html>
<head>
    <title>Form Penyewaan Mobil</title>
</head>
<body>
    <h2>Form Penyewaan Mobil</h2>
    <form action="rental-tampil.php" method="post">
        <label for="nama_mobil">Nama Mobil:</label>
        <select name="nama_mobil" id="nama_mobil">
            <option value="Alphard">Alphard</option>
            <option value="Pajero">Pajero</option>
            <option value="CR-V">CR-V</option>
            <option value="X-Trail">X-Trail</option>
            <option value="Terios">Terios</option>
        </select><br><br>

        <label for="status_customer">Status Customer:</label>
        <select name="status_customer" id="status_customer">
            <option value="Member">Member</option>
            <option value="Non Member">Non Member</option>
        </select><br><br>

        <input type="submit" value="Sewa Mobil">
    </form>
</body>
</html>

<?php
// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan data dari form
    $nama_mobil = $_POST['nama_mobil'] ?? null; // Menggunakan null coalescing operator
    $status_customer = $_POST['status_customer'] ?? null;

    // Menentukan biaya sewa perhari
    $biaya_sewa = 0;

    switch ($nama_mobil) {
        case "Alphard":
            $biaya_sewa = 1000000;
            break;
        case "Pajero":
            $biaya_sewa = 800000;
            break;
        case "CR-V":
            $biaya_sewa = 700000;
            break;
        case "X-Trail":
            $biaya_sewa = 600000;
            break;
        case "Terios":
            $biaya_sewa = 500000;
            break;
        default:
            echo "Mobil tidak ditemukan.";
            exit; // Menghentikan eksekusi jika mobil tidak valid
    }

    // Menghitung diskon
    $diskon = 0;

    if ($status_customer == "Member") {
        $diskon = 0.10; // 10%
    } elseif ($status_customer == "Non Member") {
        $diskon = 0.05; // 5%
    } else {
        echo "Status customer tidak valid.";
        exit; // Menghentikan eksekusi jika status tidak valid
    }

    // Menghitung total biaya dan total bayar
    $total_biaya = $biaya_sewa; // Misalkan sewa untuk 1 hari
    $total_diskon = $total_biaya * $diskon;
    $total_bayar = $total_biaya - $total_diskon;

    // Menampilkan hasil
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Data Transaksi Penyewaan</title>
    </head>
    <body>
        <h2>Data Transaksi Penyewaan</h2>
        <p>Nama Mobil: <?php echo htmlspecialchars($nama_mobil); ?></p>
        <p>Status Customer: <?php echo htmlspecialchars($status_customer); ?></p>
        <p>Biaya Sewa: Rp <?php echo number_format($total_biaya, 0, ',', '.'); ?></p>
        <p>Diskon: Rp <?php echo number_format($total_diskon, 0, ',', '.'); ?></p>
        <p>Total Bayar: Rp <?php echo number_format($total_bayar, 0, ',', '.'); ?></p>
        
        <a href="rental-input.php">Kembali ke Form Penyewaan</a>
    </body>
    </html>
    <?php
} else {
    echo "Form belum disubmit.";
}
?>