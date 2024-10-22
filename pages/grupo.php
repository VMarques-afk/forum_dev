<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
<html lang="pt-br">
    <title>Grupo - Fórum Dev</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php if (isset($_SESSION['usuario'])) : ?>
        <a href="logout.php">Sair</a>
    <?php else : ?>
        <a href="login.php">Entrar</a>
    <?php endif; ?>

    <h1>Grupo de Discussão</h1>

    <?php
    include "../includes/conexao.php";

    if (isset($_GET['id'])) {
        $grupo_id = $_GET['id'];

        // Consulta para obter os dados do grupo
        $sql = "SELECT * FROM grupos WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $grupo_id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $linha = $resultado->fetch_assoc();
            echo "<h2>" . $linha['nome'] . "</h2>";
            echo "<p>" . $linha['descricao'] . "</p>";

            // Verificar se o usuário é membro do grupo (após obter os dados do grupo)
            $sql = "SELECT id FROM grupo_membros WHERE grupo_id = ? AND usuario_id = ?";
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("ii", $grupo_id, $_SESSION['usuario_id']);
            $stmt->execute();
            $resultado_membro = $stmt->get_result();

            if ($resultado_membro->num_rows > 0) {
                echo "<a href='sair_grupo.php?id=" . $linha['id'] . "'>Sair do Grupo</a>";
            } else {
                echo "<a href='entrar_grupo.php?id=" . $linha['id'] . "'>Entrar no Grupo</a>";
            }

        } else {
            echo "<p>Grupo não encontrado.</p>";
        }

        $stmt->close();
    } else {
        echo "<p>ID do grupo não informado.</p>";
    }

    $conexao->close();
    ?>

</body>
</html>