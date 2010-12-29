MUSIC - Web application to share and listen music


Features
---------------------------------------------------------------
F1 - Listen music
F2 - Upload new songs
F3 - Download songs/albums
F4 - Organize songs
F5 - Notify new entries/changes


Version 0.1
---------------------------------------------------------------
//F1 Research what's a good system to listen to music from a server to a web browser.
//F1 Read current songs from file/xml/db (decide what)
    //Map id3 info to array (artist/album/track number/song)
    //Save this array to a file
    //Convert this array to json and send to template
    //Open file and eval array
//F1 Batch: rename all files with a valid url name?
//F1 Show files on web and make them playable
    //Install jQuery
    //Read the array and create links/table
    //Create events in every link to play music
    //Build the player functions


Version 0.2
---------------------------------------------------------------
F2 Find a good system to upload files to a server through a web interface
F2 Update music database with new entries
F5 Notify users via email


Version 0.3
---------------------------------------------------------------
F3 Download selected songs/albums to the client


Version 0.4
---------------------------------------------------------------
F4 Modify songs id3 tags in an easy way
F5 Notify users with the changes (daily mail)





Command to convert to mp3
---------------------------------------------------------------
ffmpeg -i 01_Lump.m4a -vn -acodec libmp3lame -ar 44100 -ac 2 -ab 128000 name_file.mp3

Command to replace white spaces
---------------------------------------------------------------
rename 's/ /_/g' *
