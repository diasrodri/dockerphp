<?php
//$web_control = file_get_contents('web_crt.txt');

$myfile = fopen("web_ctr.txt", "r") or die("Unable to open file!");

echo $myfile;

fclose($myfile);



?>