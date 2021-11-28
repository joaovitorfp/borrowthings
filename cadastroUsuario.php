<?php
// Incluir arquivo de configuração
require_once "config.php";


// Defina variáveis e inicialize com valores vazios
$username = $email = $cellphone = $password = $confirm_password = "";
$username_err = $email_err = $cellphone_err = $password_err = $confirm_password_err = "";

// Processando dados do formulário quando o formulário é enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validar nome de usuário
    if (empty(trim($_POST["username"]))) {
        $username_err = "Por favor coloque seu nome completo.";
    } else {
        // Prepare uma declaração selecionada
        $sql = "SELECT id FROM users2 WHERE username = :username";

        if ($stmt = $pdo->prepare($sql)) {
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Definir parâmetros
            $param_username = trim($_POST["username"]);

            // Tente executar a declaração preparada
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $username_err = "Este nome já existe.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fechar declaração
            unset($stmt);
        }
    }
    // Validar email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Por favor coloque seu melhor e-mail.";
    } else {
        // Prepare uma declaração selecionada
        $sql = "SELECT id FROM users2 WHERE email = :email";

        if ($stmt = $pdo->prepare($sql)) {
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

            // Definir parâmetros
            $param_email = trim($_POST["email"]);

            // Tente executar a declaração preparada
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $email_err = "Este e-mail já existe.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fechar declaração
            unset($stmt);
        }
    }

    // Validar celular
    if (empty(trim($_POST["cellphone"]))) {
        $cellphone_err = "Por favor coloque um número de telefone.";
    } else {
        // Prepare uma declaração selecionada
        $sql = "SELECT id FROM users2 WHERE cellphone = :cellphone";

        if ($stmt = $pdo->prepare($sql)) {
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":cellphone", $param_cellphone, PDO::PARAM_STR);

            // Definir parâmetros
            $param_cellphone = trim($_POST["cellphone"]);

            // Tente executar a declaração preparada
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $cellphone_err = "Este telefone já foi cadastrado.";
                } else {
                    $cellphone = trim($_POST["cellphone"]);
                }
            } else {
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fechar declaração
            unset($stmt);
        }
    }


    // Validar senha
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor insira uma senha.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "A senha deve ter pelo menos 6 caracteres.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validar e confirmar a senha
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Por favor, confirme a senha.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "A senha não confere.";
        }
    }

    // Verifique os erros de entrada antes de inserir no banco de dados
    if (empty($username_err) && empty($email_err) && empty($cellphone_err) && empty($password_err) && empty($confirm_password_err)) {

        // Prepare uma declaração de inserção
        $sql = "INSERT INTO users2 (username, email, cellphone, password) VALUES (:username, :email, :cellphone, :password)";

        if ($stmt = $pdo->prepare($sql)) {
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":cellphone", $param_cellphone, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);

            // Definir parâmetros
            $param_username = $username;
            $param_email = $email;
            $param_cellphone = $cellphone;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Tente executar a declaração preparada
            if ($stmt->execute()) {
                // Redirecionar para a página de login
                header("location: loginUsuario.php");
            } else {
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fechar declaração
            unset($stmt);
        }
    }

    // Fechar conexão
    unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/cadastroUsuario.css">
</head>

<body>
    <div id="wrapper">
        <h3 class="title">Cadastro</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>Nome Completo</label>
                    <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                </div>
                <div class="form-group">
                    <label>E-mail</label>
                    <!-- <i class="far fa-envelope"></i> -->
                    <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                    <span class="invalid-feedback"><?php echo $email_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Celular</label>
                    <input type="cellphone" name="cellphone" class="form-control <?php echo (!empty($cellphone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cellphone; ?>">
                    <span class="invalid-feedback"><?php echo $cellphone_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Senha</label>
                    <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Confirme a senha</label>
                    <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="form-group">
                    <input id=button type="submit" class="btn btn-primary" value="Criar">
                </div>
                <br>
                <p><a href="loginUsuario.php">Já tenho uma conta ></a></p>
            </form>
    </div>
</body>

</html>