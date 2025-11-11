<?php
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    try {
        $pdo->beginTransaction();

        // Insere usuário
        $stmt = $pdo->prepare("INSERT INTO tbl_servico (id_servico, descricao) VALUES (:id_servico, :descricao)");
        $stmt->execute(['id_servico' => $id_servico, 'nome' => $nome['nome'], ' descricao' => $descricao['descricao']]);
        $id_usuario = $pdo->lastInsertId();

        // Insere respostas
        $stmt = $pdo->prepare("
            INSERT INTO tbl_cliente (id_cliente, nome, telefone, email)
            VALUES (:id_cliente, :nome, :telefone, :email)
        ");
        $stmt->execute([
            'id_cliente' => $id_cliente,
            'nome' => $nome['nome'],
            'email' => $email['email'],
            'telefone' => $telefone['telefone']
        ]);

        $pdo->commit();
        echo "<h3>Cadastro realizado com sucesso!</h3>";

    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Erro ao salvar: " . $e->getMessage();
    }
}
