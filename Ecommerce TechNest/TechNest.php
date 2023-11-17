<?php 
require_once 'public/conexao/conexao.php';
session_start();

// Consulta SQL para obter dados da tabela "produtos"
$resultado = mysqli_query($conexao, "SELECT produtos.*, categoria.nome_categoria, status.nome_status 
FROM produtos 
LEFT JOIN categoria ON produtos.categoria_id = categoria.id_categoria
LEFT JOIN status ON produtos.status_id = status.id_status");

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>TechNest</title>
    <link rel="stylesheet" href="css/TechNest.css">
</head>

<body>
    <header>
        <div class="header-logo">
            <img src="Imagens/logo transparente.png" alt="Logo TechNest">
        </div>
        <div class="header-title">
            <h2>TechNest</h2>
        </div>
        <nav>
            <a href="#">Produtos Recomendados</a>
            <a href="#">Produtos</a>
            <a href="#">Cadastro</a>
        </nav>
    </header>

    <!-- Banner da página -->
    <section class="banner">
        <img src="Imagens/banner.png">
    </section>

    <!-- Lista de produtos -->
    <!-- Início do Loop para exibir os produtos -->
    <div class="product-section">
        <?php while ($linha = mysqli_fetch_assoc($resultado)) : ?>
        <?php if ($linha['status_id'] == 1) : ?>
        <div class="product-card">
            <img src="data:image/jpeg;base64,<?= base64_encode($linha['imagem']); ?>"
                alt="<?php echo $linha['nome_produto']; ?>">
            <h2>
                <?php echo $linha['nome_produto']; ?>
            </h2>
            <p>
                <?php echo $linha['detalhes']; ?>
            </p>
            <p class="price">R$
                <?php echo number_format($linha['preco'], 2, ',', '.'); ?>
            </p>
            <button>Mais Detalhes</button>
        </div>
        <?php else : ?>
        <p>Produto não disponível.</p>
        <?php endif; ?>
        <?php endwhile; ?>
    </div>
    

    <!-- Cadastro -->
    <section class="secao-cadastro">
        <div class="container">
            <form action="" method="POST" class="formulario-cadastro">
                <h2>Cadastro</h2>

                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required>
                </div>

                <div class="form-group">
                    <label for="sobrenome">Sobrenome:</label>
                    <input type="text" id="sobrenome" name="sobrenome" placeholder="Digite seu sobrenome" required>
                </div>

                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>
                </div>

                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="tel" id="telefone" name="telefone" placeholder="Digite seu telefone"
                        pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}" required>
                    
                </div>

                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                </div>

                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="left">
                <p><strong>TechNest: Tech Shop©</strong></p>
            </div>
            <div class="center">
                <p>Email: contato.cliente@technest.com</p>
            </div>
            <div class="right">
                <p>Central SAC: (11) 1234-5678</p>
            </div>
        </div>
    </footer>
</body>

</html>