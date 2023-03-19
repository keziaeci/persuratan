<?php 
//koneksi ke database
        //variable conn dibawah merepresentasikan function mysqli connect agar mudah digunakkan berkali1
        $conn = mysqli_connect("localhost","root","","sistem_persuratan");
        
        function query($query) {
            global $conn;   
            $result = mysqli_query($conn,$query);
            $rows = [];
            while($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
            return $rows;
        } 

        function tambah($data) {
            //mengambil data dari tiap elemen dalam form
            global $conn;
            //penggunaan htmlspecialchars adalah supaya input dgn tag2 html tdk ter-execute
            $tanggal_pembuatan = date('Y-m-d', strtotime($data["tanggal"]));
            $nomor_surat = htmlspecialchars($data["nomor_surat"]);
            $kepada = htmlspecialchars($data["kepada"]);
            $keperluan = htmlspecialchars($data["keperluan"]);
            //cek apakah nomor surat sudah ada atau belum
            $result = mysqli_query($conn, "SELECT nomor_surat FROM surat_keluar WHERE nomor_surat = '$nomor_surat'");
            if (mysqli_fetch_assoc($result)) {
                echo "<script>
                        alert('Nomor surat sudah ada');
                    </script>";
                return false;
            }   
            //upload gambar
            $file_surat = upload();
            if (!$file_surat) {
                return false;
            }

            //query insert data
            $query = "INSERT INTO surat_keluar VALUES
                        ('','$tanggal_pembuatan','$nomor_surat','$kepada','$keperluan','$file_surat')";
            mysqli_query($conn, $query);

            //agar mengembalikan nilai 
            return mysqli_affected_rows($conn);
        }

        function upload() {
            $namaFile = $_FILES['file_surat']['name'];
            $ukuranFile = $_FILES['file_surat']['size'];
            $error = $_FILES['file_surat']['error'];
            $tmpName = $_FILES['file_surat']['tmp_name'];

            //cek apakah tidak ada file yang diupload
            if($error === 4) {
                echo "<script>
                        alert('Pilih gambar terlebih dahulu');
                    </script>";
                return false;
            }

            //cek apakah yang diupload adalah file dokumen
            $ekstensiFileValid = ['pdf','docx','doc','xls','xlsx','ppt','pptx'];

            //explode berfungsi untuk memisahkan string menjadi array
            $ekstensiFile = explode('.', $namaFile);

            //strtolower berfungsi untuk mengubah string menjadi huruf kecil
            $ekstensiFile = strtolower(end($ekstensiFile));

            //in_array berfungsi untuk mengecek apakah ada string yang sama di dalam array
            if(!in_array($ekstensiFile, $ekstensiFileValid)) {
                echo "<script>
                        alert('File anda tidak valid!');
                    </script>";
                return false;
            }

            //cek jika ukurannya terlalu besar
            if($ukuranFile > 1000000000 ) {
                echo "<script>
                        alert('ukuran file terlalu besar');
                    </script>";
                return false;
            }

            //lolos pengecekan , file siap diupload
            //generate nama file baru
            // $namaFileBaru = uniqid();
            // $namaFile .= '.';
            // $namaFile .= $ekstensiFile;

            move_uploaded_file($tmpName, '../assets/file_sk/' . $namaFile);

            return $namaFile;
        }   

        function hapus($id){
            global $conn;
            mysqli_query($conn , "DELETE FROM surat_keluar WHERE id = $id");
            //agar mengembalikan nilai 
            return mysqli_affected_rows($conn);
        }

        function ubah($data){
            global $conn;
            $id = $data["id"]; 
            $tanggal_pembuatan = date('Y-m-d', strtotime($data["tanggal"]));
            $nomor_surat = htmlspecialchars($data["nomor_surat"]);
            $kepada = htmlspecialchars($data["kepada"]);
            $keperluan = htmlspecialchars($data["keperluan"]);
            $fileLama = htmlspecialchars($data["fileLama"]);
            
            //cek apakah user pilih file baru atau tidak
            // error 4 adalah tidak ada file yang diupload
            if ($_FILES['file_surat']['error'] === 4) {

                // file lama didapat dari input hidden
                $file_surat = $fileLama;
            }else {
                $file_surat = upload();
            }

            //query insert data
            $query = "UPDATE surat_keluar SET 
                    tanggal = '$tanggal_pembuatan' , 
                    nomor_surat = '$nomor_surat' ,
                    kepada = '$kepada' ,
                    keperluan = '$keperluan' ,
                    file_surat = '$file_surat'
                    WHERE id = $id
                    ";
            mysqli_query($conn, $query);

            //agar mengembalikan nilai 
            return mysqli_affected_rows($conn);
        }

        function cari($keyword) {
            //guna function LIKE disini kita mencari data namun tidak perlu menulis secara rinci ,contoh untuk mencari data Sandhika kita bisa dengan menulis san dan data sandhika akan muncul
            $query = "SELECT * FROM surat_keluar WHERE 
                        nomor_surat LIKE '%$keyword%' OR 
                        kepada LIKE '%$keyword%' OR
                        tanggal LIKE '%$keyword%' ";
            return query($query);
        }
?>