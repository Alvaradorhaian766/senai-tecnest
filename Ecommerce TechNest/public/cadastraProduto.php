<?php
session_start();

require_once 'conexao/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter os dados do formulário
    $codigo = $_POST['codigo'];
    $nome_produto = $_POST['nome_produto'];
    $detalhes = $_POST['detalhes'];
    $preco = $_POST['preco'];
    $imagem = $_FILES['imagem'];
    $categoria = $_POST['categoria'];
    $status = $_POST['status'];

    try {
        // Verificar se o código já existe
        $verificarCodigo = "SELECT COUNT(*) FROM produtos WHERE codigo = '$codigo'";
        $resultadoVerificacao = $conexao->query($verificarCodigo);

        if ($resultadoVerificacao->fetch_row()[0] > 0) {
            // Se o código já existir, exibir mensagem de erro
            $_SESSION['erro'] = 'Código duplicado. Por favor, escolha um código único.';
        } else {
            // Se o código não existir, inserir o produto no banco de dados

            // Obter o conteúdo da imagem como uma sequência de bytes
            $imagemConteudo = !empty($imagem['tmp_name']) ? addslashes(file_get_contents($imagem['tmp_name'])) : null;

            // Consulta de inserção
            $inserirProduto = "INSERT INTO produtos (codigo, nome_produto, detalhes, preco, imagem, categoria_id, status_id)
                                VALUES ('$codigo', '$nome_produto', '$detalhes', '$preco', '$imagemConteudo', $categoria, $status)";

            // Executar a consulta de inserção
            $conexao->query($inserirProduto);

            // Se a execução foi bem-sucedida, exibir mensagem de sucesso
            $_SESSION['sucesso'] = 'Produto cadastrado com sucesso!';
        }
    } catch (mysqli_sql_exception $e) {
        // Se ocorreu um erro, exibir mensagem de erro geral
        $_SESSION['erro'] = 'Erro ao cadastrar o produto: ' . $e->getMessage();
    }

    // Redirecionar de volta para a página de cadastro
    header('Location: produto.php');
    exit();
}

// Restante do código HTML permanece o mesmo
?>
