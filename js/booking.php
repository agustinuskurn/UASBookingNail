<?php
    require "koneksi.php";

    $queryBooking = mysqli_query($con, "SELECT id, nama, tanggal, jam, no_telfon, status, total_harga, kategori_id FROM booking");
    $queryProduk = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id");
    $jumlahBooking = mysqli_num_rows($queryBooking);

    // Menambahkan opsi untuk kategori_id pada form booking
    $queryKategori = mysqli_query($con, "SELECT id, nama FROM kategori");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jayanti nail | Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/38a1163d27.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>    

    <!-- Form Booking -->
    <div class="container my-5 col-12 col-md-6">
        <h2>Form Booking</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" required>
            </div>
            <div>
                <label for="tanggal">Tanggal Booking:</label>
                <input type="date" id="tanggal" name="tanggal" class="form-control" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="jam">Jam:</label>
                <input type="time" id="jam" name="jam" class="form-control" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="telfon">Nomor Telepon:</label>
                <input type="tel" id="telfon" name="telfon" class="form-control" autocomplete="off" pattern="[0-9]{10,12}" required>
                <small>Format: 10-12 digit angka</small>
            </div>
            <div class="form-group">
                <label for="status">Status Booking:</label>
                <input type="text" id="status" name="status" class="form-control" autocomplete="off" required readonly>
            </div>
            <div class="form-group">
                <label for="total_harga">Total Harga:</label>
                <input type="number" id="total_harga" name="total_harga" class="form-control" autocomplete="off" required readonly>
            </div>
            <div class="form-group">
                <label for="kategori_id">Kategori:</label>
                <select id="kategori_id" name="kategori_id" class="form-control" required>
                    <?php while ($kategori = mysqli_fetch_array($queryKategori)) { ?>
                        <option value="<?php echo $kategori['id']; ?>"><?php echo $kategori['nama']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary mb-3" name="booking">Booking</button>
            </div>
        </form>
        <?php
        if(isset($_POST['booking'])) {
            $nama = htmlspecialchars($_POST['nama']);
            $tanggal = htmlspecialchars($_POST['tanggal']);
            $jam = htmlspecialchars($_POST['jam']);
            $telfon = htmlspecialchars($_POST['telfon']);
            $total_harga = htmlspecialchars($_POST['total_harga']);
            $status = htmlspecialchars($_POST['status']);
            $kategori_id = $_POST['kategori_id'];

            if ($nama == '' || $tanggal == '' || $jam == '' || $telfon == ''|| $kategori_id == '') {
            ?>
                <div class="alert alert-warning mt-3" role="alert">
                    Nama, Tanggal, Jam, Nomor Telepon, dan Kategori wajib diisi
                </div>
            <?php
            } else {
                // Query insert to booking table
                $queryTambah = mysqli_query($con, "INSERT INTO booking (nama, tanggal, jam, no_telfon, status, total_harga, kategori_id) VALUES ('$nama', '$tanggal', '$jam', '$telfon', '$status', '$total_harga', '$kategori_id')");

                if ($queryTambah) {
            ?>
                    <div class="alert alert-primary mt-3" role="alert">
                        Booking Berhasil Tersimpan
                    </div>
                    <meta http-equiv="refresh" content="2; url=booking.php" />
                <?php
                } else {
                    echo mysqli_error($con);
                }
            }
        }
        ?>
    </div>

    <!-- List Produk -->
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
            <td><?php echo isset($data['nama_kategori']) ? $data['nama_kategori'] : ''; ?></td>
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
        <!-- footer -->
        <?php require "footer.php"; ?>
</body>
</html>
