<?php
require "session.php";
require "../js/koneksi.php";

$queryBooking = mysqli_query($con, "SELECT id, nama, tanggal, jam, no_telfon, status, total_harga, kategori_id FROM booking");
$jumlahBooking = mysqli_num_rows($queryBooking);

// Menambahkan opsi untuk kategori_id pada form booking
$queryKategori = mysqli_query($con, "SELECT id, nama FROM kategori");

?>

<?php require "navbar.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin || Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/38a1163d27.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    
</head>
<body>
    <div class="mt-3 mb-5">
        <h2>List Booking</h2>
        <div class="table-responsive mt-5">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Tanggal Booking</th>
                        <th>Jam</th>
                        <th>No.Telfon</th>
                        <th>Status</th>
                        <th>Total Harga</th>
                        <th>Kategori</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
if ($jumlahBooking == 0) {
?>
    <tr>
        <td colspan="9" class="text-center">Data booking tidak tersedia</td>
    </tr>
<?php
} else {
    $jumlah = 1;
    while ($data = mysqli_fetch_array($queryBooking)) {
?>
        <tr>
            <td><?php echo $jumlah; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo isset($data['tanggal']) ? $data['tanggal'] : ''; ?></td>
            <td><?php echo isset($data['jam']) ? $data['jam'] : ''; ?></td>
            <td><?php echo isset($data['no_telfon']) ? $data['no_telfon'] : ''; ?></td>
            <td><?php echo isset($data['status']) ? $data['status'] : ''; ?></td>
            <td><?php echo isset($data['total_harga']) ? $data['total_harga'] : ''; ?></td>
            <td><?php echo isset($data['kategori_id']) ? $data['kategori_id'] : ''; ?></td>
            <td>
                <a href="booking-detail.php?id=<?php echo $data['id']; ?>" class="btn btn-info"><i class="fas fa-search"></i></a>
            </td>
        </tr>
    <?php
        $jumlah++;
    }
}
?>

                </tbody>
            </table>
        </div>
    </div>
    
</body>
</html>
