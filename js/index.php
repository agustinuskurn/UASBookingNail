<?php
 require "koneksi.php";
 $queryProduk = mysqli_query($con, "SELECT id, nama, harga, foto, detail FROM produk LIMIT 6");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nail Jalanti | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/38a1163d27.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>
    <!-- banner -->
    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>Nail Jayanti</h1>
            <h4>Mau Cari Apa?</h4>
            <div class="col-md-8 offset-md-2">
                <form method="get" action="produk.php">
                    <div class="input-group input-group-lg my-4">
                        <input type="text" class="form-control" placeholder="Nama Produk" aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
                        <button type="submit" class="btn warna3">Telusuri</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- kategori -->
     <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Kategori Best Seller</h3>

            <div class="row mt-5">
                <div class="col-md-4 mb-3">
                    <div class="hightlighted-kategori kategori-best-seller d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Best Seller">Best Seller</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="hightlighted-kategori kategori-kuku-palsu d-flex justify-content-center align-items-center">
                    <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Kuku Palsu">Kuku Palsu</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="hightlighted-kategori kategori-kuku-asli d-flex justify-content-center align-items-center">
                    <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Kuku Asli">Kuku Asli</a></h4>
                    </div>
                </div>
            </div>
        </div>
     </div>

<!-- tentang kami -->
    <div class="container-fluid warna3 py-5">
        <div class="container text-center">
            <h3>Tentang Kami</h3>
            <p class="fs-5 mt-3">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus et optio voluptas rem sed officia consectetur distinctio architecto iure facere dolorum, veniam porro repellat nam, iste molestias soluta! Dignissimos, sit!
            </p>
        </div>
    </div>
<!-- produk -->
<div class="container-fluid py-5">
    <div class="container text-center">
        <h3>Produk</h3>

        <div class="row mt-5">
            <?php while ($data = mysqli_fetch_array($queryProduk)) { ?>
                <div class="col-sm-6 col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="img-box">
                            <img src="../img/<?php echo $data['foto']; ?>" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $data['nama']; ?></h4>
                            <p class="card-text text-truncate"><?php echo $data['detail']; ?></p>
                            <p class="card-text">Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?></p>
                            <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>" class="btn warna3">Detail Produk</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
</div>

    </div>
</div>
    <!-- footer -->
    <?php require "footer.php"; ?>
</body>
</html>