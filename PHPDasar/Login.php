<?php 
session_start();
if (isset($_SESSION["Login"])) {
   
    header("Location: todoList.php");
    exit(); 
}
require 'function.php';

if (isset($_POST['regiss'])) {
    $_SESSION["regis"] = true;
    header("Location: register.php");
    exit();
} elseif(isset($_POST['loginbtn'])){
    Login($_POST);
}


// Tampilkan pesan jika pengguna belum memiliki akun
$register_message = "Anda Belum Mempunyai Akun ? daftar Sekarang!";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <form action="" method="post">
        <div class="container">
        <h1 >LOGIN</h1>
            <div class="grup">
                <label for="Username"> Username </label>
                <input type="text" id="username" name="username" placeholder="Username">
            </div>
            <div class="grup">
                <label for="Password"> password </label>
                <input type="text" id="password" name="password" placeholder="password">
            </div>
            <ul>
            <button type="submit" class="Loginbtn" name="loginbtn"> Login </button>   
            <p><?php echo $register_message; ?></p>
            <button class="regis" name="regiss">Daftar</button>
            
            </ul>
        </div>
    </form>

</body>
</html>
