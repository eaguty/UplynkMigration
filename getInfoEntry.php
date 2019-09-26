<?php
//include('configAzteca.php');
	
function buscarAssetInfo($external_id)
{
	$json = Call('/api2/asset/update', array('external_id'=>$external_id));
	$obj = json_decode($json);
	//print_r($obj);
	if($obj->{'error'}==0)
	    {
	        $cadena="";
	        $asset=(array) $obj->asset;
	        $cadena=$cadena.$asset['id']."/".$asset['external_id']."/".$asset['created'];
	        //echo "\nID Asset: ".$asset['id'];
	        //echo "\nID EntryId: ".$asset['external_id'];
	        //$fecha = date_create();
	        //date(Y-m-d H:i:s, (int)$asset['created']);
	        /*$timestamp=(int) $asset['created'] / 1000;
	        echo "\nINT: ".$timestamp;
	        echo "\nSTRING: ".$asset['created'];
	        echo "\nFecha Creacion: ".date('Y-m-d', $asset['created'])."\n";*/

			$meta=(array) $asset['meta'];
			//echo "\nPrograma: ".$meta['Programa']."\n";
			if (array_key_exists('Programa', $meta)) {
			    //echo "Programa/SI\n";
			    $cadena=$cadena."/SI/";
			}
			else{
				
				$cadena=$cadena."/NO/";
			}
			if (array_key_exists('programa', $meta)) {
			    $cadena=$cadena."/si/";
			}
			else{
				$cadena=$cadena."/no/";
			}
			echo $cadena."\n";

	    }
	else
	    {
	        
	        echo $obj->{'msg'}."\n";
	    }
}