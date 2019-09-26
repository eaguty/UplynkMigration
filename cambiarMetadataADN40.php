<?php


//deportes
//include('configDeportes.php');
//$ruta_xml="files/capitulos_deportes.xml";


//ADN40
include('configAdn40.php');
$ruta_xml="files/adn40_3.xml";

$carga_xml = simplexml_load_file( $ruta_xml);
//echo $xml->rows;
$sum=0;
$sumGeneral=0;
foreach ($carga_xml->Video as $nodo) 
  {
    $sumGeneral++;
    $entryId = trim($nodo->Id);
    // $desc= trim(htmlspecialchars($nodo->Titulo));
    // $description = trim(htmlspecialchars($nodo->Teaser));
    // $tags = trim(htmlspecialchars($nodo->Keywords));
    $programa = trim(htmlspecialchars($nodo->Programa));
    //$seccion = trim(htmlspecialchars($nodo->Seccion));

    // if($desc==""){
    //     $desc=$description;
    //     echo "\nSIN TITULO/";
    //     $sum++;
    //     $desc=$description;
    // }

    //echo "Entry: ".$entryId." titulo: ".$desc." description: ".$description." tags: ".$tags." Programa: ".$programa."\n\n";
    //echo "<br>";
    //echo "<br>";
    
    //$cadena= array("name"=>$desc, "description"=>$description, "tags"=>$tags, "Programa"=>$programa);
    $cadena= array("programa"=>$programa, "Programa"=>$programa);
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
      
      echo $asset['external_id']."/Metadata Cambiada\n";
    }
    
  }
    echo "Total sin título: ".$sum;
    echo "<br>";
    echo "Total General: ".$sumGeneral;

?>