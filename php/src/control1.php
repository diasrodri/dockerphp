<html>
<body>

<h1>A small example page to insert some data in to the MySQL database using PHP</h1>
<form action="control1.php" method="post">
    Peltier: <input type="text" name="pname"  value="Pon" />Digite: Pon ou Poff<br><br>
    Bomba: <input type="text" name="bname" value="Bon" />Digite: Bon ou Boff<br><br>
    Coolers: <input type="text" name="cname" value="Con" />Digite: Con ou Coff<br><br>
    <input type="submit" />
</form>


<?php
echo $_POST['pname'] . PHP_EOL;
echo $_POST['bname'] . PHP_EOL;
echo $_POST['cname'] . PHP_EOL;
$myfile = fopen("web_ctr.txt", "w") or die("Unable to open file!");
$txt = $_POST['pname'];
fwrite($myfile, $txt);
$txt = $_POST['bname'];
fwrite($myfile, $txt);
$txt = $_POST['cname'];
fwrite($myfile, $txt);
fclose($myfile);
?>

</body>
</html>
