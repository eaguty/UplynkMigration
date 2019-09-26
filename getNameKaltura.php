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
/*
$file = fopen("entriesKaltura.txt", "r") or exit("Unable to open file!");
while(!feof($file))
{
	$entryId=trim(fgets($file));
	$version = -1;

	try 
	{
		$result = $client->media->get($entryId, $version);
		$result = $client->mediaInfo->listAction($filter, $pager);
	    //var_dump($result);
	    $media=new KalturaMediaEntry($result);
	    //echo "\n".htmlspecialchars($media->name)."\n";
	    echo "Entry/".$entryId."/Encontrado\n";
	} 
	catch (Exception $e) 
	{
	    echo "Entry/".$entryId."/".$e->getMessage()."\n";
	}
}
fclose($file);
*/
  $metadataPlugin = KalturaMetadataClientPlugin::get($client);
  $filter = new KalturaMetadataFilter();
  $filter->metadataProfileIdEqual = 2122;
  $filter->objectIdEqual = "0_l69lvr6d";
  $pager = new KalturaFilterPager();

  try {
    $result = $metadataPlugin->metadata->listAction($filter, $pager);
    var_dump($result);
  } catch (Exception $e) {
    echo $e->getMessage();
  }
?>