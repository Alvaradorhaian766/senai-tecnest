<?php 
require_once '../public/conexao/conexao.php';
session_start();
// Consulta SQL para obter dados da tabela "produtos"
$resultado = mysqli_query($conexao, "SELECT produtos.*, categoria.nome_categoria, status.nome_status 
FROM produtos 
LEFT JOIN categoria ON produtos.categoria_id = categoria.id_categoria
LEFT JOIN status ON produtos.status_id = status.id_status");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('../Imagens/banner.png');
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
            user-select: none; /* Impede a seleção de texto */
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        img {
            max-width: 50px;
            max-height: 50px;
            display: block;
            margin: auto;
            pointer-events: none; /* Impede eventos do mouse na imagem */
        }

        .tools {
            display: flex;
            justify-content: space-around;
        }

        .editar, .delete, .ativar, .desativar {
            text-decoration: none;
            color: #333;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .editar:hover, .delete:hover, .ativar:hover, .desativar:hover {
            background-color: #ddd;
        }

        .ativar {
            background-color: #4CAF50;
            color:blue;
        }

        .desativar {
            background-color: #e53935;
            color: white;
        }
        .status{
            color: #4CAF50;
        }
        .inativo {
            color: red;
        }
    </style>
</head>
<body>

    <div>
        <h2>Lista de Produtos</h2>

        <table>
            <thead>
                <tr>
                    <th>ID do Produto</th>
                    <th>Código</th>
                    <th>Nome do Produto</th>
                    <th>Detalhes</th>
                    <th>Preço</th>
                    <th>Imagem</th>
                    <th>Categoria ID</th>
                    <th>Status ID</th>
                    <th>Ferramentas</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($linha = mysqli_fetch_assoc($resultado)) : ?>
                        <tr>
                            <td><?= $linha['id_produto'] ?></td>
                            <td><?= $linha['codigo'] ?></td>
                            <td><?= $linha['nome_produto'] ?></td>
                            <td><?= $linha['detalhes'] ?></td>
                            <td>R$ <?= $linha['preco'] ?></td>
                            <td><img src='data:image/jpeg;base64,<?= base64_encode($linha['imagem']) ?>' alt='Imagem <?= $linha['nome_produto'] ?>' style='max-width: 50px;'></td>
                            <td><?= $linha['nome_categoria'] ?></td>
                            <td class="status <?= ($linha['status_id'] != 1) ? 'inativo' : '' ?>"><?= $linha['nome_status'] ?></td>
                            <td class="tools">
                                <a class="delete" href="funçoes/Excluir.php?id_produto=<?= $linha['id_produto'] ?>">Excluir</a>
                                <a class="delete" href="funçoes/editar.php?id_produto=<?= $linha['id_produto'] ?>">editar</a>
                                <?php
                                    $acao = ($linha['status_id'] == 1) ? 'desativar' : 'ativar';
                                    $novoStatus = ($linha['status_id'] == 1) ? 2 : 1;
                                    echo "<a class='$acao' href='funçoes/funçao.php?id_produto={$linha['id_produto']}&novo_status=$novoStatus'>$acao</a>";
                                ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                
                <!-- Adicione mais linhas conforme necessário -->
            </tbody>
        </table>
    </div>

</body>
</html>
