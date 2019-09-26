<?php

include('configAdn40.php');

try {
    	$json= Call('/api2/asset/delete', array('ids'=>'7c5d219373bd46d5bc2b22442fb17c73'));
        $obj = json_decode($json);
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


?>