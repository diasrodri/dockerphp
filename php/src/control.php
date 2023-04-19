<?php
$filename = "web_ctr.txt";
echo $filename;
$handle = fopen($filename, "r");
echo $handle;

$contents = fread($handle, filesize($filename));
echo $contents;
fclose($handle);
?>