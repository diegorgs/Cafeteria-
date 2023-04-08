<?php
session_start();
include("../conn.php");
if (!isset($_SESSION["user_login"])) {
    header('location:login.php');
    exit();
}

$sqlExibir = "SELECT * FROM produtos";
$result = mysqli_query($conn, $sqlExibir);
?>

<html lang="pt-br">
<?php include('headPainel.php') ?>

<body id="body-pd" class="p-0 container-fluid">
    <?php include('navPainel.php') ?>
    <main>
        <div class="pt-5 m-5">
            <h1>Editar Cardapio</h1>
        </div>
        <div class="container g-3">
            <div class="row">
                <?php while ($linha = mysqli_fetch_assoc($result)) { ?>
                    <div class="card m-5" style="width: 18rem;">
                        <img src="../imgProdutos/<?php echo $linha['img'] ?>" style="height:200px ;" class="card-img-top" alt="...">
                        <div class="card-body" style="height: 200px;">
                            <h5 class="card-title"><?php echo $linha['nome'] ?></h5>
                            <p class="card-text"><?php echo $linha['descr'] ?></p>
                            <a href="http://localhost/rest/sistema/editar.php?id=<?php echo($linha['produtoID']); ?>" class="btn btn-success">Editar</a>
                            <button class="btn btn-danger" onclick="deletar(<?php echo $linha['produtoID'] ?>)">Excluir</button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>



    <script>
        function deletar(id) {
            let idSel = id;

            $.ajax({
                url: 'http://localhost/rest/model/deletar.php',
                method: 'POST',
                data: {
                    idSel: id
                },
                success: function(res) {
                    alert(res);
                    window.location.href = "http://localhost/rest/sistema/editarProdutos.php";
                }
            })
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>