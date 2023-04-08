<?php
session_start();
include("../conn.php");
if (!isset($_SESSION["user_login"])) {
    header('location:login.php');
    exit();
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sqlExibir ="SELECT * FROM produtos WHERE produtoID = '$id'";
    $exibir = mysqli_query($conn, $sqlExibir);

    if (isset($_GET['btnAtualizar'])) {

        if (isset($_FILES['img'])) {      //Trantando a imagem no banco (extensão de arquivo)

            $ext = strtolower(substr($_FILES['img']['name'], -4)); //Pegando extensão do arquivo
            $novoNome = date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo
            chmod('../imgProdutos/', 0777);
            $dir = '../imgProdutos/'; //Diretório para uploads 
            move_uploaded_file($_FILES['img']['tmp_name'], $dir . $novoNome); //Fazer upload do arquivo
            echo ("<script>alert('Imagen enviada com sucesso!')</script>");
        }
        $nome = isset($_GET['nome']) ? $_GET['nome'] : "";
        $descr = isset($_GET['descr']) ? $_GET['descr'] : "";
        $catID = isset($_GET['cat']) ? $_GET['cat'] : "";
        $valor = isset($_GET['valor']) ? $_GET['valor'] : "";

        $sql = "UPDATE produtos p
        SET p.nome = '$nome', p.descr = '$descr', p.valor = '$valor' , p.catID = '$catID' WHERE p.produtoID = '$id';";
        if (mysqli_query($conn, $sql)) {
            echo ("<script>alert('atualizado')</script>");
            header('location:editarProdutos.php');
        } else {
            echo ("error");
        }
    }
} else {
    header('location:editarProdutos.php');
}
$sqlCat = "SELECT * FROM cat";
$result = mysqli_query($conn, $sqlCat);



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
                    <h1 class="mt-5">Atualizar item</h1>
                    <div class="row">
                        <form class="row g-2" method="GET" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <?php while($i = mysqli_fetch_assoc($exibir)){ ?>
                            <div class="">
                                <label class="form-label">Imagem</label>
                                <input type="file" name="img" accept="image/*"  class="form-control border border-dark">
                            </div>
                            <div class="">
                                <label class="form-label">Nome</label>
                                <input type="text" name="nome" value="<?php echo $i['nome'] ?>" class="form-control border border-dark">
                            </div>
                            <div class="">
                                <label class="form-label">Descrição</label>
                                <textarea name="descr" value="<?php echo $i['descr'] ?>" class="form-control border border-dark" placeholder="Observação..."></textarea>
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
                                <input type="decimal" name="valor" value="<?php echo $i['valor'] ?>" class="form-control border border-dark">
                                </select>
                            </div>
                            <?php } ?>
                            <div class="">
                                <button type="submit" name="btnAtualizar" class="btn btn-primary">Atualizar</button>
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