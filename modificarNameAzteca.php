<?php
include('configAzteca.php');


$file = fopen("metadataAzteca.txt", "r") or exit("Unable to open file!");
//Output a line of the file until the end is reached

$desc="";
while(!feof($file))
{
  $lineas=fgets($file);
  $linea=explode("¬",$lineas);
  $entryId=$linea[0];
  $desc=htmlspecialchars($linea[5]);
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
fclose($file);


?>