<?php

//Koneksi ke Database
$db = mysqli_connect("localhost","root","","MBKM");

//Query
function query($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $db;
    //ambil data tiap elemen
    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);

    //Ambil Upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    //query insert data
    
    $query = "INSERT INTO mahasiswa
                VALUES
                ('', '$nama', '$nim', '$email', '$jurusan', '$gambar')
                ";
    mysqli_query($db, $query); 
    return mysqli_affected_rows($db);
}

function upload()
{
    $namafile = $_FILES['gambar']['name'];
    $ukuranfile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpname = $_FILES['gambar']['tmp_name'];

    //Cek Upload Gambar
    if ($error === 4) {
        echo "<script>alert('Pilih gambar Dahulu');</script>";
        return false;
    }

    //Yang Upload hanya gambar
    $ekstensivalid = ['jpg','jpeg','png'];
    $ekstensi = explode('.',$namafile);
    $ekstensi = strtolower(end($ekstensi));

    if (!in_array($ekstensi, $ekstensivalid)) {
        echo "<script>alert('Pilih Format yang tepat');</script>";
        return false;
    }

    //Cek Ukuran Gambar
    if ($ukuranfile > 1000000) {
        echo "<script>alert('Ukuran Terlalu Besar');</script>";
        return false;
    }
    //Generate nama Baru
    $namabaru = uniqid();
    $namabaru .= '.';
    $namabaru .= $ekstensi;

    //Lolos Pengecekan
    move_uploaded_file($tmpname, 'img/'.$namabaru);
    return $namabaru;
}

function hapus($id)
{
    global $db;
    mysqli_query($db, "DELETE FROM mahasiswa WHERE id = $id");
    return mysqli_affected_rows($db);
}

function ubah($dataubah)
{
    global $db;
    $id = $_POST["id"];
    //ambil data tiap elemen
    $nim = htmlspecialchars($dataubah["nim"]);
    $nama = htmlspecialchars($dataubah["nama"]);
    $email = htmlspecialchars($dataubah["email"]);
    $jurusan = htmlspecialchars($dataubah["jurusan"]);
    $gambarlama = htmlspecialchars($dataubah["gambarlama"]);

    //Cek Pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarlama;
    }
    else {
        $gambar = upload();
    }

    $query = "UPDATE mahasiswa SET
                nama = '$nama', 
                nim = '$nim', 
                email = '$email', 
                jurusan = '$jurusan', 
                gambar = '$gambar'
                WHERE id = $id
                ";
    mysqli_query($db, $query); 

    return mysqli_affected_rows($db);

}

function cari($keyword)
{
    $query = "SELECT * FROM mahasiswa WHERE 
    nama LIKE '%$keyword%' OR
    nim LIKE '%$keyword%' OR
    email LIKE '%$keyword%' OR
    jurusan LIKE '%$keyword%'
    ";
    return query($query);
}

function registrasi($databaru)
{
    global $db;
    $username = strtolower(stripslashes($databaru["username"]));
    $password = mysqli_real_escape_string($db, $databaru["password"]);
    $password2 = mysqli_real_escape_string($db, $databaru["password2"]);

    //Cek username
    $result = mysqli_query($db, "SELECT username FROM users WHERE username = '$username'");
    if(mysqli_fetch_assoc($result))
    {
        echo "<script>alert('Username sudah terdaftar')</script>";
        return false;
    }
    //Cek Konfirmasi pass
    if ($password !== $password2) {
        echo "<script>
        alert('Kondirmasi Password Tidak Sesuai')</script>"
        ;
        return false;
    }

    //Enkripsi Password
    $password = password_hash($password, PASSWORD_DEFAULT);
    //tambah user ke db
    mysqli_query($db, "INSERT INTO users VALUES('', '$username', '$password')");
    return mysqli_affected_rows($db);
}   
?>