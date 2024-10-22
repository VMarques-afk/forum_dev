<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Nova Dúvida - Fórum Dev</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php if (isset($_SESSION['usuario'])) : ?>
        <a href="logout.php">Sair</a>
    <?php else : ?>
        <a href="login.php">Entrar</a>
    <?php endif; ?>

    <h1>Nova Dúvida</h1>
    <form action="../includes/processa_duvida.php" method="post">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required><br><br>

        <label for="conteudo">Conteúdo:</label>
        <textarea id="conteudo" name="conteudo" required></textarea><br><br>

        <label for="linguagem">Linguagem:</label>
        <select id="linguagem" name="linguagem">
            <option value="PHP">PHP</option>
            <option value="JavaScript">JavaScript</option>
            <option value="Python">Python</option>
            <option value="Java">Java</option>
            <option value="C++">C++</option>
            </select><br><br>

        <input type="submit" value="Criar Dúvida">
    </form>
</body>
</html>