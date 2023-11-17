<?php
require_once '../conexao/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_produto'])) {
    $idProduto = $_GET['id_produto'];

    // Consulta para obter o status atual do produto
    $consultaStatus = mysqli_query($conexao, "SELECT status_id FROM produtos WHERE id_produto = $idProduto");

    if ($consultaStatus) {
        $dadosProduto = mysqli_fetch_assoc($consultaStatus);
        $novoStatus = ($dadosProduto['status_id'] == 1) ? 2 : 1;

        // Atualizar o status do produto
        $atualizarStatus = mysqli_query($conexao, "UPDATE produtos SET status_id = $novoStatus WHERE id_produto = $idProduto");

        if ($atualizarStatus) {
            header("Location: ../listraProdutos.php");
            exit;
        }
    }
}

header("Location: ../listraProdutos.php");
exit;
?>
