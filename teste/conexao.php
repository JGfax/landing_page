<?php
// Configurações do banco de dados
$servidor = "localhost";    // Geralmente 'localhost'
$usuario_bd = "root";       // Usuário do seu banco de dados
$senha_bd = "Home@spSENAI2025!";             // Senha do seu banco de dados
$banco = "meubanco";        // Nome do banco de dados que você criou
// Cria a conexão
$conexao = mysqli_connect($servidor, $usuario_bd, $senha_bd, $banco);

// Verifica a conexão
if (!$conexao) {
    die("Falha na conexão: " . mysqli_connect_error());
}
?>