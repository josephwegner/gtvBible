<?
	$query = $_POST['query'];

	$url = "http://www.esvapi.org/v2/rest/passageQuery?key=IP&".
		"include-passage-references=0&include-footnotes=0&".
		"include-short-copyright=0&passage=".urlencode($query);
	
	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	$verseXML = curl_exec($ch);
	curl_close($ch);

	echo $verseXML;
?>
