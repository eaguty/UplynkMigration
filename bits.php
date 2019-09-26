<?php

try {
	$im = file_get_contents('https://static.azteca.com/imagenes/2019/24/pblicovla-2325819.jpg');
$imdata = base64_encode($im);
echo $imdata;
} catch (Exception $e) {
	echo $e;
}
/*
$im = file_get_contents('http://static.azteca.com/imagenes/2019/24/2325855-bisagra-entre-dos-Ãƒâ€°pocas.jpg');
$imdata = base64_encode($im);
echo $imdata;
*/
echo "<img src='data:image/jpg;base64,".$imdata."' />";
?>