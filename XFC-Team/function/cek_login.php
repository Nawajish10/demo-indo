<?php  
session_start();
include '../../function/connect.php';


$username = $_POST['username'];
$password = md5($_POST['password']);

$login = mysqli_query($koneksi,"select * from tb_admin where username='$username' and password='$password'");
$cek = mysqli_num_rows($login);

if($cek > 0){
    $data = mysqli_fetch_assoc($login);
	$_SESSION['username'] = $username;
	$_SESSION['status'] = "login";
	$_SESSION['level'] = $data['level'];
	header("location:../template/index.php");
    exit();
}else{
	header("location:../index.php");	
    exit();
}
?>