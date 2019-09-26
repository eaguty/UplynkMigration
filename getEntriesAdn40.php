<?php
include('configAdn40.php');

$bandera=true;
$sum=0;
$skip=0;
while($bandera)
{
	try {
    	$json= Call('/api2/asset/list', array('skip'=>$skip));
    	$obj = json_decode($json);
        foreach ($obj->assets as $asset) {
            echo $asset->external_id."\n";
            $sum++;
        }
        $skip=$skip+100;
        if($sum!=$skip)
        {
            $bandera=false;
        }


	} catch (Exception $e) {
    	echo 'Excepción capturada: ',  $e->getMessage(), "\n";
	}
}
echo "\n Proceso Finalizado!!!!\n";
?>