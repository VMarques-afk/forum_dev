<?php

session_start();

include "includes/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $usuario_id = $_SESSION['usuario_id'];
  $novo_usuario = $_POST["usuario"];
  $nova_senha = $_POST["senha"];

 
  $sql = "UPDATE usuarios SET usuario = ? WHERE id = ?";
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("si", $novo_usuario, $usuario_id);

  if ($stmt->execute()) {
    if (!empty($nova_senha)) {
      $senha_criptografada = password_hash($nova_senha, PASSWORD_DEFAULT);
      $sql = "UPDATE usuarios SET senha = ? WHERE id = ?";
      $stmt = $conexao->prepare($sql);
      $stmt->bind_param("si", $senha_criptografada, $usuario_id);
      $stmt->execute();
    }

    echo "Perfil atualizado com sucesso!";
    header("refresh:3;url=../pages/perfil.php");
  } else {
    echo "Erro ao atualizar perfil: " . $stmt->error;
  }

  $stmt->close();
  $conexao->close();
}
?>