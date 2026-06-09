<?php
$conn = new mysqli("localhost", "u839226731_cztuap", "Meu6595869Trator", "u839226731_meutrator");

$escola_id = $_GET["escola_id"] ?? 0;

$resTurmas = $conn->prepare("SELECT id, nome FROM turmas WHERE escola_id = ?");
$resTurmas->bind_param("i", $escola_id);
$resTurmas->execute();
$result = $resTurmas->get_result();

while ($row = $result->fetch_assoc()) {
    echo "<option value='{$row['id']}'>{$row['nome']}</option>";
}
?>
