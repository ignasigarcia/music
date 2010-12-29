<?php
Class MusicLibrary {

	public $url;
    public $libraryPath;
    public $songDb;
    public $songFiles;
    public $songTags;

    function __construct()
    {
		$this->url = 'http://localhost/~tas/music/';
        $this->libraryPath = 'userlikeyou_music/';
        $this->songDb = 'Library.dat';
        $this->songFiles = array();
        $this->songTags = array();
    }

    function getFilesFromFolder($path)
    {
        $files = new RecursiveDirectoryIterator($path);

        foreach (new RecursiveIteratorIterator($files) as $filename => $cur) { 
            if (is_file($filename)) {
                $this->songFiles[] = realpath($filename);
			}
        }
    }

    function readTags($songs)
    {
        require_once('getid3/getid3.php');

        $songInfo = array();
        $getID3 = new getID3;
	
        foreach ($songs as $song)
        {
            $songInfo = $getID3->analyze($song);
            getid3_lib::CopyTagsToComments($songInfo);

            $artist = implode($songInfo['comments_html']['artist']);
            $album = implode($songInfo['comments_html']['album']);
            $title = implode($songInfo['comments_html']['title']);
            $track_number = preg_replace('/\/[0-9]+$/', '', implode($songInfo['comments_html']['track_number']));
			$publicPath = preg_replace('/.+userlikeyou_music/', $this->url . $this->libraryPath, $song);

			$this->songTags[] = array($artist, $album, $track_number, $title, $publicPath);
			sort($this->songTags);
        }
    }

   function saveDb()
   {

        $file = fopen($this->songDb, 'w');
        if (fwrite($file, '$this->songTags = '.var_export($this->songTags, TRUE).';'))
        fclose($file);
   } 

   function getJson()
   {
	   return json_encode($this->songTags);
   }

   function readDb()
   {
        $file = fopen($this->songDb, 'r');
		eval(fread($file, filesize($this->songDb)));
        fclose($file);
   }
}
