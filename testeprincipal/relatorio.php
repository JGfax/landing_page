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
    <link rel="stylesheet" href="relatorio.css">
    <link rel="stylesheet" href="inserir.php">
    <title>RELATÓRIOS</title>

</head>
<body>

<script>
  const menu = document.querySelector('.menu');
  menu.addEventListener('click', () => {
    menu.classList.toggle('active');
  });
</script>

        
  <div class="overlay"></div>

  <div class="conteudo">

  <!-- ================== MENU ================== -->
    <section id="menu">
        <nav class="menu">
            <div class="logo"> 
                <a href="index.html" target="_top">
                </a>
            </div>


            <ul>
                <li><a href="#">Página Inicial</a></li>
            </ul>
        </nav>
    

    <h1>Relatórios gravados</h1>
  

    
<br><br><br><br><br>
<section>
    <p>Análise Detalhada de Resultados</p>

  <div class="section-header">
    
<table border="1" cellpadding="6">
  <thead>
  <tr><th style="width: 60%;">NOME</th><th>EMAIL</th><th>TELEFONE</th><th>SERVICOS</th>
  </thead>
  <tbody>
  <?php if (count($rows) === 0): ?>
    <tr>
      <td colspan="5" style="text-align:center; padding:15px; color:#ffff;">Não há registros.</td>
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


  <!-- ================== RODAPE ================== -->
<br><br>
  <section>
        <footer>
            <div class="footer-section">
                <h3>Desenvolvido por:</h3>
                <p>João Gustavo & Manuella Vitória</p>
            </div>

            <div class="footer-section">
                <h3>Turma:</h3>
                <p>1-A-SESI-TI - Desenvolvimento de Sistemas</p>
            </div>
        </footer>
    </section>
  </div>





</body>
</html>
</body>
</html>


</body>
</html>