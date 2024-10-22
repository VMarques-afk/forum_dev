<!DOCTYPE html>
<html>
<head>
    <title>Fórum Dev - Home</title>
    <link rel="stylesheet" href="css/style.css"> 
</head>
<body>
    <header>
        <div class="container"> 
            <h1>Fórum Dev</h1>
            <nav>
                <?php if (isset($_SESSION['usuario'])) : ?>
                    <a href="logout.php">Sair</a>
                    <a href="grupos.php">Grupos</a>
                    <a href="perfil.php">Perfil</a> 
                <?php endif; ?> 
            </nav>
        </div>
    </header>

    <main class="container">
        <?php if (!isset($_SESSION['usuario'])) : ?>
            <div class="login-links">
                <a href="login.php">Entrar</a> 
                <a href="cadastro.php">Cadastrar</a>
            </div>
        <?php endif; ?>

        <section class="hero">
            <h2>Um mundo de descobertas e aprendizados!</h2>
            <p>Tire suas dúvidas, compartilhe conhecimento e conecte-se com outros desenvolvedores.</p>
            <?php if (!isset($_SESSION['usuario'])) : ?>
                <a href="cadastro.php" class="btn">Cadastre-se agora!</a>
            <?php endif; ?>
        </section>

        <section class="ultimas-duvidas">
            <h2>Últimas Dúvidas</h2>
            </section>

        <section class="topicos-em-alta">
            <h2>Tópicos em Alta</h2>
            </section>
    </main>

    <footer>
        <div class="container">
            <p>Fórum Dev</p>
        </div>
    </footer>
</body>
</html>