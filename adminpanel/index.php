<?php
    require "session.php";   
    require "../js/koneksi.php";  

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");
    $jumlahKategori = mysqli_num_rows($queryKategori);

    $queryBooking = mysqli_query($con, "SELECT * FROM booking");
    $jumlahBooking = mysqli_num_rows($queryBooking);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jayanti Beauty Nails</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/38a1163d27.js" crossorigin="anonymous"></script>
</head>
<style>
    .kotak {
        border: solid;
    }

    .warna-kategori {
        background-color:  #b04c02 ;
        border-radius: 15px;
    }
    .warna-booking {
        background-color:  #b04c02 ;
        border-radius: 15px;
    }
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
                    <i class="fa-solid fa-house"></i>Home</li>
                </ol>
            </nav>
            <h2>Hallo <?php echo $_SESSION['username']; ?></h2>

            <div class="container mt-5">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="warna-kategori p-3">
                            <div class="row">
                                <div class="col-6">
                                    <i class="fa-solid fa-align-justify fa-7x text-black-50"></i>
                                </div>
                                <div class="col-6 text-white">
                                    <h3 class="fs-2">Kategori</h3>
                                    <p class="fs4"><?php echo  $jumlahKategori ?> Kategori</p>
                                    <p><a href="kategori.php" class="text-white no-decoration">Lihat Detail</a></p>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="warna-booking p-3">
                        <div class="row">
                            <div class="col-6">
                                <i class="fa-solid fa-box fa-7x text-black-50"></i>
                            </div>
                            <div class="col-6 text-white">
                                <h3 class="fs-2">Booking</h3>
                                <p class="fs4"><?php echo $jumlahBooking ?> Booking</p>
                                <p><a href="booking.php" class="text-white no-decoration">Lihat Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                <h1>Show a Date Control</h1>
                    <form action="/action_page.php">
                        <label for="birthday">Booking:</label>
                        <input type="date" id="birthday" name="birthday">
                        <input type="submit">   
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>