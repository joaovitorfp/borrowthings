<?php
// Incluir arquivo de configuração
require_once "config.php";

// Defina variáveis e inicialize com valores vazios
$name = $description = $condicao = "";
$name_err = $description_err = $condicao_err = "";

// Processando dados do formulário quando o formulário é enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validar nome de usuário
    if (empty(trim($_POST["name"]))) {
        $username_err = "Por favor coloque o nome do item.";
    } else {
        // Prepare uma declaração selecionada
        $sql = "SELECT id FROM item WHERE name = :name";

        if ($stmt = $pdo->prepare($sql)) {
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":name", $param_name, PDO::PARAM_STR);

            // Definir parâmetros
            $param_name = trim($_POST["name"]);

            // Tente executar a declaração preparada
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $name_err = "Este item já existe.";
                } else {
                    $name = trim($_POST["name"]);
                }
            } else {
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fechar declaração
            unset($stmt);
        }
    }
    // Validar edescriçaõ
    if (empty(trim($_POST["description"]))) {
        $description_err = "Por favor coloque uma descrição.";
    } else {
        // Prepare uma declaração selecionada
        $sql = "SELECT id FROM item WHERE description = :description";

        if ($stmt = $pdo->prepare($sql)) {
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":description", $param_description, PDO::PARAM_STR);

            // Definir parâmetros
            $param_description = trim($_POST["description"]);

            // Tente executar a declaração preparada
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $description_err = "Essa descrição de item já existe.";
                } else {
                    $description = trim($_POST["description"]);
                }
            } else {
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fechar declaração
            unset($stmt);
        }
    }

    // Validar condição
    if (empty(trim($_POST["condicao"]))) {
        $condicao_err = "Por favor coloque a condição do item";
    } else {
        // Prepare uma declaração selecionada
        $sql = "SELECT id FROM item WHERE condicao = :condicao";

        if ($stmt = $pdo->prepare($sql)) {
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":condicao", $param_condicao, PDO::PARAM_STR);

            // Definir parâmetros
            $param_condicao = trim($_POST["condicao"]);

            //Tente executar a declaração preparada
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $condicao_err = "Este condicao já foi cadastrado.";
                } else {
                    $condicao = trim($_POST["condicao"]);
                }
            } else {
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fechar declaração
            unset($stmt);
        }
    }


    // Verifique os erros de entrada antes de inserir no banco de dados
    if (empty($name_err) && empty($description_err) && empty($condicao_err)) {

        // Prepare uma declaração de inserção
        $sql = "INSERT INTO item (name, description, condicao) VALUES (:name, :description, :condicao)";

        if ($stmt = $pdo->prepare($sql)) {
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":name", $param_name, PDO::PARAM_STR);
            $stmt->bindParam(":description", $param_description, PDO::PARAM_STR);
            $stmt->bindParam(":condicao", $param_condicao, PDO::PARAM_STR);

            // Definir parâmetros
            $param_name = $name;
            $param_description = $description;
            $param_condicao = $condicao;

            // Tente executar a declaração preparada
            if ($stmt->execute()) {
                // // Redirecionar para a página de login
                // header("location: loginUsuario.php");
                echo "Item cadastrado com sucesso!";
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
    <title>CadastroItem</title>
    <link rel="stylesheet" href="css/cadastroItem.css">
</head>

<body>
    <div id="wrapper">
        <h3 class="title">Cadastre um item</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>Nome do item</label>
                    <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                    <span class="invalid-feedback"><?php echo $name_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Descrição</label>
                    <input type="text" name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $description; ?>">
                    <span class="invalid-feedback"><?php echo $description_err; ?></span>
                </div>
                <!--<div class="form-group">
                    <label>Condição (novo ou usado)</label>
                    <input type="text" name="condicao" class="form-control <?php echo (!empty($condicao_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $condicao; ?>">
                    <span class="invalid-feedback"><?php echo $condicao_err; ?></span>
                </div>-->
                <div class="form-group">
                    <input id=button type="submit" class="btn btn-primary" value="Cadastrar">
                </div>
                <br>
                <p><a href="realizarEmprestimos.php">Voltar ></a></p>
            </form>
    </div>
</body>

</html>