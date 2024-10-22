<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
  <title>Meu Perfil - Fórum Dev</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

  <?php if (isset($_SESSION['usuario'])) : ?>
    <a href="logout.php">Sair</a>
  <?php else : ?>
    <a href="login.php">Entrar</a>
  <?php endif; ?>

  <h1>Meu Perfil</h1>

  <?php
  include "../includes/conexao.php";

  if (isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];

    // Consulta para obter os dados do usuário
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
      $linha = $resultado->fetch_assoc();
      echo "<p>Usuário: " . $linha['usuario'] . "</p>";
      // Adicione aqui outros campos que desejar exibir (ex: email, data de cadastro, etc.)

      // Botão para editar o perfil
      echo "<a href='editar_perfil.php'>Editar Perfil</a>";

    } else {
      echo "<p>Usuário não encontrado.</p>";
    }

    $stmt->close();
  } else {
    echo "<p>Você precisa estar logado para acessar esta página.</p>";
  }

  $conexao->close();
  ?>

</body>
</html>