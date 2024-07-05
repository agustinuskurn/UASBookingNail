<?php
    require "koneksi.php";

    // Check if 'id' parameter exists in GET request
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        // Fetch booking details based on ID
        $query = mysqli_query($con, "SELECT * FROM booking WHERE id='$id'");
        $data = mysqli_fetch_array($query);

        // Handle form submission for edit
        if(isset($_POST['edit'])) {
            $nama = htmlspecialchars($_POST['nama']);
            $tanggal = htmlspecialchars($_POST['tanggal']);
            $jam = htmlspecialchars($_POST['jam']);
            $telfon = htmlspecialchars($_POST['telfon']);
            $total_harga = htmlspecialchars($_POST['total_harga']);
            $status = htmlspecialchars($_POST['status']);
            $kategori_id = $_POST['kategori']; // 'kategori_id' field corrected to 'kategori'

            // Validate required fields
            if ($nama == '' || $tanggal == '' || $jam == '' || $telfon == '' || $total_harga == '' || $status == '' || $kategori_id == '') {
                ?>
                <div class="alert alert-warning mt-3" role="alert">
                    Nama, Tanggal, Jam, Nomor Telepon, Total Harga, Status, dan Kategori wajib diisi
                </div>
                <?php
            } else {
                // Update booking record in the database
                $queryUpdate = mysqli_query($con, "UPDATE booking SET 
                                                    nama='$nama', 
                                                    tanggal='$tanggal', 
                                                    jam='$jam', 
                                                    no_telfon='$telfon', 
                                                    status='$status', 
                                                    total_harga='$total_harga', 
                                                    kategori_id='$kategori_id' 
                                                WHERE id='$id'");

                if ($queryUpdate) {
                    ?>
                    <div class="alert alert-primary mt-3" role="alert">
                        Booking Berhasil Terupdate
                    </div>
                    <meta http-equiv="refresh" content="2; url=booking.php" />
                    <?php
                } else {
                    echo mysqli_error($con);
                }
            }
        }

        // Handle form submission for delete
        if(isset($_POST['delete'])) {
            $queryDelete = mysqli_query($con, "DELETE FROM booking WHERE id='$id'");

            if($queryDelete) {
                ?>
                <div class="alert alert-primary mt-3" role="alert">
                    Data Booking Berhasil Dihapus
                </div>
                <meta http-equiv="refresh" content="2; url=booking.php" />
                <?php
            } else {
                echo mysqli_error($con);
            }
        }
    } else {
        echo "ID booking tidak ditemukan dalam URL.";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/38a1163d27.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-5">
        <h2>Detail Booking</h2>

        <div class="col-12 col-md-6">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['nama']; ?>" >
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal Booking</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $data['tanggal']; ?>" >
                </div>
                <div class="mb-3">
                    <label for="jam" class="form-label">Jam</label>
                    <input type="time" class="form-control" id="jam" name="jam" value="<?php echo $data['jam']; ?>" >
                </div>
                <div class="mb-3">
                    <label for="telfon" class="form-label">Nomor Telepon</label>
                    <input type="tel" class="form-control" id="telfon" name="telfon" value="<?php echo $data['no_telfon']; ?>" >
                    <small>Format: 10-12 digit angka</small>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status Booking</label>
                    <input type="text" class="form-control" id="status" name="status" value="<?php echo $data['status']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="total_harga" class="form-label">Total Harga</label>
                    <input type="text" class="form-control" id="total_harga" name="total_harga" value="<?php echo $data['total_harga']; ?>" readonly >
                </div>
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <input type="text" class="form-control" id="kategori" name="kategori" value="<?php echo $data['kategori_id']; ?>" >
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" name="edit" class="btn btn-primary"><a href="produk.php" class="no-decoration">Simpan</a></button>
                    <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                </div>
            </form>
        </div>
    </div>

    <!-- footer -->
    <?php require "footer.php"; ?>
</body>
</html>
