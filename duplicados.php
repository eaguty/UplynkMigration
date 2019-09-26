<?php
include('configDeportes.php');
//echo Call('/api2/asset/list/', array('search'=>'mon', 'order'=>'created', 'limit'=>'3'));
//echo Call('/api2/asset/update', array('poster_img'=>$imdata, 'external_id'=>'0_b29f9cdm'));

$file = fopen("deportes.txt", "r") or exit("Unable to open file!");
//Output a line of the file until the end is reached
while(!feof($file))
{
	$linea=trim(fgets($file));
	try {
    	$json= Call('/api2/asset/list', array('search'=>$linea));
    	$obj = json_decode($json);
    	
    	$sum=0;
        $id=1;
        $cadena="";
        foreach ($obj->assets as $asset) {
            //print_r($asset);
            $cadena=$cadena."id".$id."/".$asset->id."/";
            //echo $asset->id;
            $sum++;
            $id++;
        }
        //echo 'Total Respuestas: '.$sum;
        if($sum>=2)
        {
            echo "Entry/".$linea."/VerizonIDs/".$cadena."\n";
        }
    	
    	//$meta=json_decode($obj);
    	//echo "<br>".$meta->{'external_id'}."<br>".$meta->{'name'};

	} catch (Exception $e) {
    	echo 'Excepción capturada: ',  $e->getMessage(), "\n";
	}
}
fclose($file);
echo "\n Proceso Finalizado!!!!\n";
?>