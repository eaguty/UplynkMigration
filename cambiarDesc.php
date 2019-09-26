<?php

include('configDeportes.php');

$ruta_xml="files/capitulos_deportes.xml";
$carga_xml = simplexml_load_file( $ruta_xml);
//echo $xml->rows;

foreach ($carga_xml->Rows as $nodo) 
  {
    $entryId = trim($nodo->ID);
    $desc= htmlspecialchars($nodo->TITLE);
    $json2 = Call('/api2/asset/update', array('desc'=>$desc,'external_id'=>$entryId));
    $obj2 = json_decode($json2);
    
    if($obj2->error!=0)
    {
      echo "EntryId: ".$entryId." ".$obj2->msg."\n";
    }
    else
    {
      $asset2=(array) $obj2->asset;
      echo "\nID MODIFICADO (Asset_Name): ".$asset2['id'];
    }
    
  }



?>