<?php
require_once '../conexao/conexao.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $id_produto = $_POST['codigo'];
    $nome_produto = $_POST['nome_produto'];
    $detalhes = $_POST['detalhes'];
    $preco = $_POST['preco'];

    // Verifica se uma nova imagem foi enviada
    if ($_FILES['imagem']['error'] === 0) {
        $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
    } else {
        // Se não houver uma nova imagem, mantenha a imagem existente no banco de dados
        if (!empty($id_produto)) {
            $sqlImagem = "SELECT imagem FROM produtos WHERE id_produto = $id_produto";
            $resultImagem = mysqli_query($conexao, $sqlImagem);

            if ($resultImagem) {
                $produtoImagem = mysqli_fetch_assoc($resultImagem);
                $imagem = $produtoImagem['imagem'];
            } else {
                echo 'Erro na consulta SQL da imagem: ' . mysqli_error($conexao);
                exit();
            }
        } else {
            echo 'ID do produto não definido.';
            exit();
        }
    }

    // Atualiza os dados no banco de dados
    $sql = "UPDATE produtos 
            SET nome_produto = '$nome_produto', detalhes = '$detalhes', preco = '$preco', imagem = '$imagem' 
            WHERE id_produto = $id_produto";

    $resultado = mysqli_query($conexao, $sql);

    if ($resultado) {
        $_SESSION['mensagem'] = 'Produto atualizado com sucesso.';
    } else {
        $_SESSION['mensagem'] = 'Erro ao atualizar o produto.';
    }

    header('Location: editar.php'); // Redireciona de volta à página principal
    exit();
} else {
    header('Location: editar.php'); // Redireciona se o formulário não for enviado por POST
    exit();
}
?>
