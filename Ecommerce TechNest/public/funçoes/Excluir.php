<?php
require_once("../conexao/conexao.php");
session_start();

$id_produto = filter_input(INPUT_GET, "id_produto", FILTER_SANITIZE_NUMBER_INT);

try {
    if (!empty($id_produto)) {
    

        // Excluir o registro da tabela 'produtos'
        $deletar_produtos = mysqli_query($conexao, "DELETE FROM produtos WHERE id_produto = $id_produto");

        if ($deletar_produtos) {
            $_SESSION['mensagem'] = 'Produto excluído com sucesso';
            header('Location: ../listraProdutos.php');
            exit();
        } else {
            $conexao->rollback(); // Desfazer as operações
            $_SESSION['erro'] = 'Erro ao excluir o produto na tabela produtos: ' . mysqli_error($conexao);
            header('Location: ./listraProdutos.php');
            exit();
        }
    } else {
        $_SESSION['erro'] = 'Atenção: nenhum ID de produto fornecido';
        header('Location: ./listraProdutos.php');
        exit();
    }
} catch (Exception $ex) {
    $_SESSION['erro'] = 'Erro no servidor: ' . $ex->getMessage();
    header('Location: ./listraProdutos.php');
    exit();
}
?>
