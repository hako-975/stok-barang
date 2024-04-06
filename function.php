<?php
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

?>