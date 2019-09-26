<?php

include('configDeportes.php');

$ruta_xml="capitulos_deportes.xml";
$carga_xml = simplexml_load_file( $ruta_xml);
//echo $xml->rows;

foreach ($carga_xml->Rows as $nodo) 
  {
    $entryId = trim($nodo->ID);
//    $desc= eliminar_simbolos(utf8_decode($nodo->TITLE));
    $desc= eliminar_simbolos($nodo->TITLE);
    //$description = eliminar_simbolos(utf8_decode($nodo->DESCRIPTION));
    $description = eliminar_simbolos($nodo->DESCRIPTION);
    //$tags = eliminar_simbolos(utf8_decode($nodo->KEYWORDS));
    $tags = eliminar_simbolos($nodo->KEYWORDS);
    /*echo "\n";
    echo $entryId;
    echo "\n";
    echo $desc;
    echo "\n";
    echo $description;
    echo "\n";
    echo $tags;
    echo "\n";
*/
    
    $cadena= array("description"=>$description, "tags"=>$tags);
    $meta=json_encode($cadena);
    $json= Call('/api2/asset/update', array('meta'=>$meta,'external_id'=>$entryId));
    $obj = json_decode($json);
    if($obj->error!=0)
    {
      echo "EntryId: ".$entryId."-".$obj->msg."\n";
    }
    else
    {

      $asset=(array) $obj->asset;
      echo "\nID MODIFICADO (Descripcion y Tags): ".$asset['id'];
      echo "\nExternal_ID MODIFICADO (Descripcion y Tags):".$asset['external_id'];
    }

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
      echo "\nExternal_ID MODIFICADO (Asset_Name): ".$asset2['external_id']."\n";
    }
  }


function eliminar_simbolos($string){
 
    $string = trim($string);
 
    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );
 
    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );
 
    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );
 
    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );
 
    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );
 
    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C',),
        $string
    );
 
    $string = str_replace(
        array("\\", "¨", "º", "-", "~",
             "#", "@", "|", "!", "\"",
             "·", "$", "%", "&", "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "<code>", "]",
             "+", "}", "{", "¨", "´",
             ">", "< ", ";", ",", ":",
             ".", " "),
        ' ',
        $string
    );
return $string;
} 


?>