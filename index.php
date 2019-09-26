<?php
$ROOT_URL = 'http://services.uplynk.com';
//Cuenta de entretenimiento
//$OWNER = '9046134590574d34a859a4b9b1ccadff';
//$SECRET = 'dLHMS9dPGlERJdfUKYYAxO/q/mIOvBFG6IXNGXfB';

//Cuenta de deportes
$OWNER = '0f5525d292394189a8805547edadbb43';
$SECRET = 'rUIWIKQn5oFg5aRJpBHKMIcyHRhrSWLDkHYegRI9';
 
function encode_array($args)
{
  if(!is_array($args)) return false;
  $c = 0;
  $out = '';
  foreach($args as $name => $value)
  {
    if($c++ != 0) $out .= '&';
    $out .= urlencode("$name").'=';
    if(is_array($value))
    {
      $out .= urlencode(serialize($value));
    }else{
      $out .= urlencode("$value");
    }
  }
  return $out . "\n";
}
 
function Call($uri, $msg=array())
{
    global $ROOT_URL, $OWNER, $SECRET;
 
    $msg['_owner'] = $OWNER;
    $msg['_timestamp'] = time();
    $msg = json_encode($msg);
    $msg = base64_encode(gzcompress($msg,9));
    $sig = hash_hmac('sha256', $msg, $SECRET);
    $sig = trim($sig);
    $body = encode_array(array('msg'=>$msg, 'sig'=>$sig));
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ROOT_URL . $uri);
    curl_setopt($ch, CURLOPT_POST,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    $result = curl_exec($ch);

    curl_close($ch);
    return $result;
}

// Convertir imagen a 64 bits.
//$im = file_get_contents('logo.png');
//$imdata = base64_encode($im);

//Buscar 'mon' en los 3 primeros videos
//echo Call('/api2/asset/list/', array('search'=>'mon', 'order'=>'created', 'limit'=>'3'));

//Editar el post image con una imagen de 64 bits
//echo Call('/api2/asset/update', array('poster_img'=>$imdata, 'external_id'=>'0_b29f9cdm'));

//Listar videos skip 0 == a no saltar ningun video, Skip 100 == a saltar los primeros 100 videos
//$respuesta=Call('/api2/asset/list', array('skip'=>0, 'order'=>'-created', 'limit'=>2));

//Listar los videos que tienen 0_py5gcsyi en su meta data
//$json= Call('/api2/asset/list', array('search'=>'0_y2erdz1l'));
//$json= Call('/api2/asset/list', array('limit'=>10));


$cadena=array("Programa"=>"","tipo_de_video"=>"","capitulo"=>"","Canal"=>"","name"=>"","description"=>"Prueba de Facundo","tags"=>"","categories"=>"","created_at"=>"","updated_at"=>"","access_control_id"=> "","start_date"=> "","end_date"=> "");



//echo $cadena;
$meta=json_encode($cadena);

$json= Call('/api2/asset/update', array('meta'=>$meta,'id'=>'831f1dcdd0254724983b1cebc29a1cb6'));
$obj = json_decode($json);
//echo $obj->assets->test_players;
if($obj->error!=0){
  echo $obj->msg."\n";
}
else{
//var_dump(get_object_vars($obj));
//print_r($obj);
/*$sum=0;
*/
  foreach ($obj as $asset) {
      echo '<pre>';
      print_r($asset);
      //echo $asset->id;
      echo '</pre>';
    }
}
    /*$metadata=json_decode($asset->meta);
    foreach ($metadata as $meta) {
      echo '<pre>';
      echo $meta->canal;
      echo '</pre>';
    }
    $sum++;
}
echo 'Total Respuestas: '.$sum;*/
