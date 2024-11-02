<!DOCTYPE html>
<html>
<head>
    <title>Login - Fórum Dev</title>
    <link rel="stylesheet" href="css/style.css">;
</head>
<body>
    <header>
        <div class="container">
            <h1>Fórum Dev</h1>
        </div>
    </header>

    < class="container">
        <h2>Login</h2>
        <form action="includes/processo_login.php" method="post">
            <label for="usuario">Usuário:</label>
            <input type="text" id="usuario" name="usuario" required><br><br>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required><br><br>

            <input type="submit" value="Entrar">
        </form>

        <p>Ainda não tem uma conta? <a href="pages/cadastro.php">Cadastre-se aqui</a>.
    </p>

    </main>

    <footer>
        <div class="container">
            <p>Fórum Dev </p>
        </div>
    </footer>
</body>
</html>