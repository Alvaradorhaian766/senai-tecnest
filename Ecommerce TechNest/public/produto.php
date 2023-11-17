<?php
session_start();

// Inclui o arquivo de conexão
require_once 'conexao/conexao.php';

// Consulta SQL para obter as categorias
$sqlCategorias = "SELECT id_categoria, nome_categoria FROM categoria";
$resultCategorias = $conexao->query($sqlCategorias);

// Consulta SQL para obter os status
$sqlStatus = "SELECT id_status, nome_status FROM status";
$resultStatus = $conexao->query($sqlStatus);

// Verifica se há mensagens de sucesso ou erro na sessão
if (isset($_SESSION['sucesso'])) {
    $mensagemSucesso = '<div style="color: green; text-align: center;">' . $_SESSION['sucesso'] . '</div>';
    unset($_SESSION['sucesso']); // Limpa a mensagem da sessão
}

if (isset($_SESSION['erro'])) {
    $mensagemErro = '<div style="color: red; text-align: center;">' . $_SESSION['erro'] . '</div>';
    unset($_SESSION['erro']); // Limpa a mensagem da sessão
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
    <!-- Inclui a biblioteca Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/TechNest.css">
</head>

<body>
<div class="card">
    <h1>Cadastrar Produto</h1>

    <?php
    // Exibe mensagens de sucesso ou erro dentro do card
    if (isset($mensagemSucesso)) {
        echo '<div class="mensagem-sucesso">' . $mensagemSucesso . '</div>';
    }

    if (isset($mensagemErro)) {
        echo '<div class="mensagem-erro">' . $mensagemErro . '</div>';
    }
    ?>

    <form action="cadastraProduto.php" method="post" enctype="multipart/form-data">
        <!-- Campos do produto -->
        <div class="form-group">
            <label for="codigo">Código:</label>
            <div class="input-container">
                <span class="input-icon"><i class="fas fa-barcode"></i></span>
                <input type="text" name="codigo" >
            </div>
        </div>

        <div class="form-group">
            <label for="nome_produto">Nome do Produto:</label>
            <div class="input-container">
                <span class="input-icon"><i class="fas fa-tag"></i></span>
                <input type="text" name="nome_produto" >
            </div>
        </div>

        <div class="form-group">
            <label for="detalhes">Detalhes:</label>
            <div class="input-container">
                <span class="input-icon"><i class="fas fa-info-circle"></i></span>
                <input type="text" name="detalhes" >
            </div>
        </div>

        <div class="form-group">
            <label for="preco">Preço:</label>
            <div class="input-container">
                <span class="input-icon"><i class="fas fa-dollar-sign"></i></span>
                <input type="text" name="preco" >
            </div>
        </div>

        <div class="form-group">
            <label for="imagem">Imagem:</label>
            <div class="input-container">
                <span class="input-icon"><i class="fas fa-image"></i></span>
                <input type="file" name="imagem">
            </div>
        </div>

        <!-- Seleção de Categoria -->
        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <div class="input-container">
                <span class="input-icon"><i class="fas fa-list"></i></span>
                <select name="categoria" >
                <option value="">selecione uma opçao</option>
                    <?php
                    while ($row = $resultCategorias->fetch_assoc()) {
                        echo "<option value=" . $row["id_categoria"] . ">" . $row["nome_categoria"] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <!-- Seleção de Status -->
        <div class="form-group">
            <label for="status">Status:</label>
            <div class="input-container">
                <span class="input-icon"><i class="fas fa-check"></i></span>
                <select name="status" >
                    <option value="">selecione uma opçao</option>
                    <?php
                    while ($rowStatus = $resultStatus->fetch_assoc()) {
                        echo "<option value=" . $rowStatus["id_status"] . ">" . $rowStatus["nome_status"] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <!-- Botão de envio -->
        <input type="submit" value="Cadastrar Produto">
    </form>
</div>

</body>

</html>
