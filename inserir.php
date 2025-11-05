<?php
require 'conexao.php';

// Inserir
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $titulo = $_POST['titulo'] ?? '';
  $descricao = $_POST['descricao'] ?? '';
  $autor = $_POST['autor'] ?? '';
  $stmt = $pdo->prepare("INSERT INTO relatorios (titulo, descricao, autor) VALUES (?, ?, ?)");
  $stmt->execute([$titulo, $descricao, $autor]);
  echo "Relatório salvo com ID: " . $pdo->lastInsertId();
  exit;
}
// Listar
$stmt = $pdo->query("SELECT * FROM relatorios ORDER BY data_criacao DESC");
$rows = $stmt->fetchAll();
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Relatórios</title></head>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<body>
  <main>
<section>
  <div class="section-header">
  <h1>Inserir Relatório</h1>
  </div>
<form method="post">
  <div class="conjunto">
  <label for=""><i class="fa-solid fa-user"></i></label>
  <input name="titulo" placeholder="Título" required><br>
  </div>
  <div class="conjunto">
  <label for=""> <i class="fa-solid fa-file-signature"></i></label>
    <input name="autor" placeholder="Autor"><br>
  </div>
  <textarea name="descricao" placeholder="Descrição"></textarea><br>
  <button>Salvar</button>
</form>
</section>

</body>
</html>
