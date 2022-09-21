<?php
include('../conn.php');
$id = $_POST['produtoID'];

$sql = "DELETE FROM produtos WHERE produtoID = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo ("deletado");
    } else {
        echo ("error");
    }