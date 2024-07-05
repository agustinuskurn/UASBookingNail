<?php
    require "session.php";   
    require "../js/koneksi.php";

    // Pastikan $_GET['id'] ada dan merupakan angka
    if(isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];

        $query = mysqli_query($con, "SELECT * FROM booking WHERE id='$id'");
        $data = mysqli_fetch_array($query);

        $queryStatus = mysqli_query($con, "SELECT * FROM status_detail");
        $statusOptions = array();
        while ($row = mysqli_fetch_assoc($queryStatus)) {
            $statusOptions[] = $row;
        }


        if(isset($_POST['edit'])) {
            // Ambil nilai dari form
            $nama = htmlspecialchars($_POST['nama']);
            $tanggal = htmlspecialchars($_POST['tanggal']);
            $jam = htmlspecialchars($_POST['jam']);
            $telfon = htmlspecialchars($_POST['telfon']);
            $total_harga = $_POST['total_harga']; // Ambil total_harga dari form
            $status = htmlspecialchars($_POST['status']);
            $kategori_id = $_POST['kategori'];
        
            // Validate required fields (sudah sesuai)
        
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
                // Tampilkan pesan sukses atau redirect
                ?>
                <div class="alert alert-primary mt-3" role="alert">
                    Booking Berhasil Terupdate
                </div>
                <meta http-equiv="refresh" content="2; url=booking.php" />
                <?php
            } else {
                // Tampilkan pesan error jika query gagal
                ?>
                <div class="alert alert-danger mt-3" role="alert">
                    Gagal melakukan update: <?php echo mysqli_error($con); ?>
                </div>
                <?php
            }
        }
    }        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Detail Booking</title>
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
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['nama']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal Booking</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $data['tanggal']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="jam" class="form-label">Jam</label>
                    <input type="time" class="form-control" id="jam" name="jam" value="<?php echo $data['jam']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="telfon" class="form-label">Nomor Telepon</label>
                    <input type="tel" class="form-control" id="telfon" name="telfon" value="<?php echo $data['no_telfon']; ?>" readonly>
                    <small>Format: 10-12 digit angka</small>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status Booking</label>
                    <select class="form-control" id="status" name="status">
                        <?php foreach ($statusOptions as $option): ?>
                            <option value="<?php echo $option['status_name']; ?>" <?php if ($data['status'] == $option['status_name']) echo 'selected'; ?>><?php echo $option['status_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="total_harga" class="form-label">Total Harga</label>
                    <input type="number" class="form-control" id="total_harga" name="total_harga" value="<?php echo $data['total_harga']; ?>" >
                </div>

                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <input type="text" class="form-control" id="kategori" name="kategori" value="<?php echo $data['kategori_id']; ?>" readonly >
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" name="edit" class="btn btn-primary"><a href="booking.php" class="no-decoration">Simpan</a></button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
