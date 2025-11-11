<?php
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $respostas = $_POST['respostas'];

    try {
        $pdo->beginTransaction();

        // Insere usuário
        $stmt = $pdo->prepare("INSERT INTO tbl_clientes (nome, email, telefone, id) VALUES (:nome, :email)");
        $stmt->execute(['nome' => $nome, 'email' => $email]);
        $id_usuario = $pdo->lastInsertId();

        // Insere respostas
        $stmt = $pdo->prepare("
            INSERT INTO respostas (id_usuario, cor_favorita, animal_favorito)
            VALUES (:id_usuario, :cor_favorita, :animal_favorito)
        ");
        $stmt->execute([
            'id_usuario' => $id_usuario,
            'cor_favorita' => $respostas['cor_favorita'],
            'animal_favorito' => $respostas['animal_favorito']
        ]);

        $pdo->commit();
        echo "<h3>Cadastro realizado com sucesso!</h3>";

    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Erro ao salvar: " . $e->getMessage();
    }
}
