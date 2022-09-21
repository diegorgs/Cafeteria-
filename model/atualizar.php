<?php
include('../conn.php');
$nome = $_POST['nome'];
$desc = $_POST['desc'];
$valor = $_POST['valor'];
$catID = $_POST['catID'];





$sql = "UPDATE produtos p
SET p.nome = '$nome', p.desc = '$desc', p.valor = '$valor' , p.catID = '$catID' WHERE p.produtoID = '';";
    if (mysqli_query($conn, $sql)) {
        echo ("atualizado");
    } else {
        echo ("error");
    }