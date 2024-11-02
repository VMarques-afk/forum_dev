<?php
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    
    if (empty($usuario) || empty($email) || empty($senha)) {
        echo "Por favor, preencha todos os campos.";
    } else {
       
        $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO usuarios (usuario, email, senha) VALUES (?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("sss", $usuario, $email, $senha_criptografada);

        if ($stmt->execute()) {
            echo "Cadastro realizado com sucesso!";
    
        } else {
            echo "Erro ao cadastrar usuário: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conexao->close();
?>