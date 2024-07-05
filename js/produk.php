<?php 
    require "koneksi.php";

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");

    // get produk by nama produk
    if(isset($_GET['keyword'])){
        $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama LIKE '%$_GET[keyword]%'");
    }
    // get produk by kategori
    else if(isset($_GET['kategori'])){
        $queryGETKategoriId = mysqli_query($con, "SELECT id FROM kategori WHERE nama='$_GET[kategori]'");
        $kategoriId = mysqli_fetch_array($queryGETKategoriId);
        
        $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$kategoriId[id]'");
    }
    // get produk by default
    else{
        $queryProduk = mysqli_query($con, "SELECT * FROM produk");
    }

    $countData = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nail Jayanti | Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/38a1163d27.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php require "navbar.php" ?>

    <!-- banner -->
    <div class="container-fluid banner-produk d-flex align-items-center">
        <div class="container">
            <h1 class="text-white text-center">Produk</h1>
        </div>
    </div>  

    <!-- body -->
     <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-4">
                <h3>Kategori</h3>
            <ul class="list-group">
                <?php while($kategori = mysqli_fetch_array($queryKategori)){ ?>
                <a class="text-decoration" href="produk.php?kategori=<?php echo $kategori['nama']?>">
                <li class="list-group-item"><?php echo $kategori['nama'] ?></li>
                </a>
                <?php } ?>
            </ul>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center mb-3">Produk</h3>
                <div class="row">
                    <?php 
                    if($countData<1){
                    ?>
                        <h4 class="text-center">Produk yang anda cari tidak tersedia</h4>
                    <?php
                        }
                    ?>

                    <?php while($produk = mysqli_fetch_array($queryProduk)){ ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="img-box">
                                <img src="../img/<?php echo $produk['foto']; ?>" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $produk['nama']; ?></h4>
                                <p class="card-text text-truncate"><?php echo $produk['detail']; ?></p>
                                <p class="card-text">Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></p>
                                <a href="produk-detail.php?nama=<?php echo $produk['nama'] ?>" class="btn warna3">Detail Produk</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
     </div>
    <!--footer-->
    <?php require "footer.php" ?>
</body>
</html>