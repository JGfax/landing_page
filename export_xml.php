<?php
require 'conexao.php';
header('Content-Type: application/xml; charset=utf-8');
$xml = new DOMDocument('1.0','utf-8');
$xml->formatOutput = true;
$root = $xml->createElement('relatorios');
$xml->appendChild($root);
$stmt = $pdo->query("SELECT id, titulo, descricao, autor, data_criacao FROM relatorios");
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $item = $xml->createElement('relatorio');
  foreach ($r as $k=>$v) {
    $child = $xml->createElement($k);
    $child->appendChild($xml->createTextNode($v));
    $item->appendChild($child);
  }
  $root->appendChild($item);
}
echo $xml->saveXML();

