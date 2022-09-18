<?php
session_start();
include("conn.php");
if (!isset($_SESSION["user_login"])) {
    header('location:login.php');
    exit();
}
$sqlCat = "SELECT * FROM cat";
$result = mysqli_query($conn, $sqlCat);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['btnCadastrar'])) {
        if (isset($_FILES['img'])) {
            $ext = strtolower(substr($_FILES['img']['name'], -4)); //Pegando extensão do arquivo
            $novoNome = date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo
            chmod('./imgProdutos/', 0777);
            $dir = './imgProdutos/'; //Diretório para uploads 
            move_uploaded_file($_FILES['img']['tmp_name'], $dir . $novoNome); //Fazer upload do arquivo
            echo ("<script>alert('Imagen enviada com sucesso!')</script>");
        }
        $nome = (isset($_POST['nome'])) ? $_POST['nome'] : "";
        $desc = isset($_POST['desc']) ? $_POST['desc'] : "";
        $cat = isset($_POST['cat']) ? $_POST['cat'] : "";
        $valor = isset($_POST['valor']) ? $_POST['valor'] : "";


        $sql = "INSERT INTO produtos (nome, desc, catID, img, valor)
        VALUES ('$nome','$desc','$cat','$novoNome','$valor')";

        $sql2 = "INSERT INTO `produtos`( `nome`, `desc`, `img`, `valor`, `catID`) 
        VALUES ('$nome','$desc','$novoNome','$valor','$cat')";


        if (mysqli_query($conn, $sql2)) {
            echo "<script>alert('Entrada no cardapio efetuada!')</script>";
            echo "<script>location.href='inserirProdutos.php'</script>";
        } else {
            echo "Erro: " . mysqli_error($conn);
        }
    }
}


?>

<html lang="pt-br">
<?php include('header.php') ?>

<body>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6 container-fluid px-4">
                    <h1 class="mt-5">Entrada Cardapio</h1>
                    <ol class="breadcrumb mb-4">
                    </ol>

                    <div class="row">
                        <form class="row g-3" method="POST" enctype="multipart/form-data">
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
                                <textarea name="desc" class="form-control border border-dark" placeholder="Observação..."></textarea>
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
</body>

</html>