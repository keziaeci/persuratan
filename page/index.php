  <?php 
  session_start();

  if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
  }
  require 'functions.php';
  
  $jumlah_sm = count(query('SELECT * from surat_masuk'));
  $jumlah_sk = count(query('SELECT * from surat_keluar'));
  $jumlah_disposisi = count(query('SELECT * from disposisi'));
  //ambil tanggal surat di database 
  
  ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Dashboard</title>
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
        <div class="header_img"> <img src="" alt=""> </div>
    </header>
    <div class="l-navbar bg-primary min-width-100vw  rounded-end" id="nav-bar">
        <nav class="nav">
            <div> 
              <a href="#"  class="nav_logo px-3"> 
                <img  src="../assets/img/logo_siapwolu.png" style="width: 40px;" alt="">
                <span class="nav_logo-name">SiapWolu</span> 
              </a>
                <div class="nav_list"> 
                  <a href="#" class="nav_link active">
                    <img class="nav_icon" src="../assets/icon/dashboard_icon.png" style="height: 20px;" alt="">  
                    <span class="nav_name">Dashboard</span> 
                  </a> 
                  <li> 
                    <a class="nav_link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#daftarSurat" aria-expanded="false" aria-controls="daftarSurat">
                      <img class="nav_icon" src="../assets/icon/rekap_icon.png" style="height: 22px;" alt="">
                      <span class="nav_name">Rekap Surat</span>
                    </a>
                    <div class="collapse-inner rounded bg-white p-2" id="daftarSurat">
                      <a class="collapse-item d-block text-dark" href="./surat_masuk.php">Surat Masuk</a>
                      <a class="collapse-item d-block text-dark" href="./surat_keluar.php">Surat Keluar</a>
                      <a class="collapse-item d-block text-dark" href="./disposisi.php">Disposisi</a>
                    </div>
                  </li>
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
    <!--Container Main start-->
    <div class="row" id="chart">
      <div class="col-xl-12 col-lg-8">
        <div class="card shadow mb-4">
          <div class="card-body">
            <canvas id="myChart"></canvas>
          </div>
        </div>
      </div>
    </div>
    <!--Container Main end-->
    <!-- Content Row -->
    <div class="row">

      <!-- jumlah surat masuk -->
      <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a class="link  text-xs font-weight-bold text-primary text-uppercase mb-1" href="./surat_masuk.php">
                                Jumlah Surat Masuk</a>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_sm ?></div>
                            </div>
                            <div class="col-auto card-image">
                            <img src="../assets/icon/mail_icon.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
      
        <!-- jumlah surat keluar -->
          <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                  <div class="card-body">
                      <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                              <a class="link text-xs font-weight-bold text-danger text-uppercase mb-1" href="./surat_keluar.php">
                                  Jumlah Surat Keluar</a>
                              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_sk ?></div>
                            </div>
                              <div class="col-auto card-image">
                                  <img src="../assets/icon/send_icon.png">
                              </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- jumlah disposisi -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <a class="link  text-xs font-weight-bold text-success text-uppercase mb-1" href="./disposisi.php">
                                    Jumlah Disposisi</a>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_disposisi ?></div>
                                </div>
                                <div class="col-auto card-image">
                                <img src="../assets/icon/mail_icon.png">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            

    <script>
  const labels = [
    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli','Agustus','September','Oktober','November','Desember'
  ];

  const data = {
    labels: labels,
    datasets: [{
      label: 'Surat Masuk',
      backgroundColor: 'rgb(255, 0, 0)',
      borderColor: 'rgb(255, 0, 0)',
      data: [0, 10, 5, 2, 20, 30, 45],
    }
  ,{
      label: 'Surat Keluar',
      backgroundColor: 'rgb(0, 99, 132)',
      borderColor: 'rgb(0, 99, 132)',
      data: [0, 10, 5, 2, 20, 30, 45],
    }]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  };
</script>
<script>
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>
    <script src="../script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </body>
</html>