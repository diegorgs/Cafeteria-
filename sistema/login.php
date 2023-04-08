<?php
session_start();
session_unset();
include('../conn.php');
$usuario = "";
$mensagem = "";
if ($_SERVER["REQUEST_METHOD"] = "POST") {
    if (isset($_POST["senha"])) {
        $senha = $_POST["senha"];
        $usuario = $_POST["usuario"];

        $sql = "SELECT usuario,
                usuarioID,
                case when senha = '$senha' then 1 ELSE 0 END AS status
                FROM administrador 
                WHERE usuario = '$usuario'";

        $tabela = (mysqli_query($conn, $sql));
        $retorno = (mysqli_num_rows($tabela));
        if ($retorno == 0) {
            $mensagem = ("<div class='alert alert-warning my-2 p-1'> Usuário inválido </div>");
        } else {
            $linha = mysqli_fetch_assoc($tabela);
            if ($linha["status"] == 0) {
                $mensagem = ('<div class="alert alert-danger text-dark fw-bold my-2 p-1">Senha incorreta.</div>');
            } else {
                $_SESSION["user_id"] = $linha["usuarioID"];
                $_SESSION["user_login"] = $linha["usuario"];
                header('location:inserirProdutos.php');
            }
        }
    }
}



?>

<html lang="pt-br">

<?php include('headPainel.php') ?>

<body>
    <!--Login-->

    <section id="inserir">
        <div class="">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4 pt-5 mt-5">
                        <div class="container">
                            <!--Form -->
                            <form method="POST">
                                <div class="row">
                                    <div class="col-lg-4">
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="py-2 rounded-3">
                                            <div class="pb-5 ">
                                                <div class="container mt-5 text-dark">
                                                    <h1 class="mt-5 text-center">Adm Acess</h1>

                                                    <label class="form-label text-dark">
                                                        <h6>Usuario</h6>
                                                    </label>
                                                    <input type="text" name="usuario" id="usuario" class="form-control border border-dark">

                                                    <label class="form-label text-dark mt-4">
                                                        <h6>Senha</h6>
                                                    </label>
                                                    <input type="password" name="senha" id="senha" class="border border-dark form-control">
                                                    <?php echo $mensagem ?>
                                                    <button type="submit" name="btnCadastrar" class="rounded btn-primary btn p-3 mt-4">Entrar</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </main>
            </div>
    </section>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>