<?php
session_start();
include("../conn.php");
if (!isset($_SESSION["user_login"])) {
    header('location:login.php');
    exit();
}
$sqlCat = "SELECT * FROM cat";
$result = mysqli_query($conn, $sqlCat);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['btnCadastrar'])) {
        if (isset($_FILES['img'])) {      //Trantando a imagem no banco (extensão de arquivo)

            $ext = strtolower(substr($_FILES['img']['name'], -4)); //Pegando extensão do arquivo
            $novoNome = date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo
            chmod('../imgProdutos/', 0777);
            $dir = '../imgProdutos/'; //Diretório para uploads 
            move_uploaded_file($_FILES['img']['tmp_name'], $dir . $novoNome); //Fazer upload do arquivo
            echo ("<script>alert('Imagen enviada com sucesso!')</script>");
        }
        $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
        $descr = isset($_POST['descr']) ? $_POST['descr'] : "";
        $cat = isset($_POST['cat']) ? $_POST['cat'] : "";
        $valor = isset($_POST['valor']) ? $_POST['valor'] : "";

        $sqlInsert = "INSERT INTO `produtos`( `nome`, `descr`, `img`, `valor`, `catID`) 
        VALUES ('$nome','$descr','$novoNome','$valor','$cat')";


        if (mysqli_query($conn, $sqlInsert)) {
            echo "<script>alert('Entrada no cardapio efetuada!')</script>";
            echo "<script>location.href='inserirProdutos.php'</script>";
        } else {
            echo "Erro: " . mysqli_error($conn);
        }
    }
}


?>

<html lang="pt-br">
<?php include('headPainel.php') ?>

<body id="body-pd" class="p-0 container-fluid">
    <?php include('navPainel.php') ?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6 container-fluid px-4">
                    <h1 class="mt-5">Entrada Cardapio</h1>
                    <div class="row">
                        <form class="row g-2" method="POST" enctype="multipart/form-data">
                            <div class="">
                                <label class="form-label">Imagem</label>
                                <input type="file" name="img" accept="image/*" class="form-control border border-dark">
                            </div>
                            <div class="">
                                <label class="form-label">Nome</label>
                                <input type="text" name="nome" class="form-control border border-dark">
                            </div>
                            <div class="">
                                <label class="form-label">Descrição</label>
                                <textarea name="descr" class="form-control border border-dark" placeholder="Observação..."></textarea>
                            </div>
                            <div class="">
                            </div>
                            <div class="">
                                <label class="form-label">Categoria</label>
                                <select name="cat" class="form-select border border-dark">
                                    <?php while ($linha = mysqli_fetch_assoc($result)) { ?>
                                        <option value="<?php echo $linha['catID'] ?>"><?php echo $linha['nome'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="pb-2">
                                <label class="form-label" translate="no">Valor</label>
                                <input type="text" name="valor" class="form-control border border-dark">
                                </select>
                            </div>
                            <div class="">
                                <button type="submit" name="btnCadastrar" class="btn btn-primary">Cadastrar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
    </main>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>