<?php
$ROOT_URL = 'http://services.uplynk.com';
//Cuenta de ADN40
//$OWNER = '8b8eb4009bd14de4aa6068580e2c3083';
//$SECRET = 'zORRlabymQmnc7/7cyweOBco5TM7rZwR1PnxCfjT';

//Cuenta de Deportes
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


$file = fopen("Modificar.txt", "r") or exit("Unable to open file!");
//Output a line of the file until the end is reached
while(!feof($file))
{
      $linea=trim(fgets($file));
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
      }
}
fclose($file);
echo "\n Proceso Finalizado!!!!\n";
?>