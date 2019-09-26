<?php
include('configAzteca.php');


$file = fopen("metadataAzteca.txt", "r") or exit("Unable to open file!");
//Output a line of the file until the end is reached
$metadata= array();
while(!feof($file))
{
  $lineas=fgets($file);
  $linea=explode("¬",$lineas);
  $entryId=$linea[0];
  //$metadata["entry"]=$linea[0];
  $metadata["Programa"]=htmlspecialchars($linea[1]);
  $metadata["tipo_de_video"]=htmlspecialchars($linea[2]);
  $metadata["capitulo"]=htmlspecialchars($linea[3]);
  $metadata["canal"]=htmlspecialchars($linea[4]);
  $metadata["name"]=htmlspecialchars($linea[5]);
  $metadata["description"]=htmlspecialchars($linea[6]);
  $metadata["tags"]=$linea[7];
  $metadata["categories"]=revisar($linea[8]);
  $metadata["created_at"]=htmlspecialchars($linea[9]);
  $metadata["updated_at"]=htmlspecialchars($linea[10]);
  $metadata["access_control_id"]=htmlspecialchars($linea[11]);
  $metadata["start_date"]=htmlspecialchars($linea[12]);
  $metadata["end_date"]=htmlspecialchars($linea[13]);

  $meta=json_encode($metadata);

  $json= Call('/api2/asset/update', array('meta'=>$meta,'external_id'=>$entryId));
  $obj = json_decode($json);
  if($obj->error!=0)
  {
    echo "EntryId: ".$entryId."-".$obj->msg."\n";
  }
  else
  {
    $asset=(array) $obj->asset;
    echo "\nID MODIFICADO: ".$asset['id'];
    echo "\nExternal_ID MODIFICADO:".$asset['external_id'];
  }

      //var_dump($meta);

}
fclose($file);

function revisar($string){

  $string = trim($string);
  $palabras=explode(">", $string);
  $cadena="";
  foreach ($palabras as $palabra) {
    $cadena=$cadena.htmlspecialchars($palabra).">";
  }
  $cadena=substr ($cadena, 0, strlen($cadena) - 1);
  return $cadena;

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
             "< ", ";", ",", ":",
             ".", " "),
        ' ',
        $string
    );
return $string;
} 
//var_dump($metadata);
//echo "\n Proceso Finalizado!!!!\n";






      /*

      array_push($pila, "manzana", "arándano");
      Entry Id (Kaltura)

      Programa
      tipo_de_video
      capitulo
      canal
      name
      description
      tags
      categories
      created_at
      updated_at
      access_control_id
      start_date
      end_date





      try {
      $json= Call('/api2/asset/delete', array('ids'=>[$linea]));
        $obj = json_decode($json);
        //echo $obj->assets->test_players;
        if($obj->error!=0){
          echo $obj->msg."\n";
        }
        else{
          foreach ($obj->deleted as $asset) {
              print_r($asset);
            }
        }

      } catch (Exception $e) {
      echo 'Excepción capturada: ',  $e->getMessage(), "\n";
      }*/
?>