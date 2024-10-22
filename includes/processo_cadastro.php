<?php
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Validação de dados (adicione mais validações conforme necessário)
    if (empty($usuario) || empty($email) || empty($senha)) {
        echo "Por favor, preencha todos os campos.";
    } else {
        // Criptografar a senha
        $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

        // Consulta SQL para inserir os dados na tabela
        $sql = "INSERT INTO usuarios (usuario, email, senha) VALUES (?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("sss", $usuario, $email, $senha_criptografada);

        if ($stmt->execute()) {
            echo "Cadastro realizado com sucesso!";
            // Redirecione para a página de sucesso ou login, se necessário
        } else {
            echo "Erro ao cadastrar usuário: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conexao->close();
?>