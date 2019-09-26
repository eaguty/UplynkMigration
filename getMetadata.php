<?php

include('configDeportes.php');

$json= Call('/api2/asset/get', array('external_id'=>'1_3muk749h'));
$obj = json_decode($json);
$array=(array) $obj;
//print_r($array);
$asset=(array) $array['asset'];
//print_r($asset);
$metadata=(array) $asset['meta'];
//print_r($metadata);

$description = "FACUNDO";

/*
$canal = $metadata['canal'];
$access_control_id = $metadata['access_control_id'];
$access_control_id = "1517041";
$capitulo = $metadata['capitulo'];
//$description = $metadata['description'];
$description = "FACUNDO";
$end_date = $metadata['end_date'];
$tags = $metadata['tags'];
$created_at = $metadata['created_at'];
$created_at="1529299545";
$updated_at = $metadata['updated_at'];
$updated_at ="1562043535";
$file = $metadata['file'];  
$file = "http://tvaz-pd.kaltura.com.edgesuite.net/p/931901/sp/0/playManifest/entryId/1_3muk749h/format/url/flavorParamIds/694542/video.mp4";
$tipo_de_video = $metadata['tipo_de_video'];
$thumbnailUrl = $metadata['thumbnailUrl'];
$kaltura_account_id = $metadata['kaltura_account_id'];
$kaltura_account_id = "931901";
$start_date = $metadata['start_date'];
$categories = $metadata['categories'];
$categories= "PROGRAMA_SIN_CATEGORIA";


$cadena= array(
  "canal"=> $canal, 
  "access_control_id"=>$access_control_id, 
  "capitulo"=> $capitulo, 
  "description"=> $description, 
  "end_date"=> $end_date, 
  "tags"=> $tags, 
  "created_at"=> $created_at, 
  "updated_at"=> $updated_at, 
  "file"=>$file, 
  "tipo_de_video"=> $tipo_de_video,
  "thumbnailUrl" => $thumbnailUrl,
  "kaltura_account_id"=> $kaltura_account_id,
  "start_date"=> $start_date, 
  "categories"=> $categories);
*/

  $cadena= array("description"=>$description);

$cadena=array();
$meta=json_encode($cadena);

$json= Call('/api2/asset/update', array('meta'=>$cadena,'external_id'=>'1_3muk749h'));
$obj = json_decode($json);
if($obj->error!=0){
  echo $obj->msg."\n";
}
else{

  $asset=(array) $obj->asset;
  echo '<pre>';
  echo "\nID MODIFICADO: ".$asset['id'];
  echo '<pre>';
  echo "\nID MODIFICADO: ".$asset['external_id'];
  /*foreach ($obj->asset as $asset) {
      echo '<pre>';
      //print_r($asset);
      echo $asset->id;
      echo '</pre>';
    }*/
}

$json2 = Call('/api2/asset/update', array('desc'=>'FACUNDO','external_id'=>'1_3muk749h'));
$obj = json_decode($json2);
if($obj->error!=0){
  echo $obj->msg."\n";
}
else{

  $asset=(array) $obj->asset;
  echo '<pre>';
  echo "\nID MODIFICADO: ".$asset['id'];
  echo '<pre>';
  echo "\nID MODIFICADO: ".$asset['external_id'];
  /*foreach ($obj->asset as $asset) {
      echo '<pre>';
      //print_r($asset);
      echo $asset->id;
      echo '</pre>';
    }*/
}

?>