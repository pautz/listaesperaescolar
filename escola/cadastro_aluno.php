<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

$conn = new mysqli("localhost", "u839226731_cztuap", "Meu6595869Trator", "u839226731_meutrator");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome       = $_POST["nome"];
    $nascimento = $_POST["nascimento"];
    $cpf        = $_POST["cpf"];
    $telefone   = $_POST["telefone"];
    $turma_id   = $_POST["turma"];

    // Busca a escola vinculada à turma
    $stmtEscola = $conn->prepare("SELECT escola_id FROM turmas WHERE id = ?");
    $stmtEscola->bind_param("i", $turma_id);
    $stmtEscola->execute();
    $stmtEscola->bind_result($escola_id);
    $stmtEscola->fetch();
    $stmtEscola->close();

    // Insere o aluno com telefone
    $stmt = $conn->prepare("INSERT INTO alunos (nome, data_nascimento, cpf, telefone, turma_id, escola_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssii", $nome, $nascimento, $cpf, $telefone, $turma_id, $escola_id);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Aluno cadastrado com sucesso!</p>";
    } else {
        echo "<p style='color:red;'>Erro: " . $stmt->error . "</p>";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Cadastrar Aluno</title>
<script>
// Carregar turmas dinamicamente com base na escola
function carregarTurmas(escolaId) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "get_turmas.php?escola_id=" + escolaId, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById("turma").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
</script>
</head>
<body>
<h2>Cadastrar Aluno</h2>
<form method="POST">
    <label>Nome:</label>
    <input type="text" name="nome" required><br><br>

    <label>Data de Nascimento:</label>
    <input type="date" name="nascimento" required><br><br>

    <label>CPF:</label>
    <input type="text" name="cpf" required><br><br>

    <label>Telefone:</label>
    <input type="text" name="telefone" required><br><br>

    <label>Escola:</label>
    <select name="escola" onchange="carregarTurmas(this.value)" required>
        <option value="">Selecione</option>
        <?php
        $resEscolas = $conn->query("SELECT id, nome FROM escolas");
        while ($row = $resEscolas->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['nome']}</option>";
        }
        ?>
    </select><br><br>

    <label>Turma:</label>
    <select name="turma" id="turma" required>
        <option value="">Selecione a escola primeiro</option>
    </select><br><br>

    <button type="submit">Cadastrar Aluno</button>
</form>
</body>
</html>
