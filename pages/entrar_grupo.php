<?php
session_start();
include "../includes/conexao.php";

if (isset($_SESSION['usuario_id']) && isset($_GET['id'])) {
    $usuario_id = $_SESSION['usuario_id'];
    $grupo_id = $_GET['id'];

    // Verificar se o usuário já é membro do grupo
    $sql = "SELECT id FROM grupo_membros WHERE grupo_id = ? AND usuario_id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ii", $grupo_id, $usuario_id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 0) {
        // Inserir o usuário no grupo
        $sql = "INSERT INTO grupo_membros (grupo_id, usuario_id) VALUES (?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ii", $grupo_id, $usuario_id);

        if ($stmt->execute()) {
            echo "Você entrou no grupo com sucesso!";
        } else {
            echo "Erro ao entrar no grupo: " . $stmt->error;
        }
    } else {
        echo "Você já é membro deste grupo.";
    }

    $stmt->close();
} else {
    echo "ID do grupo ou usuário não informado.";
}

$conexao->close();

header("refresh:3;url=grupo.php?id=" . $grupo_id); // Redireciona para a página do grupo
?>