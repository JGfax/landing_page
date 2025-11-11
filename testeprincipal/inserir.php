<?php
require 'conexao.php';

// Buscar os serviços da tabela
try {
  $servicos = $pdo->query("SELECT id_servico, descricao FROM tbl_servicos")->fetchAll();
} catch (Exception $e) {
  $servicos = [];
  echo "Erro ao carregar serviços: " . $e->getMessage();
}

// Inserir cliente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nome = $_POST['nome'] ?? '';
  $email = $_POST['email'] ?? '';
  $telefone = $_POST['telefone'] ?? '';
  $id_servico = $_POST['id_servico'] ?? null;

  try {
    $stmt = $pdo->prepare("INSERT INTO tbl_clientes (nome, email, telefone, id_servico) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $email, $telefone, $id_servico]);
    header("Location: relatorio.php?msg=Salvo com sucesso!");
    exit;
  } catch (Exception $e) {
    echo "Erro ao salvar: " . $e->getMessage();
  }
}
?>


<!doctype html>

<html>
<head><meta charset="utf-8"><title>Relatórios</title></head>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>


<body>


 <div class="overlay"></div>

  <div class="conteudo">

  <!-- ================== MENU ================== -->
    <section id="menu">
        <nav class="menu">

                <div class="hamburger" onclick="toggleMenu()">☰</div>
                <ul>
                    <li><a href="inserir.php" target="">MENU</a></li>
                </ul>
            </nav>

            <!-- Menu mobile -->
            <div class="mobile-menu" id="mobileMenu">
                <a href="inserir.php">MENU</a>
            </div>

            <script>
                function toggleMenu() {
                    var menu = document.getElementById("mobileMenu");
                    menu.style.display = (menu.style.display === "flex") ? "none" : "flex";
                }
            </script>
        </section>

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
  <input type="text" name="nome" placeholder="nome" required><br>

  <hr>
  </div>
  

 <!-- // Campo de email // -->
  <div class="conjunto">
  <label for="email"> E-mail <i class="fa-solid fa-file-signature"></i></label>
    <input type="email" name="email" placeholder="email" required><br>

     <hr>
  </div>

  <!-- // Campo de telefone // -->
  <div class="conjunto">
  <label for="telefone"> Telefone <i class="fa-solid fa-phone"></i></label>
    <input type="text" name="telefone" placeholder="telefone" required><br>

     <hr>
  </div>
  
  <!-- // Campo de servico // -->

     <div class="conjunto">
  <label for="servico"> Serviço <i class="fa-solid fa-industry"></i></label>
      <select id="tbl_servico" name="id_servico" >

      <option value=""> -- Selecione um Serviço -- </option>
      <option value="1">Desenvolvimento Web</option>
      <option value="2">Suporte Técnico</option>
      <option value="3">Segurança da Informação</option>
      <option value="4">Consultoria em TI</option>
      </select>
  </div> 

  <button> Salvar </button>

</form>
  </div>

  
    </section>
</section>

</div>


  </main>
</body>
</html>
