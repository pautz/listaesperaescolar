<?php
$conn = new mysqli("localhost", "usuario", "senha", "escola_db");

$sql = "SELECT a.nome, a.idade, e.nome AS escola, t.nome AS turma
        FROM alunos a
        JOIN escolas e ON a.escola_id = e.id
        JOIN turmas t ON a.turma_id = t.id";

$result = $conn->query($sql);

echo "<h2>Lista de Alunos</h2>";
echo "<table border='1'>
        <tr><th>Nome</th><th>Idade</th><th>Escola</th><th>Turma</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['nome']}</td>
            <td>{$row['idade']}</td>
            <td>{$row['escola']}</td>
            <td>{$row['turma']}</td>
          </tr>";
}
echo "</table>";
?>
