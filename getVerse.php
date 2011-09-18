<?
	$query = $_POST['query'];

	$url = "http://api.preachingcentral.com/bible.php?passage=".urlencode($query);
	
	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	$verseXML = curl_exec($ch);
	curl_close($ch);

	echo $verseXML;
?>
