<?php 
session_start();
session_unset();
include('conn.php');
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

<?php include('header.php') ?>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg navbar-togglable fixed-top">
        <div class="container">

            <!-- Navbar brand (mobile) -->
            <a class="navbar-brand d-lg-none text-dark" href="/index.php">Coffee Aquarius</a>

            <!-- Navbar toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar collapse -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <!-- Navbar brand -->
                <a class="navbar-brand d-none d-lg-flex mx-lg-auto text-dark" href="#">
                    Coffee Aquarius
                </a>
                <!-- Navbar nav -->
            </div>
        </div>
    </nav>

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

                                                    <label class="form-label text-dark"><h6>Usuario</h6></label>
                                                    <input type="text" name="usuario" id="usuario" class="form-control border border-dark">

                                                    <label class="form-label text-dark mt-4"><h6>Senha</h6></label>
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






</body>

</html>