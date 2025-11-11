<?php
require 'conexao.php';

// Inserir
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nome = $_POST['nome'] ?? '';
  $email = $_POST['email'] ?? '';
  $telefone = $_POST['telefone'] ?? '';
  
  try {
    $stmt = $pdo->prepare("INSERT INTO tbl_clientes (nome, email, telefone) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $email, $telefone]);
    $id = $pdo->lastInsertId();
    // Redirecionar para relatorio.php após sucesso
    header("Location: relatorio.php?msg=Relatório salvo com ID: " . $id);
    exit;
  } catch (Exception $e) {
    $erro = "Erro ao salvar: " . $e->getMessage();
  }
}
?>

<!doctype html>

<html>
<head><meta charset="utf-8"><title>Relatórios</title></head>
<link rel="stylesheet" href="style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<body>
  <main>
    
<section>
  <div class="form-container">
  <h1>Inserir Relatório</h1>
  </div>
<form method="post">

  <div class="conjunto">
  <label for=""><i class="fa-solid fa-user"></i></label>
  <input name="nome" placeholder="nome" required><br>
  </div>
  
  <div class="conjunto">
  <label for=""> <i class="fa-solid fa-file-signature"></i></label>
    <input name="email" placeholder="email"><br>
  </div>

  <div class="conjunto">
  <label for=""> <i class="fa-solid fa-file-signature"></i></label>
    <input name="telefone" placeholder="telefone"><br>
  </div>

   <div class="conjunto">
  <label for=""> <i class="fa-solid fa-file-signature"></i></label>
    <input name="telefone" placeholder="telefone"><br>
  </div>

  <button>Salvar</button>
</form>
</section>
  </main>
</body>
</html>
