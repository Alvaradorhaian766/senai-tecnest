<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$bancoDeDados = "tecnest";

try {
    // Cria uma nova conexão
    $conexao = new mysqli($servidor, $usuario, $senha, $bancoDeDados);

    // Verifica a conexão
    if ($conexao->connect_error) {
        throw new Exception("Erro na conexão: " . $conexao->connect_error);
    }

    // Define o conjunto de caracteres para UTF-8 (opcional)
    $conexao->set_charset("utf8");

    // Consulta SQL para obter as categorias
    $sql = "SELECT id_categoria, nome_categoria FROM categoria";
    $result = $conexao->query($sql);

    // Se necessário, você pode imprimir uma mensagem indicando a conexão bem-sucedida
    // echo "Conexão estabelecida com sucesso!";
} catch (Exception $e) {
    // Captura exceções e imprime uma mensagem de erro
    die("Erro: " . $e->getMessage());
}
?>
