<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Dúvida - Fórum Dev</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php if (isset($_SESSION['usuario'])) : ?>
        <a href="logout.php">Sair</a>
    <?php else : ?>
        <a href="login.php">Entrar</a>
    <?php endif; ?>

    <h1>Dúvida</h1>

    <?php
    include "../includes/conexao.php";

    if (isset($_GET['id'])) {
        $id_topico = $_GET['id'];

        // Consulta para obter os dados do tópico
        $sql = "SELECT * FROM topicos WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $id_topico);
        $stmt->execute();
        $resultado_topico = $stmt->get_result();

        if ($resultado_topico->num_rows > 0) {
            $linha_topico = $resultado_topico->fetch_assoc();
            echo "<h2>" . $linha_topico['titulo'] . "</h2>";
            echo "<p>" . $linha_topico['conteudo'] . "</p>";

            // Consulta para obter as respostas do tópico
            $sql = "SELECT * FROM respostas WHERE topico_id = ? ORDER BY data_criacao";
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("i", $id_topico);
            $stmt->execute();
            $resultado_respostas = $stmt->get_result();

            if ($resultado_respostas->num_rows > 0) {
                echo "<h3>Respostas:</h3>";
                while ($linha_resposta = $resultado_respostas->fetch_assoc()) {
                    echo "<p>" . $linha_resposta['conteudo'] . "</p>";

                    // Verifica se o usuário logado é o autor da resposta
                    if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_id'] == $linha_resposta['usuario_id']) {
                        echo "<a href='editar_resposta.php?id=" . $linha_resposta['id'] . "'>Editar</a> | ";
                        echo "<a href='excluir_resposta.php?id=" . $linha_resposta['id'] . "'>Excluir</a>";
                    }
                    echo "<hr>"; 
                }
            } else {
                echo "<p>Nenhuma resposta encontrada.</p>";
            }

            echo "<a href='responder.php?id=" . $id_topico . "'>Responder</a>";

        } else {
            echo "<p>Dúvida não encontrada.</p>";
        }

        $stmt->close();
    } else {
        echo "<p>ID da dúvida não informado.</p>";
    }

    $conexao->close();
    ?>

</body>
</html>