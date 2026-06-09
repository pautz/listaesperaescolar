<?php
session_start();
if (!isset($_SESSION["username_odonto2"])) {
    header("Location: login.php");
    exit;
}

$conn = new mysqli("localhost", "u839226731_cztuap", "Meu6595869Trator", "u839226731_meutrator");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $usuario_nome = $_SESSION["username_odonto2"]; // pega o nome do usuário logado

    // Verifica se o usuário é assinante v3
    $stmtCheck = $conn->prepare("SELECT assinantenv9 FROM identificacao_odonto2 WHERE username = ?");
    $stmtCheck->bind_param("s", $usuario_nome);
    $stmtCheck->execute();
    $stmtCheck->bind_result($assinante);
    $stmtCheck->fetch();
    $stmtCheck->close();

    if ($assinante === "v3") {
        // Só permite cadastro se for assinante v3
        $stmt = $conn->prepare("INSERT INTO escolas (nome, usuario_id) VALUES (?, ?)");
        $stmt->bind_param("ss", $nome, $usuario_nome);

        if ($stmt->execute()) {
            echo "<p style='color:green;'>Escola cadastrada com sucesso!</p>";
        } else {
            echo "<p style='color:red;'>Erro: " . $stmt->error . "</p>";
        }
        $stmt->close();
    } else {
        echo "<p style='color:red;'>Você não tem permissão para cadastrar escolas. Apenas assinantes v3 podem.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head><meta charset="UTF-8"><title>Cadastrar Escola</title></head>
<body>
<h2>Cadastrar Escola</h2>
<form method="POST">
    <label>Nome da Escola:</label>
    <input type="text" name="nome" required><br><br>
    <button type="submit">Cadastrar Escola</button>
</form>
</body>
</html>
