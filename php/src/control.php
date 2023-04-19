<?php

$homepage = file_get_contents('web_ctr.txt');
echo $homepage;

$myfile = fopen("web_ctr.txt", "r") or die("Unable to open file!");

echo $myfile;

fclose($myfile);



?>