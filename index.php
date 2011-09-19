<!DOCTYPE html !>

<html>
<head>
<title>gtvBible</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	var maxScroll = $("#verseHolder").height() - $("#verseWrap").height() + 40;
	var scrollChunk = Math.round($("#verseWrap").height() / 3);

	$("form#searchForm").submit(function(e) {

		e.preventDefault();

		query = $("#query").val();

		$.ajax({
			type: "POST",
			url: "getVerse.php",
			data: { "query": query },
			success: function(msg) {
			/*	var xml = $.parseXML(msg);
				
				var verses = "";
				
				$(xml).find("item").each(function() {
					verses += "<span class='verseNum'>" + $(this).find("verse").text() + "</span> ";
					verses += "<span class='verseText'>" + $(this).find("text").text() + "</span>  ";
				});

				$("#verseHolder").html(verses);
*/
				$("#verseHolder").html(msg);
				maxScroll = $("#verseHolder").height() - $("#verseWrap").height() + 40;
			},
			error: function(msg) {
				alert(msg);
			}
		});
	});
	
	$("body").keyup(function(e) {
		console.log(e.which);
		if(e.which == 38) {
			scrollUp(scrollChunk);
		} else if(e.which == 40) {
			scrollDown(scrollChunk, maxScroll);
		}
	});	
});
function scrollUp(chunk) {
	var curScroll = parseInt($("#verseHolder").css('margin-top')) * -1;
	console.log(curScroll + " " + chunk);
	if(curScroll < chunk && curScroll !== 0) {
		$("#verseHolder").stop().animate({'margin-top': 0}, 300);
	} else if(curScroll !== 0) {
		$("#verseHolder").stop().animate({'margin-top': (curScroll - chunk) * -1}, 300); 
	}
}

function scrollDown(chunk, maxScroll) {
	var curScroll = parseInt($("#verseHolder").css('margin-top')) * -1;
console.log(curScroll + " " + maxScroll + " " + chunk);
	if((maxScroll - curScroll) < chunk && (maxScroll - curScroll) !== 0) {
		$("#verseHolder").stop().animate({'margin-top': maxScroll * -1}, 300);
	} else if(maxScroll - curScroll !== 0) {
		$("#verseHolder").stop().animate({'margin-top': (curScroll + chunk) * -1}, 300);
	}
}
</script>
</head>
<body>
	<form id="searchForm" name="searchVerses" action="#" type="POST">
		<input type="text" name="query" id="query" placeholder="eg. Isaiah 1:10" />
	</form>
	<div id="verseWrap">
		<div id="verseHolder"></div>
	</div>
</body>
</html>
