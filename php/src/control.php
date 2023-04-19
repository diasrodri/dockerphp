<?php
$filename = "/home/caixatermica/dockerphp/php/src/web_ctr.txt";
echo $filename;

$handle = fopen($filename, "r");
echo $handle;

$contents = fread($handle, filesize($filename));
echo $contents;
fclose($handle);
?>