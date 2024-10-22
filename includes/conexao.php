
<?php

$servidor = "localhost";
$usuario = "vinny";
$senha = "123456789";
$banco_de_dados = "forum_dev";

$conexao = new mysqli($servidor, $usuario, $senha, $banco_de_dados);



if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}

?>