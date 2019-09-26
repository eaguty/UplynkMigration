<?php


$ruta_xml="files/capitulos_deportes.xml";
$carga_xml = simplexml_load_file( $ruta_xml);
//echo $xml->rows;

foreach ($carga_xml->Rows as $nodo) 
  {
    $entryId = trim($nodo->ID);
    echo $entryId;
    echo "\n";
    
  }




?>