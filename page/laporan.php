<?php 
  session_start();
  if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
  }
  require 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Laporan - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/sidebar.css">
    <link rel="stylesheet" href="../styles/admin.css">
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
            <p class="fw-semibold fs-5">Laporan</p>
          </div>
        </div>
        <form class="py-2" action="" method="GET">
          <div class="row">
            <div class="col-3">
                <label class="form-label" for="jenis">Jenis Surat :</label>
                <select class="form-control" name="jenis" id="jenis">
                    <option value="surat_masuk">Surat Masuk</option>
                    <option value="surat_keluar">Surat Keluar</option>
                </select>
            </div>
            <div class="col-3">
                <label class="form-label" for="dari_tanggal">Dari Tanggal :</label>
                <input class="form-control" type="date"         name="dari_tanggal" id="dari_tanggal" required>
            </div>  
            <div class="col-3">
                <label class="form-label" for="sampai_tanggal">Sampai Tanggal :</label>
                  <input class="form-control" type="date" name="sampai_tanggal" id="sampai_tanggal" required>
            </div>
            <div class="col-3 p-2">
                <button class="btn btn-primary mt-4" type="submit" name="cari">Cari</button>
                <!-- <button class="btn btn-dark">cari</button> -->     
            </div>
          </div>
        </form>
            <?php if(isset($_GET['cari'])) : ?>
              <?php
                $jenis = $_GET['jenis'];
                $dari_tanggal = $_GET['dari_tanggal'];
                $sampai_tanggal = $_GET['sampai_tanggal'];
                $query = "SELECT * FROM $jenis WHERE tanggal BETWEEN '$dari_tanggal' AND '$sampai_tanggal'";
                $result = mysqli_query($conn, $query);
              ?>
              <?php if(mysqli_num_rows($result) > 0) : ?>
                <div class="card shadow-2">
              <div class="card-header">
                <div class="row">
                </div>
              </div>
                  <div class="card-body p-1 m-0 table table-responsive">

                    <table  data-aos-duration="1200" data-aos="fade-up"  class="table  table-striped display nowrap w-100  aos-init aos-animate" border="5" cellpadding="10" cellspacing="0">
                        <!-- <tr>
                            <th>No. Urut</th>
                            <th>Tanggal</th>
                            <th>Nomor Surat</th>
                            <th>Asal Surat</th>
                            <th>Nomor & Tanggal Surat</th>
                            <th>Perihal </th>
                            <th>File  </th>
                            <th>Aksi</th>
                        </tr> -->
                        <?php $i = 1; ?>
                    <?php foreach($result as $row) : ?>
                      <?php if($_GET['jenis'] == "surat_masuk") : ?>
                        <div class="card">
                          <div class="card-body">
                            <p><?= $i;  ?> </p> 
                            <p>Tanggal surat masuk : <?= date("d-m-Y" , strtotime($row["tanggal"])); ?></p>
                            <p>Nomor surat : <?= $row["nomor_surat"]; ?></p>
                            <p>Asal : <?= $row['asal_surat'] ?></p>
                            <p>Nomor & Tanggal Surat : <?= $row["nomor_tanggal_surat"]; ?></p>
                            <p>Perihal : <?= $row["perihal"]; ?></p>
                          </div>
                        </div>
                      <?php else : ?>
                        <div class="card">
                          <div class="card-body">
                            <p><?= $i;  ?> </p> 
                            <p>Tanggal Surat Keluar : <?= date("d-m-Y" , strtotime($row["tanggal"])); ?></p>
                            <p>Nomor Surat : <?= $row['nomor_surat'] ?></p>
                            <p>Kepada : <?= $row['kepada'] ?></p>
                            <p>Keperluan : <?= $row['keperluan'] ?></p>
                          </div>
                        </div>
                      <?php endif; ?>
                      <?php $i++; ?>
                    <?php endforeach; ?>
                    </table>
                </div>
                <?php else: ?>
                  <div class="alert alert-danger" role="alert">
                    Data tidak ditemukan
                  </div>
              <?php endif; ?>
            <?php endif; ?>
              </div>
            </div>
    <!--Container Main end-->
    
    <script src="../script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </body>
</html>