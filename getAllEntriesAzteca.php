<?php
include('getInfoEntry.php');
include('configAzteca.php');

echo "INICIO!!!\n";
$bandera=true;
$sum=0;
$skip=0;
while($bandera)
{
	try {
    	$json= Call('/api2/asset/list', array('skip'=>$skip));
    	$obj = json_decode($json);
        
        foreach ($obj->assets as $asset) {
            if($asset->external_id!=null){
                //echo "Fila: ".$sum."\n";
                buscarAssetInfo($asset->external_id);
            }
            //echo "Fila: ".$sum."\n";
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
echo "\n Proceso Finalizado!!!! Total de assets analizados: ".$sum."\n";

?>