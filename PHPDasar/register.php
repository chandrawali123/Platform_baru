<?php 
    require 'function.php';
   
    session_start();
    if (!isset($_SESSION["regis"])) {
        header("Location: login.php");
        exit(); 
    }

    if(isset($_POST['submitbtn'])){
        if(tambahAkun($_POST)){
            echo "<script>
            alert('User baru berhasil ditambahkan!');
            window.location.href = 'login.php'; // Redirect to login page
            </script>";
        } else {
           echo mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DAFTAR</title>
    <link href="register.css" rel="stylesheet">
</head>
<body>
   
    <div class="container">
    <h1  class="text-center">REGISTRASI</h1>
        <form action="" method="post">   
            <label for="name">Nama</label>
            <input type="text" name="nama" placeholder="Username">  
            <label for="password1">Password</label>
            <input type="password" name="password1" placeholder="Password"> 
            <label for="password2">Konfirmasi Password</label>
            <input type="password" name="password2" placeholder="Konfirmasi Password">
            <button type="submit" class="submitbtn" name="submitbtn">Submit</button>
            <p>Sudah punya akun? Silahkan Login. <a href="login.php">Login</a></p> <!-- Link to login page -->
        </form>
    </div>
    
</body>
</html>
