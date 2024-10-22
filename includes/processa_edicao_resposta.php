<?php
session_start();
include "includes/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resposta_id = $_POST["resposta_id"];
    $conteudo = $_POST["conteudo"];

    // Atualizar a resposta no banco de dados
    $sql = "UPDATE respostas SET conteudo = ? WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("si", $conteudo, $resposta_id);

    if ($stmt->execute()) {
        echo "Resposta atualizada com sucesso!";
        // Redirecionar para a página da dúvida
        $sql = "SELECT topico_id FROM respostas WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $resposta_id);
        $stmt->execute();
        $stmt->bind_result($topico_id);
        $stmt->fetch();
        $stmt->close();
        header("refresh:3;url=../pages/duvida.php?id=" . $topico_id); 
    } else {
        echo "Erro ao atualizar resposta: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
}
?>