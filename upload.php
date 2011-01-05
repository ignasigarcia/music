<?php
if ($_FILES["file"]["type"] != "application/zip")
{
    if ($_FILES["file"]["error"] > 0)
    {
        echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
}
else
{
    move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
    echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
    $zip = zip_open("upload/".$_FILES["file"]["name"]);
    if ($zip) {
        while ($zip_entry = zip_read($zip)) {
            $fp = fopen('upload/'.zip_entry_name($zip_entry), "w");
            if (zip_entry_open($zip, $zip_entry, "r")) {
                $buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
                fwrite($fp,"$buf");
                zip_entry_close($zip_entry);
                fclose($fp);
            }
        }
        zip_close($zip);
    }
}
