<?php
include "includes/conexao.php";
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    
    $sql = "SELECT * FROM usuarios WHERE usuario = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $linha = $resultado->fetch_assoc();
        $senha_banco = $linha["senha"];

        if (password_verify($senha, $senha_banco)) {
            $_SESSION['usuario'] = $usuario;
            header("Location: ../pages/home.php"); 
            exit; 
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
    $stmt->close(); 
}
$conexao->close(); 
?>