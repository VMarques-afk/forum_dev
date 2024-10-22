<?php
session_start();
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $conteudo = $_POST["conteudo"];
    $data_criacao = date('Y-m-d H:i:s');
    $usuario_id = $_SESSION['usuario_id'];
    $linguagem = $_POST["linguagem"];  // Obtendo a linguagem do formulário

    $sql = "INSERT INTO topicos (titulo, conteudo, data_criacao, usuario_id, linguagem) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssis", $titulo, $conteudo, $data_criacao, $usuario_id, $linguagem);

    if ($stmt->execute()) {
        echo "Dúvida criada com sucesso!";
        header("refresh:3;url=../pages/home.php");
    } else {
        echo "Erro ao criar dúvida: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
}
?>