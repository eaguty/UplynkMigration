<?php
 require_once('lib/KalturaClient.php');

  $config = new KalturaConfiguration(931901);
  $config->serviceUrl = 'http://www.kaltura.com';
  $client = new KalturaClient($config);
  $ks = $client->session->start(
    "79bca0d8589e11e09c06d06704f25f26",
    "fmendozav@tvazteca.com.mx",
    KalturaSessionType::ADMIN,
    931901);
  $client->setKS($ks);

$file = fopen("entriesXMLFaltantes1.txt", "r") or exit("Unable to open file!");
while(!feof($file))
{
	$entryId=trim(fgets($file));
	$version = -1;

	try 
	{
		$result = $client->media->get($entryId, $version);
	    //var_dump($result);
	    $media=new KalturaMediaEntry($result);
	    $createdAt = new DateTime();
		$createdAt->setTimestamp($media->createdAt);
		//echo $createdAt->format('U = Y-m-d H:i:s') . "\n";
		$updatedAt = new DateTime();
		$updatedAt->setTimestamp($media->updatedAt);
		//echo $updatedAt->format('U = Y-m-d H:i:s') . "\n";
	    //echo "Entry/".$media->id."/CreatedAt/".$createdAt->format('Y-m-d-H:i:s')."/updatedAt/".$updatedAt->format('Y-m-d-H:i:s')."\n";
	    echo htmlspecialchars($media->name);

	} 
	catch (Exception $e) 
	{
	    echo "Entry/".$entryId."/".$e->getMessage()."\n";
	}
}
fclose($file);
?>