<?php 
    session_start();

    if (!isset($_SESSION["login"])) {
        header("Location: login.php");
        exit;
    }
    
    require 'functions.php';

    
    $jumlahDataPerHalaman = 10;
    $jumlahData = count(query("SELECT * FROM disposisi")); 
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
    $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;


    
    $surat = query("SELECT * FROM disposisi LIMIT $awalData, $jumlahDataPerHalaman ");

    if (isset($_POST["cari"])) {
        $surat = cari($_POST["keyword"]);
    }

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Disposisi - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/sidebar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="../assets/img/logo_siapwolu.png">
  </head>
  <body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="" alt=""> </div>
    </header>
    <div class="l-navbar bg-primary  rounded-end" id="nav-bar">
        <nav class="nav">
            <div> 
              <a href="#" class="nav_logo px-3"> 
                <img  src="../assets/img/logo_siapwolu.png" style="width: 40px;" alt="">
                <span class="nav_logo-name">SiapWolu</span> 
              </a>
                <div class="nav_list"> 
                  <a href="./index.php" class="nav_link active">
                    <img src="../assets/icon/dashboard_icon.png" style="height: 20px;" class="nav_icon">  
                    <span class="nav_name">Dashboard</span> 
                  </a> 
                  <a href="#" class="nav_link"> 
                    <i class='bx bx-user nav_icon'></i> 
                    <span class="nav_name">Users</span> 
                  </a> 
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
    <!--Container Main start-->
      <div class="col-12">
        <div class="row">
          <div class="col mt-4">
            <p class="fw-semibold fs-5">Daftar Disposisi</p>
            <a class="link-dark text-decoration-none" href="?halaman=<?= $halamanAktif - 1; ?>"> <i class="bi bi-caret-left-fill"></i></a>
            <?php for( $i = 1; $i <= $jumlahHalaman; $i++) : ?>
                <?php if($i == $halamanAktif) : ?>
                    <a class="link-dark text-decoration-none fw-bold" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                    <?php else : ?>
                        <a class="link-secondary text-decoration-none" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                        <?php endif; ?>
                        <?php endfor; ?>
                          
            </div>
            </div>
            <div class="card shadow-2">
              <div class="card-header">
                <div class="row">
                  <a  class="col-sm-2 btn text-light bg-primary" href="tambah_disposisi.php">Tambah Disposisi</a>
                  <form class="col-sm-4 d-flex " action="" method="POST">
                        <!-- autofocus dibawah membuat field input kita aktif (tanpa di-pencet/otomatis) pada saat user masuk ke halaman ini -->
                        
                        <!-- atribut autocomplete dengan value off berfungsi untuk menonaktifkan input history -->
                        <input class="form-control me-2 " type="text" name="keyword" autofocus placeholder="Cari berdasarkan Nomor Surat/Asal/Tanggal" autocomplete="off" size="30">
                        <button class="btn btn-dark" type="submit" name="cari">Cari</button>
                    </form>
                    </div>
                  </div>
                  <div class="card-body p-1 m-0 table table-responsive">
                    <table  data-aos-duration="1200" data-aos="fade-up"  class="table  table-striped display nowrap w-100  aos-init aos-animate" border="5" cellpadding="10" cellspacing="0">
                        <tr>
                            <th>No. Urut</th>
                            <th>Surat Dari</th>
                            <th>Diteruskan Kepada</th>
                            <th>Nomor Surat</th>
                            <th>Sifat</th>
                            <th>Perihal </th>
                            <th>Aksi</th>
                        </tr>
                        <?php $i = 1; ?>
                    <?php foreach($surat as $row) : ?>
                        <tr>
                            <td><?= $i;  ?></td>  
                            <td><?= $row["asal_surat"]; ?></td>

                            <?php $kpd = $row["diteruskan_kepada"];
                                  $guru = $row["nama_guru"];?>
                            
                              <?php if($kpd == "Tidak ada") : ?>
                                <?php $kpd = $guru; ?>
                              <?php endif; ?>
                            <td><?= $kpd; ?></td>
                            <td><?= $row["nomor_surat"]; ?></td>
                            <td><?= $row["sifat"]; ?></td>
                            <td><?= $row["perihal"]; ?></td>
                            <td>
                                <a class="btn bg-primary text-light" href="cetak.php?id=<?= $row["id"]; ?>" target="_blank">Print</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                    </table>
                </div>
              </div>
            </div>
    <!--Container Main end-->
    
    <script src="../script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </body>
</html>