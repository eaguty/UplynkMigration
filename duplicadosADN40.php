<?php

//echo Call('/api2/asset/list/', array('search'=>'mon', 'order'=>'created', 'limit'=>'3'));
//echo Call('/api2/asset/update', array('poster_img'=>$imdata, 'external_id'=>'0_b29f9cdm'));

include('configAdn40.php');
$ruta_xml="files/adn40_3.xml";

$carga_xml = simplexml_load_file( $ruta_xml);
//echo $xml->rows;
$sum=0;
$sumGeneral=0;
foreach ($carga_xml->Video as $nodo) {


	$entryId = trim($nodo->Id);
	try {
    	$json= Call('/api2/asset/list', array('search'=>$entryId));
    	$obj = json_decode($json);
    	
    	$sum=0;
        $id=1;
        $str="";
        foreach ($obj->assets as $asset) {
            //print_r($asset);
            $str=$str."id".$id."/".$asset->id."/";
            //echo $asset->id;
            $sum++;
            $id++;
        }
        //echo 'Total Respuestas: '.$sum;
        if($sum>=2)
        {
            echo "Entry/".$entryId."/VerizonIDs/".$str."\n";
        }
    	
    	//$meta=json_decode($obj);
    	//echo "<br>".$meta->{'external_id'}."<br>".$meta->{'name'};

	} catch (Exception $e) {
    	echo 'Excepción capturada: ',  $e->getMessage(), "\n";
	}
}
echo "\n Proceso Finalizado!!!!\n";
?>