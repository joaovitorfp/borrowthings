<?php
// Inicialize a sessão
session_start();
include_once('config.php');


// Verifique se o usuário está logado, se não, redirecione-o para uma página de login
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: loginUsuario.php");
    exit;
}



//$sql = "SELECT * FROM item ORDER BY id DESC";

//$result = $conexao->query($sql);


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/telaInicial.css">
    <title>Tela Inicial</title>
</head>

<body>

    <!-- <h1 class="my-5">Oi, <b>?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Bem vindo ao nosso site.</h1>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Redefina sua senha</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sair da conta</a>
    </p> -->
    <div class="banner">
        <div class="page">
            <h1 class="title">BORROW THINGS</h1>
            <ul>
                <li><a href="">Conta</a></li>
                <li><a href="cadastroItem.php">Cadastrar item</a></li>
                <li><a href="realizarEmprestimos.php">Realizar Empréstimo</a></li>
                <li><a href="logout.php">Sair</a></li>
            </ul>
        </div>
        <div class="table">
            <table class="table" style="height: 10px" width="85%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Item</th>
                        <th scope="col">Data do empréstimo</th>
                        <th scope="col">Data da devolução</th>
                        <th scope="col">Nome do destinatário</th>
                        <th scope="col">Contato do destinatário</th>
                        <th scope="col">Devolver</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //while ($user_data = mysqli_fetch_assoc($result)) {
                    // echo "<tr>";
                    // echo "<td>" . $user_data['Item'] . "</td>";
                    // echo "<td>" . $user_data['Data do empréstimo'] . "</td>";
                    // echo "<td>" . $user_data['Data da devolução'] . "</td>";
                    // echo "<td>" . $user_data['Nome do destinatário'] . "</td>";
                    // echo "<td>" . $user_data['Contato do destinatário'] . "</td>";
                    //echo "<td>" . $user_data['Devolver'] . "</td>";
                    //echo "</tr>";
                    //}
                    ?>
                </tbody>
            </table>
        </div>
    </div>


</body>

</html>