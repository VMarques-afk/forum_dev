<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Grupos - Fórum Dev</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php if (isset($_SESSION['usuario'])) : ?>
        <a href="logout.php">Sair</a>
    <?php else : ?>
        <a href="login.php">Entrar</a>
    <?php endif; ?>

    <h1>Grupos de Discussão</h1>

    <?php
    include "../includes/conexao.php";

    // Consultar os grupos do banco de dados
    $sql = "SELECT * FROM grupos";
    $resultado = $conexao->query($sql);

    if ($resultado->num_rows > 0) {
        while ($linha = $resultado->fetch_assoc()) {
            echo "<h2>" . $linha['nome'] . "</h2>";
            echo "<p>" . $linha['descricao'] . "</p>";
            echo "<a href='grupo.php?id=" . $linha['id'] . "'>Entrar no Grupo</a>";
            echo "<hr>";
        }
    } else {
        echo "<p>Nenhum grupo encontrado.</p>";
    }

    $conexao->close();
    ?>

</body>
</html>