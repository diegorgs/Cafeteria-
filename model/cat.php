<?php
header('Content-Type: application/json');
include('../conn.php');


$cat = 1;
if (isset($_GET['id'])) {
  $cat = $_GET['id'];
}

$sql = "SELECT * FROM produtos WHERE catID = '$cat'";
$result = mysqli_query($conn, $sql);
$dados = [];
while($linha = mysqli_fetch_assoc($result)){
    array_push($dados, $linha);

}


//echo var_dump($dados);

echo json_encode($dados);

/*if(mysqli_query($conn, $sql)){
    echo json_encode('');
}else{
    echo json_encode("404" . mysqli_error($conn));
}*/

?>