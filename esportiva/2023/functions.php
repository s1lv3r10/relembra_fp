<?php
require "../../config.php";
require DBAPI;
if (!isset($_SESSION)) session_start();

$id_md = $_POST['id_md'] ?? null;
$ip = $_SERVER['REMOTE_ADDR'];

if ($id_md) {
    $check = mysqli_query($conn, "SELECT * FROM curtidas WHERE id_md = $id_md AND ip_user = '$ip'");
    if (mysqli_num_rows($check) == 0) {
        mysqli_query($conn, "INSERT INTO curtidas (id_md, ip_user) VALUES ($id_md, '$ip')");
    }
}

header("Location: modalidade_volei.php");
exit;
