<?php
include('configAzteca.php');

$file = fopen("entriesBuscar.txt", "r") or exit("Unable to open file!");
//Output a line of the file until the end is reached
while(!feof($file))
{
    $linea=trim(fgets($file));
    try {
        $json = Call('/api2/asset/update', array('external_id'=>$linea));
        $obj = json_decode($json);
        if($obj->{'error'}==0)
        {
            echo $linea."/Existe\n";
        }
        else
        {
            echo $linea."/";
            echo $obj->{'msg'}."\n";
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