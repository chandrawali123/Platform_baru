<?php

// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
function Login($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);

    $result = mysqli_query($conn, "SELECT * FROM login WHERE Username = '$username'");
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["Password"])) {
            $_SESSION["login"] = true;
            $id = $row['ID'];
            header("Location: todoList.php?ID=$id");
            exit();
        } else {
            echo "<script>alert('Password salah');</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan, pastikan Anda memasukkan username dengan benar');</script>";
    }
}


function tambahAkun($data){
    global $conn;
    $nama = htmlspecialchars($data['nama']);
    $password1 = mysqli_real_escape_string($conn, $data['password1']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);

    // Cek apakah password1 sama dengan password2
    if ($password1 !== $password2) {
        echo "<script>alert('Konfirmasi password tidak sesuai');</script>";
        return;
    }

    // Cek apakah username sudah ada di database
    $query = "SELECT Username from login WHERE Username = '$nama'";
    $hasil = mysqli_query($conn, $query);
    if(mysqli_fetch_assoc($hasil)){
        echo "<script>alert('Username sudah digunakan');</script>";
        return;
    }
    
    // Enkripsi password sebelum disimpan ke database
    $password = password_hash($password1, PASSWORD_DEFAULT);
    
    // Insert data ke database
    $query = "INSERT INTO login (Username, Password) VALUES ('$nama', '$password')";
    if(mysqli_query($conn, $query)){
        echo "<script>alert('Akun berhasil dibuat');</script>";
    } else{
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}


function tambah($ID, $data){
    global $conn;
    $activity = $data["todo"];
    mysqli_query($conn,"INSERT INTO `to do list` VALUES ('', '$ID', '$activity', 'no')");

}

function query($username){
    global $conn;
    $query = "SELECT ID, Kegiatan, Status 
              FROM `to do list` 
              WHERE User_id IN (SELECT ID FROM login WHERE Username = '$username')";
    $hasil = mysqli_query($conn, $query);
    $datas = [];
    while ($row = mysqli_fetch_assoc($hasil)){
        $datas[] = $row;
    }
    return $datas;
}

function hapus($index){
    global $conn;
    mysqli_query($conn,"DELETE FROM `to do list` WHERE ID = $index");
    return mysqli_affected_rows($conn);
  /*  $query = "DELETE FROM `to do list` WHERE ID = '$id'";
    mysqli_query($conn, $query);*/
}

function selesai($index, $todo){
    global $conn;
    $query = "UPDATE `to do list` SET `Status` = 'Selesai' WHERE `User_id` = $index AND `Kegiatan` = '$todo'";
    //  mysqli_query($conn, $query);
   return mysqli_affected_rows($conn);
  //  $query = "UPDATE `to do list` SET Status = 'selesai' WHERE ID = '$id'";
    //mysqli_query($conn, $query);
}


?>
