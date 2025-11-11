<?php
// Configuração da conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "Home@spSENAI2025!";
$dbname = "meubanco"; // Certifique-se de que o banco e as tabelas já existem

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1. Captura os dados enviados
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $respostas = $_POST['respostas'] ?? [];

    // 2. Valida se todos os campos necessários foram preenchidos
    if (empty($nome) || empty($email) || empty($respostas)) {
        die("Por favor, preencha todos os campos do formulário.");
    }

    // 3. Insere o usuário na tabela 'usuarios'
    $sql_usuario = "INSERT INTO usuarios (nome, email) VALUES ('$nome', '$email')";

    if ($conn->query($sql_usuario) === TRUE) {
        // 4. Obtém o ID do usuário recém-criado
        $usuario_id = $conn->insert_id;

        // 5. Insere as respostas na tabela 'respostas'
        foreach ($respostas as $pergunta => $resposta) {
            $sql_resposta = "INSERT INTO respostas (usuario_id, pergunta, resposta)
                             VALUES ($usuario_id, '$pergunta', '$resposta')";
            
            if (!$conn->query($sql_resposta)) {
                echo "Erro ao inserir resposta: " . $conn->error . "<br>";
            }
        }

        echo "<h2>Cadastro realizado com sucesso!</h2>";
        echo "<a href='formulario.php'>Voltar ao formulário</a>";

    } else {
        echo "Erro ao cadastrar usuário: " . $conn->error;
    }

} else {
    echo "Formulário não enviado!";
}

// Fecha a conexão com o banco
$conn->close();
?>

