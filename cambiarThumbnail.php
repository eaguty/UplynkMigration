<?php
include('configDeportes.php');

//echo Call('/api2/asset/list/', array('search'=>'mon', 'order'=>'created', 'limit'=>'3'));
//echo Call('/api2/asset/update', array('poster_img'=>$imdata, 'external_id'=>'0_b29f9cdm'));

set_error_handler("myFunctionErrorHandler", E_WARNING);
set_error_handler("myFunctionErrorHandler", E_NOTICE);

$file = fopen("entriesADN40.txt", "r") or exit("Unable to open file!");
//Output a line of the file until the end is reached
while(!feof($file))
{
	$lineas=trim(fgets($file));
    //$lineas=fgets($file);
    $linea=explode("¬",$lineas);
    $entryId=$linea[0];
    $image=$linea[1];
    try {
        $im = file_get_contents($image);
        $imdata = base64_encode($im);
        if($imdata !=null){
            $json = Call('/api2/asset/update', array('poster_img'=>$imdata, 'external_id'=>$entryId));
            $obj = json_decode($json);
            
        	if($obj->{'error'}==0)
        	{
        		echo "Entry: ".$entryId."/exito\n";
                //echo "operación exitosa\n";
        	}
        	else
        	{
        		echo "Entry: ".$entryId."/".$obj->{'msg'}."\n";
        	}
        }
        else{
            echo "Entry: ".$entryId."/Con error\n";
        }
        /*
    	*/
    	//$meta=json_decode($obj);
    	//echo "<br>".$meta->{'external_id'}."<br>".$meta->{'name'};

	} catch (Exception $e) {
    	$msg = $ex->getMessage() . $ex->getTraceAsString();
            /* guardamos en el log de errores nuestro error, warning o notice */
            error_log('ELASTICSEARCH ERROR: ' . $msg);
	}
    restore_error_handler();
}
fclose($file);
echo "\n Proceso Finalizado!!!!\n";

function myFunctionErrorHandler($errno, $errstr, $errfile, $errline)
{
    /* Según el típo de error, lo procesamos */
    switch ($errno) {
       case E_WARNING:
                echo "Hay un WARNING.<br />\n";
                echo "El warning es: ". $errstr ."<br />\n";
                echo "El fichero donde se ha producido el warning es: ". $errfile ."<br />\n";
                echo "La línea donde se ha producido el warning es: ". $errline ."<br />\n";
                /* No ejecutar el gestor de errores interno de PHP, hacemos que lo pueda procesar un try catch */
                return true;
                break;
            
            case E_NOTICE:
                echo "Hay un NOTICE:<br />\n";
                /* No ejecutar el gestor de errores interno de PHP, hacemos que lo pueda procesar un try catch */
                return true;
                break;
            
            default:
                /* Ejecuta el gestor de errores interno de PHP */
                return false;
                break;
            }
    }


?>