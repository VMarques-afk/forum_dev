<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Responder - Fórum Dev</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php if (isset($_SESSION['usuario'])) : ?>
        <a href="logout.php">Sair</a>
    <?php else : ?>
        <a href="login.php">Entrar</a>
    <?php endif; ?>

    <h1>Responder</h1>

    <?php
    include "../includes/conexao.php";

    if (isset($_GET['id'])) {
        $id_topico = $_GET['id']; 
        ?>

        <form action="../includes/processa_resposta.php" method="post">
            <input type="hidden" name="topico_id" value="<?php echo $id_topico; ?>">
            <label for="conteudo">Resposta:</label><br>
            <textarea id="conteudo" name="conteudo" required></textarea><br><br>
            <input type="submit" value="Enviar Resposta">
        </form>

        <?php
    } else {
        echo "<p>ID da dúvida não informado.</p>";
    }

    $conexao->close();
    ?>

</body>
</html>