<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit();
}
require "functions.php";

if (isset($_POST["submit"])) {
    if (tambah_disposisi($_POST) > 0) {
        echo " <script> 
                alert('Data berhasil ditambahkan');
                document.location.href = 'disposisi.php'; 
            </script>";
    } else {
        echo " <script> 
            alert('Data gagal ditambahkan!');
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
    <title>Tambah Disposisi</title>
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
        <div class="header_img"> <img src="" alt=""> </div>
    </header>
    <div class="l-navbar bg-primary min-width-100vw  rounded-end" id="nav-bar">
        <nav class="nav">
            <div> 
              <a href="#" class="nav_logo px-3"> 
                <img  src="../assets/img/logo_siapwolu.png" style="width: 40px;" alt="">
                <span class="nav_logo-name">SiapWolu</span> 
              </a>
                <div class="nav_list"> 
                  <a href="#" class="nav_link active">
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
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow-sm">
                <div class="card-header text-dark">
                    <h4>Tambah Disposisi</h4>
                </div>
                    <form class="card-body m-0" action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6">
                                <ul class="m-2 p-0">
                                    <li>
                                        <label class="form-label" for="surat_dari">Surat Dari </label>
                                        <input class="form-control" type="text" name="surat_dari" id="surat_dari" size="" required>
                                    </li>
                                    <li>
                                        <label class="form-label" for="nomor_surat">Nomor Surat </label>
                                        <input class="form-control" type="text" name="nomor_surat" id="nomor_surat" size="" required>
                                    </li>
                                    
                                    <li>
                                        <label class="form-label" for="tanggal_surat">Tanggal Surat</label>
                                        <input class="form-control" type="date" name="tanggal_surat" id="tanggal_surat" required>
                                    </li>
                                    <li>
                                        <label class="form-label"  for="diterima_tanggal">Diterima Tanggal</label>
                                        <input class="form-control" type="date" name="diterima_tanggal" id="diterima_tanggal" required>
                                    </li>
                                    <li>
                                        <label class="form-label" for="nomor_agenda">Nomor Agenda</label>
                                        <input class="form-control" type="text" name="nomor_agenda" id="nomor_agenda" required>
                                    </li>
                                    <li class="p-2">
                                        <label class="form-label" for="tanggal_ditulis">Semarang,</label>
                                        <input type="text" name="tanggal_ditulis" id="tanggal_ditulis" required>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="m-2 p-0">
                                    <li>
                                        <label class="form-label" for="sifat">Sifat</label>
                                        <select class="form-control" name="sifat" id="sifat">
                                            <option value="Peting">Penting</option>
                                            <option value="Segera">Segera</option>
                                            <option value="Rahasia">Rahasia</option>
                                            <option value="Biasa">Biasa</option>
                                        </select>
                                    </li>
                                    <li>
                                        <label class="form-label" for="perihal">Perihal</label>
                                        <input class="form-control" type="text" name="perihal" id="perihal" autocomplete="off" required>
                                    </li>
                                    <li>
                                        <label class="form-label" for="diteruskan_kepada">Diteruskan Kepada</label>
                                        <select class="form-control" name="diteruskan_kepada" id="diteruskan_kepada">
                                            <option value="Tidak ada">Tidak Ada</option>
                                            <option value="Kasubag TU">Kasubag TU</option>
                                            <option value="Waka Kurikulum">Waka Kurikulum</option>
                                            <option value="Waka Kesiswaan">Waka Kesiswaan</option>
                                            <option value="Waka Sarana Prasarana dan Ketenagaan">Waka Sarana Prasarana dan Ketenagaan</option>
                                            <option value="Waka Hubungan Masyarakat/Industri">Waka Hubungan Masyarakat/Industri</option>
                                            <option value="K3 Perawatan Sosial">K3 PS</option>
                                            <option value="K3 Rekayasa Perangkat Lunak">K3 RPL</option>
                                            <option value="K3 Multimedia">K3 Multimedia</option>
                                            <option value="K3 Teknik Kompupter Jaringan">K3 TKJ</option>
                                            <option value="K3 Caregiver">K3 CG</option>
                                            <option value="K3 LK">K3 LK</option>
                                            <option value="Kepala Perpustakaan">Kepala Perpustakaan</option>
                                            <option value="Bendahara BOS">Bendahara BOS</option>
                                            <option value="Bendahara SOT">Bendahara SOT</option>
                                            <option value="Bendahara Gaji">Bendahara Gaji</option>
                                            <option value="Bendahara BOP">Bendahara BOP</option>
                                            <option value="Unit Produksi">Unit Produksi</option>
                                            <option value="Ketua BKK">Ketua BKK</option>
                                            <option value="Ketua PGRI">Ketua PGRI</option>
                                            <option value="Ketua Korpri">Ketua Korpri</option>
                                            <option value="BP/BK">BP/BK</option>
                                            <option value="Kepala Lab. Bahasa">Kepala Lab. Bahasa</option>
                                            <option value="Operator Sekolah">Operator Sekolah</option>
                                        </select>
                                        </li>
                                        <li>
                                        <label class="form-label" for="kepada_guru">atau kepada Guru</label>
                                        <input class="form-control" type="text" name="kepada_guru" id="kepada_guru" autocomplete="off">
                                        </li>
                                        <li>
                                        <label class="form-label" for="diperuntukan">Diperuntukkan</label>
                                        <select class="form-control" name="diperuntukan" id="diperuntukan">
                                            <option value="Tanggapan dan Saran">Tanggapan dan Saran</option>
                                            <option value="Proses Lebih Lanjut">Proses Lebih Lanjut</option>
                                            <option value="Koordinasi/Konfirmasi/Diinformasikan">Koordinasi/Konfirmasi/Diinformasikan</option>
                                            <option value="Mewakili">Mewakili</option>
                                            <option value="Dilaksanakan/Diselesaikan/Ditindaklanjuti">Dilaksanakan/Diselesaikan/Ditindaklanjuti</option>
                                            <option value="Disiapkan Bahan">Disiapkan Bahan</option>
                                            <option value="Konsultasi Hasil">Konsultasi Hasil</option>
                                            <option value="Diikuti/Dilaporkan Perkembangannya">Diikuti/Dilaporkan Perkembangannya</option>
                                            <option value="Menghubungi">Menghubungi</option>
                                            <option value="Catat dan Ingatkan">Catat dan Ingatkan</option>
                                            <option value="File/Diarsipkan">File/Diarsipkan</option>
                                            <option value="Dibantu">Dibantu</option>
                                            <option value="Ditempel">Ditempel</option>
                                            <option value="Dijadwalkan">Dijadwalkan</option>
                                        </select>
                                    </li>
                                <br>
                            </ul>
                        </div>
                    <ul class="m-2">
                        <li>
                            <button class="btn bg-primary text-light"           type="submit" name="submit">Tambah Data </button>
                        </li> 
                        <br>
                        <a class=" material-symbols-outlined text-decoration-none" href="./disposisi.php">arrow_back_ios</a>
                        <!-- <a class="btn btn-outline-primary" href="index.php">Kembali</a> -->
                    </ul>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../script.js"></script>
    <!-- scripct popper js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>
</body>
</html>