<?php
session_start();
include "../includes/conexao.php";

if (isset($_GET['id'])) {
    $id_resposta = $_GET['id'];

    // Excluir a resposta do banco de dados
    $sql = "DELETE FROM respostas WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id_resposta);

    if ($stmt->execute()) {
        echo "Resposta excluída com sucesso!";
        // Redirecionar para a página da dúvida
        $sql = "SELECT topico_id FROM respostas WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $id_resposta);
        $stmt->execute();
        $stmt->bind_result($topico_id);
        $stmt->fetch();
        $stmt->close();
        header("refresh:3;url=../pages/duvida.php?id=" . $topico_id); 
    } else {
        echo "Erro ao excluir resposta: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "<p>ID da resposta não informado.</p>";
}

$conexao->close();
?>