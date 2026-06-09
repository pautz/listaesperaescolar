<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel da Escola</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <style>/* Painel */
.menu {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 30px;
    flex-wrap: wrap;
}

.menu-btn {
    display: inline-block;
    padding: 15px 25px;
    background: #007BFF;
    color: #fff;
    text-decoration: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: bold;
    transition: background 0.3s, transform 0.2s;
}

.menu-btn:hover {
    background: #0056b3;
    transform: scale(1.05);
}

/* Responsividade */
@media (max-width: 600px) {
    .menu {
        flex-direction: column;
        gap: 15px;
    }

    .menu-btn {
        width: 100%;
        text-align: center;
    }
}
</style>
<div class="container">
    <h2>Painel da Escola</h2>

    <div class="menu">
        <a href="https://carlitoslocacoes.com/escola/cadastro_escola.php" class="menu-btn">Cadastro de Escola</a>
        <a href="https://carlitoslocacoes.com/escola/cadastro_turma.php" class="menu-btn">Cadastro Turma</a>
        <a href="https://carlitoslocacoes.com/escola/cadastro_aluno.php" class="menu-btn">Cadastro de Aluno</a>
        <a href="https://carlitoslocacoes.com/escola/lista_espera.php" class="menu-btn">Lista de Espera</a>
        <a href="https://carlitoslocacoes.com/escola/solicitacaonv9.php" class="menu-btn">Solicitação NV9</a>
        <a href="https://carlitoslocacoes.com/farolqr/site/logout.php" class="menu-btn">Sair</a>
        <a href="https://github.com/pautz/escola" class="menu-btn">Código</a>
    </div>
</div>
</body>
</html>
