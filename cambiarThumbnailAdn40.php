<?php
include('configAdn40.php');

$file = fopen("entriesADN40.txt", "r") or exit("Unable to open file!");
while(!feof($file))
{
	$lineas=trim(fgets($file));
    $entryId=$lineas;
    $image="ImaADN40/".$entryId.".jpg";
    try {
        $im = file_get_contents($image);
        $imdata = base64_encode($im);
        if($imdata !=null){
            $json = Call('/api2/asset/update', array('poster_img'=>$imdata, 'external_id'=>$entryId));
            $obj = json_decode($json);
            
        	if($obj->{'error'}==0)
        	{
        		echo $entryId."/exito\n";
        	}
        	else
        	{
        		echo $entryId."/".$obj->{'msg'}."\n";
        	}
        }
        else{
            echo $entryId."/Con error\n";
        }

	} catch (Exception $e) {
    	$msg = $ex->getMessage() . $ex->getTraceAsString();
	}
}
fclose($file);
echo "\n Proceso Finalizado!!!!\n";


?>