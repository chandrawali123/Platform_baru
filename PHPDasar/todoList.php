<?php 
    session_start();
    if (!isset($_SESSION["login"])) {
        header("Location: login.php");
        exit(); 
    }
    require 'function.php';
    /*$error ='';
    $kls = 'b';
    $username = $_SESSION['login'];
    if (isset($_POST['tambah'])){
        if (!empty($_POST['todo'])){
            tambahTodo($_POST,$username);
            header("Location: todoList.php");
            exit();
        } else {
            echo "<script> 
                  alert('data harus diisi');
                  </script>";
        }
    }

    foreach ($_POST as $key => $value) {
        if (strpos($key, 'hapus') !== false) {
            $index = substr($key, strlen('hapus')); 
            hapus($_POST, $index);
        }
    }

    
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'selesai') !== false) {
            $index = substr($key, strlen('selesai')); 
            selesai($_POST, $index);
        }
    }

    
    $text = query($username);*/

    $ID = $_GET["ID"];
if (isset($_POST["tambah"])){
    tambah($ID, $_POST);
    header("Location: todoList.php?ID=$ID");
    exit;
}
if(isset($_GET["selesai"])){
  $todo = $_GET["selesai"];
  selesai($ID, $todo);
  header("Location: todoList.php?ID=$ID");
    exit;
}
if (isset($_GET["hapus"])){
  $todo = $_GET["hapus"];
  hapus($ID);
    header("Location: todoList.php?ID=$ID");
    exit;}

    // Ambil semua tugas
$todo = mysqli_query($conn, "SELECT * FROM `to do list`");


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
   
    <!-- Custom CSS -->
     <link rel="stylesheet" href="todo.css">
   
</head>
    
</head>
<body>
    <form action="" method="post">
        <div class="container">
            <div class="tambah-todo">
                <input type="text" name="todo" placeholder="To do List Anda">
                <button class="tambah" name="tambah">Tambah</button>
            </div>
           
           
            <?php   
           $login_result = mysqli_query($conn, "SELECT * FROM `to do list` WHERE User_id = '$ID'");
             while ($row = mysqli_fetch_assoc($login_result)){ 
                $row2 = $row["Kegiatan"];
                ?>
                <div class="show-todo">
                    <?php if ($row['Status'] == 'Selesai'): ?>
                        <s><?php echo $row['Kegiatan']; ?></s>
                    <?php else: ?>
                        <?php echo $row['Kegiatan']; ?>


                    <?php endif;
                   
                    echo '
                    <button class="tambah" name="selesai"><a href="todoList.php?ID=$ID&selesai=$Kegiatan">Selesai</a></button>
                    <button class="tambah" name="hapus">Hapus</button>';?>
                    <input type="hidden" name="index" value="">
                   
                </div>
            <?php } ?>
            <p>Klik tombol di samping untuk Keluar!    <a href="logout.php">Logout</a>
        </div>
       
    </form>
    
    
  
</body>
</html>
