<?php

$ruta_xml="capitulos_deportes.xml";
$carga_xml = simplexml_load_file( $ruta_xml);
//echo $xml->rows;
$sum=0;
foreach ($carga_xml->Rows as $nodo) 
	{
	echo $nodo->ID."\n";
	/*echo utf8_decode($nodo->TITLE)."\n";
	echo utf8_decode($nodo->DESCRIPTION)."\n";
	echo utf8_decode($nodo->KEYWORDS)."\n";*/
	$sum++;
	}

	echo "total entries: ".$sum;


?>