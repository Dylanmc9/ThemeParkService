<?php
mysql_connect('localhost', 'root', '');
mysql_select_db('theme_parks');

$sql = "SELECT * FROM tbl_parks ORDER BY id";
$res = mysql_query($sql);

$xml = new XMLWriter();

$xml->openURI("php://output");
$xml->startDocument();
$xml->setIndent(true);

$xml->startElement('name');

while ($row = mysql_fetch_assoc($res)) {
  $xml->startElement("name");

  $xml->writeAttribute('id', $row['id']);
  $xml->writeRaw($row['name']);

  $xml->endElement();
}

$xml->endElement();

header('Content-type: text/xml');
$xml->flush();
?>