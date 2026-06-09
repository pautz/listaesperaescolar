<?php
// Número da API do WhatsApp
$telefone_api = "5555996129682";

// Se o usuário preencher o nome, incluímos na mensagem
$usuario_nome = $_POST["nome"] ?? "Usuário não identificado";

// Mensagem automática
$mensagem = urlencode("Olá, sou $usuario_nome e gostaria de solicitar a liberação do assinantev9 de identifcacao_odonto2 para cadastro de escola e turma.");
$link_whatsapp = "https://api.whatsapp.com/send?phone=$telefone_api&text=$mensagem";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Solicitar Assinante v9</title>
    <style>
        body {font-family: Arial, sans-serif; background:#f4f6f9; text-align:center; padding:50px;}
        .card {background:#fff; padding:30px; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.1); display:inline-block;}
        h2 {color:#007BFF;}
        input {padding:10px; border:1px solid #ccc; border-radius:6px; width:80%; margin-top:10px;}
        button {margin-top:15px; padding:12px 20px; background:#25D366; color:#fff; border:none; border-radius:6px; font-size:16px; cursor:pointer;}
        button:hover {background:#128C7E;}
    </style>
</head>
<body>
    <div class="card">
        <h2>Solicitar Assinante v3</h2>
        <p>Para cadastrar escolas e turmas, é necessário ser assinante v9.</p>
        <form method="POST">
            <label>Seu nome:</label><br>
            <input type="text" name="nome" placeholder="Digite seu nome de usuario"><br>
            <button type="submit">📲 Solicitar via WhatsApp</button>
        </form>
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <p style="margin-top:20px;">
                <a href="<?= $link_whatsapp ?>" target="_blank" style="color:#25D366; font-weight:bold;">Abrir WhatsApp</a>
            </p>
        <?php endif; ?>
    </div>
</body>
</html>
