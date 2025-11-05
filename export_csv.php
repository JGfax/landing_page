<?php
require 'conexao.php';
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=relatorios.csv');

$out = fopen('php://output', 'w');
// cabeçalho
fputcsv($out, ['id','titulo','descricao','autor','data_criacao']);

$stmt = $pdo->query("SELECT id, titulo, descricao, autor, data_criacao FROM relatorios ORDER BY data_criacao DESC");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  fputcsv($out, $row);
}
fclose($out);
exit;
