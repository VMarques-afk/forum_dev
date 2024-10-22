<?php
session_start();
include "../includes/conexao.php";

if (isset($_SESSION['usuario_id']) && isset($_GET['id'])) {
    $usuario_id = $_SESSION['usuario_id'];
    $grupo_id = $_GET['id'];

    // Remover o usuário do grupo
    $sql = "DELETE FROM grupo_membros WHERE grupo_id = ? AND usuario_id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ii", $grupo_id, $usuario_id);

    if ($stmt->execute()) {
        echo "Você saiu do grupo com sucesso!";
    } else {
        echo "Erro ao sair do grupo: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID do grupo ou usuário não informado.";
}

$conexao->close();

header("refresh:3;url=grupo.php?id=" . $grupo_id); // Redireciona para a página do grupo
?>