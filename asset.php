<?php
//cuenta de Azteca
$ROOT_URL = 'http://services.uplynk.com';
$OWNER = '9046134590574d34a859a4b9b1ccadff';
$SECRET = 'dLHMS9dPGlERJdfUKYYAxO/q/mIOvBFG6IXNGXfB';
 
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

//echo Call('/api2/asset/list/', array('search'=>'mon', 'order'=>'created', 'limit'=>'3'));
//echo Call('/api2/asset/get', array('external_id'=>'0_xa1yhm0n'));

echo Call('/api2/asset/getthumbs', array('external_id'=>'0_b29f9cdm', 'start'=>'01:31.415'));

//poster_img=64bitimage
