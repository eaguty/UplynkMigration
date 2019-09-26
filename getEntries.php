<?php
//include('configDeportes.php');
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
            //$cadena=$cadena."id".$id."/".$asset->id."/";
            if($asset->external_id!="" && $asset->external_id!="vorrar")
            echo $asset->external_id."\n";
            $sum++;
        }
        //echo 'Total Respuestas: '.$sum;
        $skip=$skip+100;
        if($sum!=$skip)
        {
            $bandera=false;
        }
    	//echo "\nTotal de resultados: ".$sum;
    	//$meta=json_decode($obj);
    	//echo "<br>".$meta->{'external_id'}."<br>".$meta->{'name'};

	} catch (Exception $e) {
    	echo 'Excepción capturada: ',  $e->getMessage(), "\n";
	}
}
echo "\n Proceso Finalizado!!!!\n";
?>