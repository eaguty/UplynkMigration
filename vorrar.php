<?php
include('configAdn40.php');

try {
    $json= Call('/api2/asset/get', array('ids'=>"93b9d682e55743fb8005df03c3b07a4a"));
    $obj = json_decode($json);
    var_dump($obj);

} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}


echo "\n Proceso Finalizado!!!!\n";
?>