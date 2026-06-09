<?php
session_start();
if (!isset($_SESSION["username_odonto2"])) {
    header("Location: login.php");
    exit;
}

$conn = new mysqli("localhost", "u839226731_cztuap", "Meu6595869Trator", "u839226731_meutrator");

// Busca escolas do usuário logado, trazendo também usuario_id
$resEscolas = $conn->prepare("SELECT id, nome, usuario_id FROM escolas WHERE usuario_id = ?");
$resEscolas->bind_param("s", $_SESSION["username_odonto2"]);
$resEscolas->execute();
$escolas = $resEscolas->get_result();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $escola_id = $_POST["escola"];
    $usuario_nome = $_SESSION["username_odonto2"];

    // Verifica se o usuário é assinante v3 (campo = 1)
    $stmtCheck = $conn->prepare("SELECT assinantenv3 FROM identificacao_odonto2 WHERE username = ?");
    $stmtCheck->bind_param("s", $usuario_nome);
    $stmtCheck->execute();
    $stmtCheck->bind_result($assinante);
    $stmtCheck->fetch();
    $stmtCheck->close();

    if ((int)$assinante === 1) {
        // Só permite cadastro se for assinante v3
        $stmt = $conn->prepare("INSERT INTO turmas (nome, escola_id, usuario_id) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $nome, $escola_id, $usuario_nome);

        if ($stmt->execute()) {
            echo "<p style='color:green;'>Turma cadastrada com sucesso!</p>";
        } else {
            echo "<p style='color:red;'>Erro: " . $stmt->error . "</p>";
        }
        $stmt->close();
    } else {
        echo "<p style='color:red;'>Você não tem permissão para cadastrar turmas. Apenas assinantes v3 podem.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head><meta charset="UTF-8"><title>Cadastrar Turma</title></head>
<body>
<h2>Cadastrar Turma</h2>
<form method="POST">
    <label>Nome da Turma:</label>
    <input type="text" name="nome" required><br><br>

    <label>Escola:</label>
    <select name="escola" required>
        <option value="">Selecione</option>
        <?php while ($row = $escolas->fetch_assoc()): ?>
            <option value="<?= $row['id'] ?>">
                <?= htmlspecialchars($row['nome']) ?> - <?= htmlspecialchars($row['usuario_id']) ?> - <?= $row['id'] ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <button type="submit">Cadastrar Turma</button>
</form>
</body>
</html>
