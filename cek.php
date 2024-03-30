<?php
// jika sudah pernah login
if (!isset($_SESSION['id_user']))
{
    header('Location: login.php');
    exit;
}
else
{
    $id_user = $_SESSION['id_user'];
    $dataUserLogin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$id_user'"));
}