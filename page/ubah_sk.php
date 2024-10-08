<?php 
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
    require 'functions_sk.php';
    $id = $_GET["id"];

    //query data surat masuk berdasarkan id
    $srt = query("SELECT * FROM surat_keluar WHERE id = $id")[0];

    if (isset($_POST["submit"])) {

        //cek apakah data berhasil diubah atau tidak
        if (ubah($_POST) > 0) {
            echo " <script> 
                alert('Data berhasil diubah');
                document.location.href = 'surat_keluar.php'; 
            </script>";
        }else {
            echo " <script> 
            alert('Data gagal diubah!');
        </script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Ubah Data</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,600,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="../styles/sidebar.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="../assets/img/logo_siapwolu.png">
    
</head>
<body id="body-pd">

    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="" alt=""> 
    </div>
    </header>
    <div class="l-navbar bg-primary min-width-100vw  rounded-end" id="nav-bar">
        <nav class="nav">
            <div> 
                <a href="#" class="nav_logo px-3"> 
                    <img  src="../assets/img/logo_siapwolu.png" style="width: 40px;" alt="">
                <span class="nav_logo-name">SiapWolu</span> 
                </a>
                <div class="nav_list"> 
                    <a href="./index.php" class="nav_link active">
                    <img class="nav_icon" src="../assets/icon/dashboard_icon.png" style="height: 20px;" alt="">  
                    <span class="nav_name">Dashboard</span> 
                  </a> 
                  <a class="nav_link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#daftarSurat" aria-expanded="false" aria-controls="daftarSurat">
                    <img class="nav_icon" src="../assets/icon/rekap_icon.png" style="height: 22px;" alt="">
                    <span class="nav_name">Rekap Surat</span>
                  </a>
                                <div class="collapse-inner rounded bg-white p-2" id="daftarSurat">
                                        <a class="collapse-item d-block text-dark" href="./surat_masuk.php">Surat Masuk</a>
                                        <a class="collapse-item d-block text-dark" href="./surat_keluar.php">Surat Keluar</a>
                                </div>
                  <a href="#" class="nav_link"> 
                    <i class='bx bx-message-square-detail nav_icon'></i> 
                    <span class="nav_name">Messages</span> 
                  </a> 
                  <a href="#" class="nav_link"> 
                    <i class='bx bx-bookmark nav_icon'></i> 
                    <span class="nav_name">Bookmark</span> 
                  </a> 
                  <a href="#" class="nav_link"> 
                    <i class='bx bx-folder nav_icon'></i> 
                    <span class="nav_name">Files</span> 
                  </a> 
                  <a href="#" class="nav_link"> 
                    <i class='bx bx-bar-chart-alt-2 nav_icon'></i> 
                    <span class="nav_name">Stats</span> 
                    </a> 
                </div>
            </div> <a href="./logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">LogOut</span> </a>
        </nav>
    </div>
    <br>
        <!-- card -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow-sm">
                <div class="card-header text-dark">
                    <h4 class="card-title">Ubah surat keluar</h4>
                </div>
                    <form class="card-body m-0" action="" method="post" enctype="multipart/form-data">
                        <ul class="m-2 p-0">
                            <input type="hidden" name="id" value="<?= $srt["id"]; ?>">
                        <input type="hidden" name="fileLama" value="<?= $srt["file_surat"]; ?>">
                        
                        <li>
                            <label class="form-label" for="tanggal_pembuatan">Tanggal Pembuatan </label>
                            <input class="form-control" type="date" name="tanggal_pembuatan" id="tanggal_pembuatan" required value="<?= $srt["tanggal"]; ?>">
                        </li>
                        
                        <li>
                            <label class="form-label" for="nomor_surat">Nomor Surat </label>
                            <input class="form-control" type="text" name="nomor_surat" id="nomor_surat" required value="<?= $srt["nomor_surat"];  ?>">
                        </li>
                        
                        <li>
                            <label class="form-label" for="kepada">Kepada </label>
                            <input class="form-control" type="text" name="kepada" id="kepada" required value="<?= $srt["kepada"]; ?>">
                        </li>

                        <li>
                            <label class="form-label"  for="keperluan">Keperluan</label>
                            <input class="form-control" type="text" name="keperluan" id="keperluan" required value="<?= $srt["keperluan"]; ?>">
                        </li>
                        <li>
                            <label class="form-label" for="file_surat">File </label> 
                            <input class="form-control" type="file" name="file_surat" id="file_surat" value="<?= $srt["file_surat"];?>">
                        </li>
                        
                        <li>
                            <br>
                        <button class="btn bg-primary text-light" type="submit" name="submit">Ubah Data</button>
                        </li> <br>
                        <a class="material-symbols-outlined text-decoration-none" href="./surat_keluar.php">arrow_back_ios</a>
                    </ul>
                </form>
                </div>
            </div>
        </div>
        <!-- script -->
        <script src="../script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
            AOS.init();
        </script>
</body>
</html>