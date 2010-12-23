<?php

Class MusicLibrary {

    public $libraryPath;
    public $library;

    function __construct()
    {
        $this->libraryPath = 'Music/';
        $this->library = array();

        $files = new RecursiveDirectoryIterator($this->libraryPath);

        echo '<pre>';
        foreach (new RecursiveIteratorIterator($files) as $filename => $cur) { 
            if (is_file($filename))
                var_dump(pathinfo($filename));
        }
    }

    
}
