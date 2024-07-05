<?php
    require "session.php";   
    require "../js/koneksi.php";  

    $id =$_GET['id'];

    $query = mysqli_query($con, "SELECT * FROM kategori WHERE id='$id' ");
    $data = mysqli_fetch_array($query);

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-5">
        <h2>Detail Kategori</h2>

        <div class="col-12 col-md-6">
            <form action="" method="post">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" name="kategori" id="kategori" class="form-control" value="<?php echo $data['nama'] ?>">
                </div>

                <div class="mt-5 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
                    <button type="submit" class="btn btn-danger" name="deleteBtn">Delete</button>
                </div>
            </form>

             <?php 
                if(isset($_POST['editBtn'])){
                    $kategori = htmlspecialchars($_POST['kategori']);

                    if($data['nama']==$kategori){
                        ?>
                         <meta http-equiv="refresh" content="0; url=kategori.php" />
                        <?php 
                    }
                    else{
                        $query = mysqli_query($con, "SELECT *FROM kategori WHERE nama='$kategori'");
                        $jumlahData = mysqli_num_rows($query);
                        
                        if($jumlahData > 0){
                            ?>
                            <div class="alert alert-warning mt-3" role="alert">
                            Kategori sudah ada
                            </div>
                            <?php
                        }
                        else{
                            $querySimpan = mysqli_query($con, "UPDATE kategori SET nama='$kategori' WHERE id='$id'");
                            
                            
                            if($querySimpan){
                                ?>
                                <div class="alert alert-primary mt-3" role="alert">
                                    Kategori Berhasil Terupdate
                                </div>

                                <meta http-equiv="refresh" content="2; url=kategori.php" />
                                <?php
                                }
                                else{
                                    echo mysqli_error($con);
                                }  
                        }
                    }
                }

                if(isset($_POST['deleteBtn'])){
                    $queryCheck= mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$id'");
                    $dataCount = mysqli_num_rows($queryCheck);
                    
                    if($dataCount>0){
            ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Kategori tidak bisa dihapus karena sudah ada produk 
                        </div>
            <?php
                        die();
                    }

                    $queryDelete = mysqli_query($con, " DELETE FROM kategori WHERE id='$id'");

                        if($queryDelete){
                        ?>
                            <div class="alert alert-primary mt-3" role="alert">
                                Kategori Berhasil Terhapus
                            </div>

                            <meta http-equiv="refresh" content="2; url=kategori.php" />
                        <?php
                        } 
                        else {
                            echo mysqli_error($con);
                        }  
                    }
             ?>
        </div>
    </div>
</body>
</html>