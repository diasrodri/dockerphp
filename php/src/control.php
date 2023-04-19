<?php
$myfile = fopen("web_ctr.txt", "r");
$contents = fread($myfile, filesize($myfile));
echo $contents;
fclose($myfile);
?>