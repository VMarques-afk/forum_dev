<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
  <title>Editar Perfil - Fórum Dev</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

  <?php if (isset($_SESSION['usuario'])) : ?>
    <a href="logout.php">Sair</a>
  <?php else : ?>
    <a href="login.php">Entrar</a>
  <?php endif; ?>

  <h1>Editar Perfil</h1>

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
      ?>

      <form action="../includes/processa_edicao_perfil.php" method="post">
        <label for="usuario">Usuário:</label>
        <input type="text" id="usuario" name="usuario" value="<?php echo $linha['usuario']; ?>" required><br><br>

        <label for="senha">Nova Senha:</label>
        <input type="password" id="senha" name="senha"><br><br>
        <input type="submit" value="Salvar Alterações">
      </form>

      <?php
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