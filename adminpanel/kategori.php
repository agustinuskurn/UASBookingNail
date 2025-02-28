<?php
    require "session.php";   
    require "../js/koneksi.php";  

    $queryKategori = mysqli_query($con,"SELECT * FROM kategori");
    $jumlahKategori = mysqli_num_rows($queryKategori);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Jayanti Beauty Nails</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/38a1163d27.js" crossorigin="anonymous"></script>
</head>
<style>
     .no-decoration {
        text-decoration: none;
    }
</style>
<body>
    <?php require "navbar.php"; ?>
        <div class="container mt-5"> 
            <nav arial-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                    <a href="../adminpanel" class="no-decoration text-muted">
                        <i class="fa-solid fa-home"></i>Home</a>
                    <li class="breadcrumb-item active" aria-current="page">
                    Kategori</li>
                </ol>
            </nav>

            <div class="my-5 col-12 col-md-6">
                <h3>Tambah Kategori</h3>

                <form action="" method="post">
                    <div>
                        <label for="kategori">Kategori</label>
                        <input type="text" id="kategori" name="kategori" placeholder="input nama kategori" class="form-control" required>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary" type="submit" name="simpan_kategori">Simpan</button>
                    </div>
                </form>
                
                <?php
                    if(isset($_POST['simpan_kategori'])){
                        $kategori = htmlspecialchars($_POST['kategori']);

                        $queryExist = mysqli_query($con, "SELECT* FROM kategori WHERE nama='$kategori'");
                        $jumlahDataKategoriBaru = mysqli_num_rows($queryExist);

                        if($jumlahDataKategoriBaru > 0){
                            ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                Kategori sudah ada
                            </div>
                            <?php
                        }
                        else{
                                $querySimpan = mysqli_query($con, "INSERT INTO kategori (nama) VALUES ('$kategori')");
                            
                            if($querySimpan){
                            ?>
                            <div class="alert alert-primary mt-3" role="alert">
                                Kategori Berhasil Tersimpan
                            </div>
                            <meta http-equiv="refresh" content="2; url=kategori.php" />
                            <?php
                            }
                            else{
                                echo mysqli_error($con);
                            }  
                            }
                    }
                ?>

            </div>

            <div class="mt-3">
                <h2>List Kategori</h2>

                <div class="table-responsive mt-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if($jumlahKategori==0){
                            ?>
                                <tr>
                                    <td colspan=3 class="text-center">Data kategori tidak tersedia</td>
                                </tr>
                            <?php
                                }
                                else{
                                    $jumlah = 1;
                                    while($data=mysqli_fetch_array($queryKategori)){
                            ?>
                                <tr>
                                    <td><?php echo $jumlah; ?></td>
                                    <td><?php echo $data ['nama'] ?></td>
                                    <td>
                                        <a href="kategori-detail.php?id=<?php echo $data['id']; ?>" class="btn btn-info"><i class="fas fa-search"></i></a>
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
        </div>
</body>
</html>