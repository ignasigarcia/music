<?php
	include 'music.php';
    $songs = new MusicLibrary();
	$songs->readDb();
?>
<html>
<head>
	<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.7.custom.css" type="text/css" media="all" />
	<link rel="stylesheet" href="css/google_wave.css" type="text/css" media="all" />

	<style>
		body { width: 705px; margin: 0 auto;}
		#feedback { font-size: 1em; }
		#selectable .ui-selecting { background: #FECA40; }
		#selectable .ui-selected { background: #F39814; color: white; }
		#selectable { list-style-type: none; margin: 0; padding: 0; width: 60%; width: 700px;}
		#selectable li { margin: 0px; padding: 0.2em; font-size: 1em; height: 18px; cursor: pointer; }
		.song { cursor: pointer; }
		.content { height: 500px; }
	</style>
</head>
<body>

<a href="<?php echo $songs->url?>scan.php">Scan Library</a>
<br>
<audio id="player" alt="" src="#" controls autobuffer></audio>

<div class="content">
	<ol id="selectable">
	</ol>
</div>
<script type="text/javascript" src="jquery-1.4.4.js"></script>
<script type="text/javascript" src="jquery.music_userlikeyou.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.7.custom.min.js"></script>
<script type="text/javascript" src="js/mousewheel.js"></script>
<script type="text/javascript" src="js/gwave-scroll-pane-0.1.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		var songs = <?php echo $songs->getJson()?>;
		var player = document.getElementById('player');
		var currentSong = 0;

		$.each(songs, function(songN, value) {
			$('#selectable').append('<li class="ui-widget-content" id="' + songN + '">' + value[0] + ' | ' + value[1] + ' | ' + value[3] + '</li>');
		});

		$(function() {
			$( "#selectable" ).selectable({
				stop: function() {
					var result = $( "#select-result" ).empty();
					$( ".ui-selected", this ).each(function() {
						play(this.id);
					});
				}
			});
		});

		function play(songId) {
			currentSong = songId;
			player.src = songs[songId][4];
			player.load();	
			player.play();	
		}
		
		player.addEventListener("ended", function() {
			$('.ui-selectee').each( function(key, value) {
				if ($(this).hasClass('ui-selected'))
				{
					$(this).removeClass('ui-selected');
					$('.ui-selectee:eq('+parseInt(key+1)+')').addClass('ui-selected');
					return false;
				}
			});
			play(parseInt(currentSong) + 1);
		});
			
	});

	$(function() {
		$( "#selectable" ).selectable();
	});

	$(function(){
		$('.content').gWaveScrollPane();
	});
</script>
<br>
<br>
<form action="upload.php" method="post" enctype="multipart/form-data">
	<input type="file" name="file">
	<input type="submit" value="upload">
</form>
</body>
</html>
