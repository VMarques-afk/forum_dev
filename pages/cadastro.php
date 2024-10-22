<!DOCTYPE html>
<html>
<head>
    <title>Cadastro - Fórum Dev</title>
    <link rel="stylesheet" href="css/style.css"> 
</head>
<body>
    <header>
        <div class="container">
            <h1>Fórum Dev</h1>
        </div>
    </header>

    <main class="container">
        <h2>Cadastro</h2>
        <form action="includes/processo_cadastro.php" method="post">
            <label for="usuario">Usuário:</label>
            <input type="text" id="usuario" name="usuario" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required><br><br>

            <input type="submit" value="Cadastrar">
        </form>
    </main>

    <footer>
        <div class="container">
            <p>Fórum Dev</p>
        </div>
    </footer>
</body>
</html>