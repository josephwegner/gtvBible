<!DOCTYPE html !>

<html>
<head>
<title>gtvBible</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("form#searchForm").submit(function(e) {
		e.preventDefault();

		query = $("#query").val();

		$.ajax({
			type: "POST",
			url: "getVerse.php",
			data: { "query": query },
			success: function(msg) {
				var xml = $.parseXML(msg);
				
				var verses = "";
				
				$(xml).find("item").each(function() {
					verses += "<span class='verseNum'>" + $(this).find("verse").text() + "</span> ";
					verses += "<span class='verseText'>" + $(this).find("text").text() + "</span>  ";
				});

				$("#verseHolder").html(verses);
			},
			error: function(msg) {
				alert(msg);
			}
		});
	});
});
</script>
</head>
<body>
	<form id="searchForm" name="searchVerses" action="#" type="POST">
		<input type="text" name="query" id="query" placeholder="eg. Isaiah 1:10" />
	</form>
	<div id="verseHolder"></div>
</body>
</html>
