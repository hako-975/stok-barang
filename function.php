<?php
	date_default_timezone_set("Asia/Jakarta");
	session_start();
	$conn = mysqli_connect("localhost", "root", "", "stok_barang");
 	
 	include_once 'script.php'; 

	function checkLogin()
	{
		global $conn;
		// jika sudah pernah login
		if (!isset($_SESSION['id_user']))
		{
		    header('Location: login.php');
		    exit;
		}
	}

	if (isset($_SESSION['id_user'])) {
		function dataUserLogin()
		{
			global $conn;

			$id_user = $_SESSION['id_user'];
		    return mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$id_user'"));
		}
	}

	function setAlert($title='', $text='', $type='', $buttons='') {
		$_SESSION["alert"]["title"]		= $title;
		$_SESSION["alert"]["text"] 		= $text;
		$_SESSION["alert"]["type"] 		= $type;
		$_SESSION["alert"]["buttons"]	= $buttons; 
	}

	if (isset($_SESSION['alert'])) {
		$title 		= $_SESSION["alert"]["title"];
		$text 		= $_SESSION["alert"]["text"];
		$type 		= $_SESSION["alert"]["type"];
		$buttons	= $_SESSION["alert"]["buttons"];

		echo"
			<div id='msg' data-title='".$title."' data-type='".$type."' data-text='".$text."' data-buttons='".$buttons."'></div>
			<script>
				let title 		= $('#msg').data('title');
				let type 		= $('#msg').data('type');
				let text 		= $('#msg').data('text');
				let buttons		= $('#msg').data('buttons');

				if(text != '' && type != '' && title != '') {
					Swal.fire({
						title: title,
						text: text,
						icon: type,
					});
				}
			</script>
		";
		unset($_SESSION["alert"]);
	}

	// [--- User ---]
	function ubahUserPassword($data) {
		global $conn;
		$dataUserLogin = dataUserLogin();
		$id_user = dataUserLogin()['id_user'];
		$password_lama = htmlspecialchars($data['password_lama']);
		if (!password_verify($password_lama, $dataUserLogin['password'])) {
			setAlert("Gagal", "Password Lama tidak sesuai", "error");
			header("Location: ubah_password.php");
			exit;
		}

		$verifikasi_password_baru = htmlspecialchars($data['verifikasi_password_baru']);
		$password_baru = htmlspecialchars($data['password_baru']);
		
		if ($password_baru != $verifikasi_password_baru) {
			setAlert("Gagal", "Password Baru tidak sesuai dengan Verifikasi Password Baru", "error");
			header("Location: ubah_password.php");
			exit;
		}

		$password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
		$query = mysqli_query($conn, "UPDATE user SET password = '$password_hash' WHERE id_user = '$id_user'");
	  	return mysqli_affected_rows($conn);
	}

	function tambahUser($data)
	{
		global $conn;
		$email = htmlspecialchars($data['email']);
		$cek_email = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");

		if (mysqli_num_rows($cek_email) > 0) {
	      	setAlert("Gagal", "Email sudah digunakan", "error");
			header("Location: user.php");
			exit;
		}

		$password = htmlspecialchars($data['password']);
		$password_hash = password_hash($password, PASSWORD_DEFAULT);

		$query = mysqli_query($conn, "INSERT INTO user VALUES ('', '$email', '$password_hash')");
	  	return mysqli_affected_rows($conn);
	}

	function ubahUser($data)
	{
		global $conn;
		$id_user = htmlspecialchars($data['id_user']);
		$email = htmlspecialchars($data['email']);
		$query = mysqli_query($conn, "UPDATE user SET email = '$email' WHERE id_user = '$id_user'");
	  	return mysqli_affected_rows($conn);
	}

	function hapusUser($id_user)
	{
		global $conn;
		$query = mysqli_query($conn, "DELETE FROM user WHERE id_user = '$id_user'");
	  	return mysqli_affected_rows($conn);
	}


	// [--- Barang ---]
	function tambahBarang($data)
	{
		global $conn;
		$nama_barang = htmlspecialchars($data['nama_barang']);
		$deskripsi = htmlspecialchars($data['deskripsi']);
		$total_stok = htmlspecialchars($data['total_stok']);
		$query = mysqli_query($conn, "INSERT INTO barang VALUES ('', '$nama_barang', '$deskripsi', '$total_stok')");
	  	return mysqli_affected_rows($conn);
	}

	function ubahBarang($data)
	{
		global $conn;
		$id_barang = htmlspecialchars($data['id_barang']);
		$nama_barang = htmlspecialchars($data['nama_barang']);
		$deskripsi = htmlspecialchars($data['deskripsi']);
		$total_stok = htmlspecialchars($data['total_stok']);
		$query = mysqli_query($conn, "UPDATE barang SET nama_barang = '$nama_barang', deskripsi = '$deskripsi', total_stok = '$total_stok' WHERE id_barang = '$id_barang'");
	  	return mysqli_affected_rows($conn);
	}

	function hapusBarang($id_barang)
	{
		global $conn;
		$query = mysqli_query($conn, "DELETE FROM barang WHERE id_barang = '$id_barang'");
	  	return mysqli_affected_rows($conn);
	}


	// [--- Barang Masuk ---]
	function tambahBarangMasuk($data)
	{
		global $conn;
		$id_barang = htmlspecialchars($data['id_barang']);
		$tanggal_masuk = htmlspecialchars($data['tanggal_masuk']);
		$keterangan = htmlspecialchars($data['keterangan']);
		$stok_masuk = htmlspecialchars($data['stok_masuk']);
		$query = mysqli_query($conn, "INSERT INTO barang_masuk VALUES ('', '$id_barang', '$tanggal_masuk', '$keterangan', '$stok_masuk')");
	  	return mysqli_affected_rows($conn);
	}

	function ubahBarangMasuk($data)
	{
		global $conn;
		$id_barang_masuk = htmlspecialchars($data['id_barang_masuk']);
		$id_barang = htmlspecialchars($data['id_barang']);
		$tanggal_masuk = htmlspecialchars($data['tanggal_masuk']);
		$keterangan = htmlspecialchars($data['keterangan']);
		$stok_masuk = htmlspecialchars($data['stok_masuk']);

		$query = mysqli_query($conn, "UPDATE barang_masuk SET id_barang = '$id_barang', tanggal_masuk = '$tanggal_masuk', keterangan = '$keterangan', stok_masuk = '$stok_masuk' WHERE id_barang_masuk = '$id_barang_masuk'");
	  	return mysqli_affected_rows($conn);
	}

	function hapusBarangMasuk($id_barang_masuk)
	{
		global $conn;
		$query = mysqli_query($conn, "DELETE FROM barang_masuk WHERE id_barang_masuk = '$id_barang_masuk'");
	  	return mysqli_affected_rows($conn);
	}

	// [--- Barang Keluar ---]
	function tambahBarangKeluar($data)
	{
		global $conn;
		$id_barang = htmlspecialchars($data['id_barang']);
		$tanggal_keluar = htmlspecialchars($data['tanggal_keluar']);
		$penerima = htmlspecialchars($data['penerima']);
		$stok_keluar = htmlspecialchars($data['stok_keluar']);
		$query = mysqli_query($conn, "INSERT INTO barang_keluar VALUES ('', '$id_barang', '$tanggal_keluar', '$penerima', '$stok_keluar')");
	  	return mysqli_affected_rows($conn);
	}

	function ubahBarangKeluar($data)
	{
		global $conn;
		$id_barang_keluar = htmlspecialchars($data['id_barang_keluar']);
		$id_barang = htmlspecialchars($data['id_barang']);
		$tanggal_keluar = htmlspecialchars($data['tanggal_keluar']);
		$penerima = htmlspecialchars($data['penerima']);
		$stok_keluar = htmlspecialchars($data['stok_keluar']);

		$query = mysqli_query($conn, "UPDATE barang_keluar SET id_barang = '$id_barang', tanggal_keluar = '$tanggal_keluar', penerima = '$penerima', stok_keluar = '$stok_keluar' WHERE id_barang_keluar = '$id_barang_keluar'");
	  	return mysqli_affected_rows($conn);
	}

	function hapusBarangKeluar($id_barang_keluar)
	{
		global $conn;
		$query = mysqli_query($conn, "DELETE FROM barang_keluar WHERE id_barang_keluar = '$id_barang_keluar'");
	  	return mysqli_affected_rows($conn);
	}
?>
