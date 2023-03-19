    <?php
    session_start();

    require 'functions.php';
    //cek cookie
        if(isset($_COOKIE['num']) && isset($_COOKIE['key'])) {
            $id = $_COOKIE['num'];
            $key = $_COOKIE['key'];
            //ambli username berdasarkan id
            $result = mysqli_query($conn, "SELECT username FROM users WHERE id = '$id' ");
            $row = mysqli_fetch_assoc($result);
            //cek cookie dan username
            if($key === hash('sha256', $row['username'])) {
                $_SESSION['login'] = true;
            }
        }
    //cek session
    if(isset($_SESSION['login'])) {
        header("Location: index.php");
        exit;
    }
    

    //cek apakah tombol login sudah ditekan atau belum
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

        //cek username
        if (mysqli_num_rows($result) === 1) {
            //cek password
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                //set session
                $_SESSION['login'] = true;
                //cek remember me
                if (isset($_POST['remember'])) {
                    //buat cookie
                    setcookie('num', $row['id'], time()+60);
                    setcookie('key', hash('sha256', $row['$username']), time()+60);
                    setcookie('pwsni', hash('sha256', $row['id'].$row['username'].$row['password']), time()+60);

                }
                

                header("Location: index.php");
                exit;
            }
        }
        $error = true;        
    }
?>
<!DOCTYPE html>
<html style="min-height: 100vh;" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- <link rel="stylesheet" href="../styles/sidebar.css"> -->
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="../assets/img/logo_siapwolu.png">
</head>
<body>
    <div class="overflow-hidden">
        <div class="row vh-100">
            <div class="d-flex justify-content-center col-md-8 col-sm-4">
                <img class="mx-auto" src="../assets/img/login.jpg" alt="login">   
            </div>
            <div class="d-flex justify-content-center align-items-center  col-md-4 col-sm-4 bg-primary text-light">
                <form class="card border-0 rounded-3 h-50" style="width: 25rem;" action="" method="post">
                    <ul class="card-body text-black">
                    <h1 class="card-title">Login</h1>
                        <li>
                            <label class="form-label" for="username">Username</label>
                            <input class="form-control" type="text" name="username" id="username">
                        </li>
                        <li>
                            <label class="form-label" for="password">Password</label>
                            <input class="form-control" type="password" name="password" id="password">
                        </li> 
                        <li class="p-0">
                            <input class="d-inline" type="checkbox" name="remember" id="remember">
                        <label class="form-label" for="remember">Remember me</label>
                        </li >
                        <?php if(isset($error)) : ?>
                            <p class="text-danger fst-italic fw-semibold">
                                Username / Password salah
                            </p>
                        <?php endif; ?>
                        <br>
                        <button class="btn btn-primary" type="submit" name="login">
                            Login
                        </button>
                    </ul>
                </form>
            </div>
        </div>
    </div>
    <script src="../script.js"></script>
    <!-- script popper js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
            AOS.init();
    </script>
</body>
</html>