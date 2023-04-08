<?php
session_start();
include("../conn.php");
if (!isset($_SESSION["user_login"])) {
    header('location:login.php');
    exit();
}
?>
<html lang="pt-br">
<?php include('headPainel.php') ?>

<body class="container-fluid p-0">
    <!--Menu-->
    <?php include('navPainel.php')?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>