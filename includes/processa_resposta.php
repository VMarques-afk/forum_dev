<?php
session_start();
include "includes/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conteudo = $_POST["conteudo"];
    $data_criacao = date('Y-m-d H:i:s');
    $usuario_id = $_SESSION['usuario_id'];
    $topico_id = $_POST["topico_id"];

    $sql = "INSERT INTO respostas (conteudo, data_criacao, usuario_id, topico_id) VALUES (?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssi", $conteudo, $data_criacao, $usuario_id, $topico_id);

    if ($stmt->execute()) {
        echo "Resposta enviada com sucesso!";
        header("refresh:3;url=../pages/duvida.php?id=" . $topico_id);
    } else {
        echo "Erro ao enviar resposta: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
}
?>