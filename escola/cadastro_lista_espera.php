<?php
$conn = new mysqli("localhost", "u839226731_cztuap", "Meu6595869Trator", "u839226731_meutrator");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome      = $_POST['nome'];
    $cpf       = $_POST['cpf'];
    $telefone  = $_POST['telefone'];
    $escola_id = $_POST['escola'];
    $turma_id  = $_POST['turma'];

    // Usando prepared statement para segurança
    $stmt = $conn->prepare("INSERT INTO lista_espera (nome, cpf, telefone, escola_id, turma_id, data_cadastro) 
                            VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("sssii", $nome, $cpf, $telefone, $escola_id, $turma_id);

    if ($stmt->execute()) {
        echo "<p class='success'>Aluno cadastrado na lista de espera com sucesso!</p>";
    } else {
        echo "<p class='error'>Erro ao cadastrar: " . $stmt->error . "</p>";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro Lista de Espera</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007BFF;
        }

        .form-cadastro {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-cadastro label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-cadastro input,
        .form-cadastro select,
        .form-cadastro button {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
            width: 100%;
            box-sizing: border-box;
        }

        .form-cadastro button {
            background: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }

        .form-cadastro button:hover {
            background: #0056b3;
        }

        .success {
            color: green;
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
        }

        .error {
            color: red;
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            h2 {
                font-size: 22px;
            }

            .form-cadastro input,
            .form-cadastro select,
            .form-cadastro button {
                font-size: 14px;
                padding: 10px;
            }
        }

        @media (max-width: 480px) {
            h2 {
                font-size: 20px;
            }

            .container {
                margin: 15px;
                padding: 12px;
            }

            .form-cadastro input,
            .form-cadastro select,
            .form-cadastro button {
                font-size: 13px;
                padding: 8px;
            }

            .form-cadastro label {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cadastrar na Lista de Espera</h2>

        <form method="POST" class="form-cadastro">
            <label>Nome:</label>
            <input type="text" name="nome" required>

            <label>CPF:</label>
            <input type="text" name="cpf" required 
                   placeholder="000.000.000-00" 
                   pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">

            <label>Telefone:</label>
           <input type="tel" name="telefone" required
       placeholder="(00) 00000-0000"
       pattern="\(\d{2}\)\s\d{5}-\d{4}">

            <label>Escola:</label>
            <select name="escola" required>
                <option value="">Selecione</option>
                <?php
                $resEscolas = $conn->query("SELECT * FROM escolas");
                while ($row = $resEscolas->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['nome']}</option>";
                }
                ?>
            </select>

            <label>Turma:</label>
            <select name="turma" required>
                <option value="">Selecione</option>
                <?php
                $resTurmas = $conn->query("SELECT * FROM turmas");
                while ($row = $resTurmas->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['nome']}</option>";
                }
                ?>
            </select>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>
