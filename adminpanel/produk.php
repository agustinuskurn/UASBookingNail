<?php
    require "session.php";   
    require "../js/koneksi.php";  

    $query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id");
    $jumlahProduk = mysqli_num_rows($query);

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");

    function generateRandomString($length= 10) {
        $characters = '0123456789abcdefghifjklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randonString = '';
        for ($i = 0; $i < $length; $i++) {
            $randonString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randonString;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/38a1163d27.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>

<style>
    form div{
        margin-bottom:  10px
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
                    Produk</li>
            </ol>
        </nav>

        <!--- tambah produk --->
        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Produk</h3>

            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" required>
                </div>
                <div>
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class ="form-control" required>
                        <option value="">Pilih Satu</option>
                        <?php 
                        while($data=mysqli_fetch_array($queryKategori)){
                            ?>
                            <option value="<?php echo $data['id']; ?>"><?php echo $data['nama']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" name="harga" required>
                </div>
                <div>
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto"class="form-control">
                </div>
                <div>
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" class="form-control"></textarea>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                </div>
            </form>

            <?php
                if(isset($_POST['simpan'])) {
                    $nama = htmlspecialchars($_POST['nama']);
                    $kategori = htmlspecialchars($_POST['kategori']);
                    $harga = htmlspecialchars($_POST['harga']);
                    $detail = htmlspecialchars($_POST['detail']);

                    $target_dir = "../img/";
                    $nama_file = basename($_FILES["foto"]["name"]);
                    $target_file = $target_dir . $nama_file;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $image_size = $_FILES["foto"]["size"];
                    $random_name = generateRandomString(20);
                    $new_name = $random_name . "." . $imageFileType;

                    if ($nama == '' || $kategori == '' || $harga == '') {
            ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Nama, kategori dan harga wajib diisi
                        </div>
            <?php
                    } else {
                        if ($nama_file != '') {
                            if ($image_size > 1000000) {
            ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                    File tidak boleh lebih dari 1Mb
                                </div>
                <?php
                            } elseif (!in_array($imageFileType, ['jpeg', 'png', 'gif'])) {
                ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                    File harus bertipe jepg/png/gif
                                </div>

            <?php   
                                }
                                else {
                                    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);
                                }
                            }
                        }

                        //query insert to produk table
                        $queryTambah = mysqli_query($con, "INSERT INTO produk (kategori_id, nama, harga,foto,detail) VALUES('$kategori', '$nama', '$harga', '$new_name', '$detail')");

                        if($queryTambah){
            ?>
                            <div class="alert alert-primary mt-3" role="alert">
                                Produk Berhasil Tersimpan
                            </div>
                            <meta http-equiv="refresh" content="2; url=produk.php" />
            <?php
                        }
                        else{
                            echo mysqli_error($con);
                        }
                    }
            ?>

        </div>

        <div class="mt-3 mb-5">
            <h2>List Produk</h2>
            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php 
                        if($jumlahProduk==0){
            ?>
                                <tr>
                                    <td colspan=5 class="text-center">Data produk tidak tersedia</td>
                                </tr>
            <?php
                        }
                        else {
                            $jumlah = 1;
                            while ($data = mysqli_fetch_array($query)) {
            ?>
                                <tr>
                                    <td><?php echo $jumlah; ?></td>
                                    <td><?php echo $data['nama']; ?></td> 
                                    <td><?php echo $data['nama_kategori']; ?></td>
                                    <td><?php echo $data['harga']; ?></td> 
                                    <td>
                                        <a href="produk-detail.php?id=<?php echo $data['id']; ?>" class="btn btn-info"><i class="fas fa-search"></i></a>
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