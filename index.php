<html>
<head>
</head>
<body>

<h1 id="now_playing"></h1>
<audio id="player" alt="" src="#" controls autobuffer></audio>

<?
/*require_once('getid3/getid3.php');
$getID3 = new getID3;*/
$library_path = 'Music/';
$songs=new RecursiveDirectoryIterator($library_path);
echo "<ul>";
$i = 0;
foreach (new RecursiveIteratorIterator($songs) as $filename=>$cur) { 
		/*$song_info = $getID3->analyze($filename);
		getid3_lib::CopyTagsToComments($song_info);*/
?>
	<li style="list-style-type:none;">
		<img id="icon<?php echo $i ?>" style="display:none" src="media-playback-start.png">
		<a id="<?php echo $i ?>" onclick="play_song(this.id);" href="#">
			<?php echo $filename ?>
		</a>
		<b><? //echo $song_info['comments_html']['artist'][0] ?></b>
	</li>
<? 
	$i++;
}
echo "</ul>";
?>

<script type="text/javascript">

var PLAYING = 1;
var STOPPED = 0;

var player = {
	player: "",
	song_id: "",
	song_name: "",
	last_song_id: "",
	status: STOPPED
}

player.player = document.getElementById('player');

player.player.addEventListener("ended", function() {
		var next_song = parseInt(player.song_id) + 1;
		play_song(next_song);
}, true);  

function play_song(song_id) {
		var song_name = document.getElementById(song_id).innerHTML;
		
		if (player.status == PLAYING)
			player.last_song_id = player.song_id;

		player.song_id = song_id;
		player.song_name = song_name;
		player.player.src = song_name;		

		update_displays();

		player.player.load();
		player.player.play();

		player.status = PLAYING;
}

function update_displays() {
		var now_playing = document.getElementById('now_playing');

		if (player.status == PLAYING) {
			hide_item('icon' + player.last_song_id);
		}
		show_item('icon' + player.song_id);
		now_playing.innerHTML = "Now playing " + player.song_name;
}

function show_item(item) {
	document.getElementById(item).style.display = 'inline';
}

function hide_item(item) {
	document.getElementById(item).style.display = 'none';
}

</script>

</body>
</html>
