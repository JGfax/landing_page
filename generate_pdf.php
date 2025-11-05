<?php
$autoloads = [
    __DIR__ . '/vendor/autoload.php',
    __DIR__ . '/../vendor/autoload.php',
    __DIR__ . '/../../vendor/autoload.php',
];
$ok = false;
foreach ($autoloads as $a) { if (file_exists($a)) { require $a; $ok = true; break; } }
if (!$ok) { die('Composer autoload não encontrado. Rode "composer require dompdf/dompdf" no projeto.'); }

require __DIR__ . '/conexao.php';

use Dompdf\Dompdf;
use Dompdf\Options;
use Dompdf\FontMetrics;

// ===== 1) Buscar dados =====
$stmt = $pdo->query("
  SELECT id, titulo, autor, data_criacao
  FROM relatorios
  ORDER BY data_criacao DESC
");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total = count($rows);

// ===== 2) Montar HTML =====
ob_start();
?>
<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Relatórios</title>
<style>
  @page { margin: 20mm 15mm 20mm 15mm; }
  body { font-family: DejaVu Sans, sans-serif; color:#222; }
  h1 { margin:0; font-size:20px; text-align:center; }
  .topbar {
    display:flex; justify-content:space-between; align-items:center;
    margin-bottom:14px; border-bottom:1px solid #ccc; padding-bottom:8px;
    font-size:12px;
  }
  .muted { color:#666; }
  table { width:100%; border-collapse:collapse; font-size:11px; }
  thead th {
    background:#f0f0f0; border:1px solid #999; padding:6px; text-align:center;
  }
  tbody td { border:1px solid #bbb; padding:6px; vertical-align:middle; }
  tbody tr:nth-child(even) { background:#fafafa; }
  .col-id   { width:50px; text-align:center; }
  .col-tit  { width:auto; }
  .col-aut  { width:180px; }
  .col-data { width:120px; text-align:center; white-space:nowrap; }
  .totais { margin-top:10px; font-size:12px; text-align:right; }
</style>
</head>
<body>
  <div class="topbar">
    <div><strong>Relatórios</strong> <span class="muted">— listagem geral</span></div>
    <div class="muted">Gerado em: <?=date('d/m/Y H:i')?></div>
  </div>
  <h1>Relatórios</h1>
  <table>
    <thead>
      <tr>
        <th class="col-id">ID</th>
        <th class="col-tit">Título</th>
        <th class="col-aut">Autor</th>
        <th class="col-desc">Descrição</th>
        <th class="col-data">Data</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!$rows): ?>
        <tr><td colspan="4" style="text-align:center; padding:16px;">Nenhum registro encontrado.</td></tr>
      <?php else: ?>
        <?php foreach ($rows as $r): ?>
          <tr>
            <td class="col-id"><?= (int)$r['id'] ?></td>
            <td class="col-tit"><?= htmlspecialchars((string)$r['titulo']) ?></td>
            <td class="col-aut"><?= htmlspecialchars((string)($r['autor'] ?? '')) ?></td>
            <td class="col-aut"><?= htmlspecialchars((string)($r['descricao'] ?? '')) ?></td>
            <td class="col-data">
              <?= $r['data_criacao'] ? date('d/m/Y H:i', strtotime($r['data_criacao'])) : '' ?>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>

  <div class="totais">
    Total de registros: <strong><?=$total?></strong>
  </div>
</body>
</html>
<?php
$html = ob_get_clean();
// ===== 3) Dompdf =====
$options = new Options();
$options->set('defaultFont', 'dejavusans');
$options->set('isRemoteEnabled', true); // se for carregar logo/imagens remotas
$dompdf = new Dompdf($options);
$dompdf->setPaper('A4', 'portrait');
$dompdf->loadHtml($html);
$dompdf->render();
// ===== 4) Numeração de páginas =====
$canvas = $dompdf->getCanvas();
$font   = (new FontMetrics($canvas, $options))->getFont('dejavusans', 'normal');
$canvas->page_text(
  520, 820,                       // x, y (A4 retrato aprox.)
  "Página {PAGE_NUM} de {PAGE_COUNT}",
  $font, 9, [0,0,0]
);
// ===== 5) Saída =====
$dompdf->stream('relatorios.pdf', ['Attachment' => false]); // Inline