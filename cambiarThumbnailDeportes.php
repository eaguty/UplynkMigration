<?php
include('configDeportes.php');

//echo Call('/api2/asset/list/', array('search'=>'mon', 'order'=>'created', 'limit'=>'3'));
//echo Call('/api2/asset/update', array('poster_img'=>$imdata, 'external_id'=>'0_b29f9cdm'));


$file = fopen("files/entriesDeportes.txt", "r") or exit("Unable to open file!");
//Output a line of the file until the end is reached
while(!feof($file))
{
	$lineas=trim(fgets($file));
    $entryId=$lineas;
    $image="ImaDeportes/".$lineas.".jpg";
    try {
        $im = file_get_contents($image);
        $imdata = base64_encode($im);
        if($imdata !=null){
            $json = Call('/api2/asset/update', array('poster_img'=>$imdata, 'external_id'=>$entryId));
            $obj = json_decode($json);
            
        	if($obj->{'error'}==0)
        	{
        		echo "Entry/".$entryId."/exito\n";
        	}
        	else
        	{
        		echo "Entry/".$entryId."/".$obj->{'msg'}."\n";
        	}
        }
        else{
            echo "Entry/".$entryId."/Con error\n";
        }

	} catch (Exception $e) {
    	$msg = $ex->getMessage() . $ex->getTraceAsString();
        echo $msg;
	}
}
fclose($file);
echo "\n Proceso Finalizado!!!!\n";


?>