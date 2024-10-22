<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Resposta - Fórum Dev</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php if (isset($_SESSION['usuario'])) : ?>
        <a href="logout.php">Sair</a>
    <?php else : ?>
        <a href="login.php">Entrar</a>
    <?php endif; ?>

    <h1>Editar Resposta</h1>

    <?php
    include "../includes/conexao.php";

    if (isset($_GET['id'])) {
        $id_resposta = $_GET['id'];

        // Consulta para obter a resposta
        $sql = "SELECT * FROM respostas WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $id_resposta);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $linha = $resultado->fetch_assoc();
            ?>

            <form action="../includes/processa_edicao_resposta.php" method="post">
                <input type="hidden" name="resposta_id" value="<?php echo $id_resposta; ?>">
                <label for="conteudo">Resposta:</label><br>
                <textarea id="conteudo" name="conteudo" required><?php echo $linha['conteudo']; ?></textarea><br><br>
                <input type="submit" value="Salvar Alterações">
            </form>

            <?php
        } else {
            echo "<p>Resposta não encontrada.</p>";
        }

        $stmt->close();
    } else {
        echo "<p>ID da resposta não informado.</p>";
    }

    $conexao->close();
    ?>

</body>
</html>