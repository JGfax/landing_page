<?php
require 'conexao.php';

// Listar todos os clientes do banco
try {
  $stmt = $pdo->query("SELECT id_cliente, nome, email, telefone FROM tbl_clientes ORDER BY id_cliente DESC");
  $rows = $stmt->fetchAll();
} catch (Exception $e) {
  $rows = [];
  $erro = "Erro ao buscar dados: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inserir.php">
    <title>RELATÓRIOS</title>
</head>
<body>
    
<section>
  <div class="section-header">
  <h2>Relatórios gravados</h2>

<table border="1" cellpadding="6">
  <thead>
  <tr><th style="width: 60%;">nome</th><th>email</th><th>telefone</th><th>servicos</th>
  </thead>
  <tbody>
  <?php if (count($rows) === 0): ?>
    <tr>
      <td colspan="5" style="text-align:center; padding:15px; color:#777;">
        Não há registros.
      </td>
    </tr>
  <?php else: ?>
    <?php foreach($rows as $r): ?>
      <tr>
        <td><?= htmlspecialchars($r['nome']) ?></td>
        <td><?= htmlspecialchars($r['email']) ?></td>
        <td><?= htmlspecialchars($r['telefone']) ?></td>
        <td><?= htmlspecialchars($r['id_servico']) ?></td>
      </tr>
    <?php endforeach; ?>
  <?php endif; ?>
</tbody>

</table>  
</section>
  </main>
</body>
</html>


</body>
</html>