<?php 
require_once '../conexao/conexao.php';
session_start();

// Supondo que você tenha um ID do produto a ser editado
$id_produto = isset($_GET['id_produto']) ? $_GET['id_produto'] : null;

// Consulta SQL para obter dados do produto a ser editado
$sql = "SELECT produtos.*, categoria.nome_categoria, status.nome_status 
        FROM produtos 
        LEFT JOIN categoria ON produtos.categoria_id = categoria.id_categoria
        LEFT JOIN status ON produtos.status_id = status.id_status
        WHERE produtos.id_produto = " . $id_produto;

$resultado = mysqli_query($conexao, $sql);

// Verifica se encontrou o produto
$produto = mysqli_fetch_assoc($resultado);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <style>
        
        form {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            box-sizing: border-box;
            margin: auto;
            margin-top: 50px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            user-select: none;
        }

        input, textarea {
            width: calc(100% - 16px);
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            background-color: #333;
            color: white;
            font-size: 16px;
            border: none;
            padding: 12px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            box-sizing: border-box;
        }

        button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

    <form action="editar_produto.php" method="POST" enctype="multipart/form-data">
        <h2>Editar Produto</h2>

        <label for="codigo">Código:</label>
        <input type="text" id="codigo" name="codigo" value="<?php echo $produto['codigo']; ?>" readonly>

        <label for="nome_produto">Nome do Produto:</label>
        <input type="text" id="nome_produto" name="nome_produto" value="<?php echo $produto['nome_produto']; ?>" required>

        <label for="detalhes">Detalhes:</label>
        <textarea id="detalhes" name="detalhes" rows="4" required><?php echo $produto['detalhes']; ?></textarea>

        <label for="preco">Preço:</label>
        <input type="text" id="preco" name="preco" value="<?php echo $produto['preco']; ?>" required>

        <label for="imagem">Imagem:</label>
        <input type="file" id="imagem" name="imagem" accept="image/*">

        <button type="submit">Salvar Alterações</button>
    </form>

</body>
</html>
