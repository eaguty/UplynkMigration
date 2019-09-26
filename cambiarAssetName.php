<?php


//deportes
//include('configDeportes.php');
//$ruta_xml="files/capitulos_deportes.xml";


//ADN40
include('configAdn40.php');
$ruta_xml="files/adn40Programa.xml";

$carga_xml = simplexml_load_file( $ruta_xml);
//echo $xml->rows;
$sum=0;
$sumGeneral=0;
foreach ($carga_xml->Video as $nodo) 
  {
    $sumGeneral++;
    $entryId = trim($nodo->Id);
    //$desc= trim(htmlspecialchars($nodo->Titulo));
    //$description = trim(htmlspecialchars($nodo->Teaser));
    //$tags = trim(htmlspecialchars($nodo->Keywords));
    $programa = trim(htmlspecialchars($nodo->Programa));
    /*if($desc==""){
        $desc=$description;
        echo "SIN TITULO ";
        $sum++;
    }

    echo "Entry: ".$entryId." titulo: ".$desc." description: ".$description." tags: ".$tags."\n\n";
    echo "<br>";
    echo "<br>";
    */
    $cadena= array("programa"=>$programa);
    $meta=json_encode($cadena);
    //var_dump($meta);
    $json= Call('/api2/asset/update', array('meta'=>$meta,'external_id'=>$entryId));
    //$json= Call('/api2/asset/update', array('desc'=>$desc,'external_id'=>$entryId));
    $obj = json_decode($json);
    if($obj->error!=0)
    {
      echo $entryId."/".$obj->msg."\n";
    }
    else
    {
      $asset=(array) $obj->asset;
      //echo "\nID MODIFICADO (Descripcion y Tags): ".$asset['id'];
      
      echo $asset['external_id']."/programa agregado\n";
    }
    
  }
    /*echo "Total sin título: ".$sum;
    echo "<br>";
    echo "Total General: ".$sumGeneral;
*/
?>