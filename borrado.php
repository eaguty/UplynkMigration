<?php

include('configDeportes.php');

$file = fopen("BorrarDeportes2.txt", "r") or exit("Unable to open file!");
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
        //var_dump(get_object_vars($obj));
        //print_r($obj);
        //$sum=0;
        
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