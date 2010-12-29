<?php
    include 'music.php';
    $songs = new MusicLibrary();
	
	$songs->getFilesFromFolder($songs->libraryPath);
	$songs->readTags($songs->songFiles);
	$songs->saveDb();	

    header('Location: ' . $songs->url);

