<?php
    //koneksi ke database
        //variable conn dibawah merepresentasikan function mysqli connect agar mudah digunakkan berkali2
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
            $tanggal_terima = date('d-m-Y', strtotime($data["tanggal_terima"]));
            $nomor_surat = htmlspecialchars($data["nomor_surat"]);
            $asal_surat = htmlspecialchars($data["asal_surat"]);
            $nomor_tanggal_surat = htmlspecialchars($data["nomor_tanggal_surat"]);
            $perihal = htmlspecialchars($data["perihal"]);
            //cek apakah nomor surat sudah ada atau belum
            $result = mysqli_query($conn, "SELECT nomor_surat FROM surat_masuk WHERE nomor_surat = '$nomor_surat'");
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
            $query = "INSERT INTO surat_masuk VALUES
                        ('','$tanggal_terima','$nomor_surat','$asal_surat','$nomor_tanggal_surat','$perihal','$file_surat')";
            mysqli_query($conn, $query);

            //agar mengembalikan nilai 
            return mysqli_affected_rows($conn);
        }

        function tambah_disposisi($data) {
            
            global $conn;
            
            $asal_surat = htmlspecialchars($data["surat_dari"]);
            $nomor_surat = htmlspecialchars($data["nomor_surat"]);
            $tanggal_surat = date('Y-m-d', strtotime($data["tanggal_surat"]));
            $tanggal_terima = date('Y-m-d', strtotime($data["diterima_tanggal"]));
            $nomor_agenda = htmlspecialchars($data["nomor_agenda"]);
            $sifat = htmlspecialchars($data["sifat"]);
            $perihal = htmlspecialchars($data["perihal"]);
            $diteruskan_kepada = htmlspecialchars($data["diteruskan_kepada"]);
            $nama_guru = htmlspecialchars($data["kepada_guru"]);
            $diperuntukan = htmlspecialchars($data["diperuntukan"]);
            $tanggal_ditulis = htmlspecialchars($data["tanggal_ditulis"]);

            //cek apakah nomor surat sudah ada atau belum
            $result = mysqli_query($conn, "SELECT nomor_surat FROM disposisi WHERE nomor_surat = '$nomor_surat'");
            if (mysqli_fetch_assoc($result)) {
                echo "<script>
                        alert('Nomor surat sudah ada');
                    </script>";
                return false;
            }   

            //query insert data
            $query = "INSERT INTO disposisi VALUES
                        ('','$asal_surat','$nomor_surat','$tanggal_surat','$tanggal_terima','$nomor_agenda','$sifat','$perihal','$diteruskan_kepada','$nama_guru','$diperuntukan','$tanggal_ditulis')";
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

        
            move_uploaded_file($tmpName, '../assets/file_sm/' . $namaFile);

            return $namaFile;
        }

        function hapus($id){
            global $conn;
            mysqli_query($conn , "DELETE FROM surat_masuk WHERE id = $id");
            //agar mengembalikan nilai 
            return mysqli_affected_rows($conn);
        }

        function ubah($data){
            global $conn;
            $id = $data["id"]; 
            $tanggal_terima = date('Y-m-d', strtotime($data["tanggal_terima"]));
            $nomor_surat = htmlspecialchars($data["nomor_surat"]);
            $asal_surat = htmlspecialchars($data["asal_surat"]);
            $nomor_tanggal_surat = htmlspecialchars($data["nomor_tanggal_surat"]);
            $perihal = htmlspecialchars($data["perihal"]);
            $fileLama = htmlspecialchars($data["fileLama"]);

            //cek apakah user pilih file baru atau tidak
            // error 4 adalah tidak ada file yang diupload
            if ($_FILES['file_surat']['error'] === 4) {

                // gambar lama didapat dari input hidden
                $file_surat = $fileLama;
            }else {
                $file_surat = upload();
            }

            //query insert data
            $query = "UPDATE surat_masuk SET 
                    tanggal = '$tanggal_terima' , 
                    nomor_surat = '$nomor_surat' ,
                    asal_surat = '$asal_surat' ,
                    nomor_tanggal_surat = '$nomor_tanggal_surat' ,
                    perihal = '$perihal' ,
                    file_surat = '$file_surat'
                    WHERE id = $id
                    ";
            mysqli_query($conn, $query);

            //agar mengembalikan nilai 
            return mysqli_affected_rows($conn);
        }

        function cari($keyword) {
                    
            $query = "SELECT * FROM surat_masuk WHERE 
                        nomor_surat LIKE '%$keyword%' OR 
                        asal_surat LIKE '%$keyword%' OR
                        tanggal LIKE '%$keyword%' ";
            return query($query);
        }        
?>