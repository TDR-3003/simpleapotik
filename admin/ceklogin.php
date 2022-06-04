<?php 
// mengaktifkan session php
session_start();

// menghubungkan dengan database
require '../dbcon/conn_obat.php';

$username = $_POST['username'];
$password = $_POST['password'];
$hasil = NULL;

if (!empty($username)) {
	global $hasil;

	$db = new DbConnect();
	$koneksi = $db->DBConnect();

	$row = $koneksi->prepare('SELECT * FROM user WHERE username=? AND password=?');
	
	try {
		$row->execute(array($username,$password));
	 }
	 catch (PDOException $e) {
		return 'Error: ' . $e->getMessage();
	 }
	$count = $row->rowCount();

	if($count > 0){            
		$hasil = $row->fetch();
	}else{
		$gagallogin = '../login.php?status=gagal';
    	header('Location: '.$gagallogin);
	}
}

if ($hasil != NULL) {
	
	$_SESSION['username'] = $hasil['username'];
	$_SESSION['namaakun'] = $hasil['namauser'];
    $_SESSION['status'] = "login";
	$berhasilmasuk = 'index.php';
    header('Location: '.$berhasilmasuk);
	// print($_SESSION['namaakun']);
}


?>