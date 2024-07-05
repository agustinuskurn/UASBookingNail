<?php
    require "koneksi.php";

    $nama = htmlspecialchars($_GET['nama']);
    $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama='$nama'");
    $produk = mysqli_fetch_array($queryProduk);

    $queryProdukTerkait = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$produk[kategori_id]' AND id!='$produk[id]' LIMIT 4");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nail Jayanti | Detail Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/38a1163d27.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>

<!-- produk detail -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-4">
                    <img src="../img/<?php echo $produk['foto'] ?>" alt="" width="400px">
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <h1><?php echo $produk['nama'] ?></h1>
                    <p class="fs-5"><?php echo $produk['detail']?></p>
                    <p class="text-harga">Rp <?php echo $produk['harga']?></p>
                    <div class="mt-3">
                        <button class="btn btn-primary" type="submit" name="booking_produk"><a href="booking.php" class="no-decoration">Booking</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- produk terkait -->
    <div class="container-fluid py-5 warna2">
        <div class="container">
            <h2 class="text-center text-white mb-5">Produk Terkait</h2>

            <div class="row">
                <?php while($data=mysqli_fetch_array($queryProdukTerkait)) {?>
                <div class="col-md-6 col-lg-3 mb-3">
                    <a href="produk-detail.php?nama=<?php echo $data['nama'] ?>">
                    <img src="../img/<?php echo $produk['foto']?>" class="img-fluid img-thumnail produk-terkait-img" alt="" width="400px">
                    </a>
                </div>
                <?php } ?>  
            </div>
        </div>
    </div>
 <!--footer-->
 <?php require "footer.php" ?>
</body>
</html>