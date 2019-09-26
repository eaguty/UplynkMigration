<?php
include('configAdn40.php');
$linea="vorrar";
try {
    	$json= Call('/api2/asset/list', array('search'=>$linea));
    	$obj = json_decode($json);
    	
    	$sum=0;
        $id=1;
        $cadena="";
        foreach ($obj->assets as $asset) {
            //print_r($asset);
            $cadena=$cadena."id".$id."/".$asset->id."/";
            echo $asset->id."\n";
            $sum++;
            $id++;
        }
        echo 'Total Respuestas: '.$sum;
            //echo "Entry/".$linea."/VerizonIDs/".$cadena."\n";
        /*if($sum>=2)
        {
        }*/
    	
    	//$meta=json_decode($obj);
    	//echo "<br>".$meta->{'external_id'}."<br>".$meta->{'name'};

	} catch (Exception $e) {
    	echo 'Excepción capturada: ',  $e->getMessage(), "\n";
	}

?>