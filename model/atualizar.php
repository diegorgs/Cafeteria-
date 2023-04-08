<?php
include('../conn.php');
$nome = $_POST['nome'];
$descr = $_POST['descr'];
$valor = $_POST['valor'];
$catID = $_POST['catID'];





$sql = "UPDATE produtos p
SET p.nome = '$nome', p.descr = '$descr', p.valor = '$valor' , p.catID = '$catID' WHERE p.produtoID = '';";
    if (mysqli_query($conn, $sql)) {
        echo ("atualizado");
    } else {
        echo ("error");
    }