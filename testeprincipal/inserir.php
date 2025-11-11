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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
<body>
  <main>

  <!-- // Formulário de inserção //-->
<section class="formulario">
  <div class="formulario-header">
  <h1>Inserir Relatório</h1>
  </div>
</section>


<section class="form-container">
  <div class="formulario-body">

  
            <div class="texto"> <br>
                <p>
                  Na TechNova Solutions, transformamos ideias em soluções digitais inteligentes. 
                </p>

                <p>
                  Com foco em inovação, segurança e eficiência, ajudamos empresas a automatizar processos, otimizar sistemas e crescer no 
                </p>
            

                <p style="margin-top: 10px; color:blueviolet; font-size: 70px;">
                  MUNDO DIGITAL.
                </p>

                </p>
            </div>


<form method="post">

  <div class="conjunto"> <br> <br>
  <label for="nome"> Nome <i class="fa-solid fa-user"></i></label>
  <input type="text" placeholder="nome" required><br>

  <hr>
  </div>
  

 <!-- // Campo de email // -->
  <div class="conjunto">
  <label for="email"> E-mail <i class="fa-solid fa-file-signature"></i></label>
    <input type="email" placeholder="email"><br>

     <hr>
  </div>

  <!-- // Campo de telefone // -->
  <div class="conjunto">
  <label for="telefone"> Telefone <i class="fa-solid fa-file-signature"></i></label>
    <input type="text" placeholder="telefone"><br>

     <hr>
  </div>
  
  <!-- // Campo de servico // -->
   <div class="conjunto">
  <label for="servico"> Serviço <i class="fa-solid fa-file-signature"></i></label>
      <select id="tbl_servico" name="id_servico" >
      <option value="1">SP</option>
      <option value="2">RJ</option>
      <option value="3">MG</option>
      </select>
  </div> 

  <button> Salvar </button>
</form>

  </div>

</section>
  </main>
</body>
</html>
