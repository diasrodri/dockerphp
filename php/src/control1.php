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


// The MySQL service named in the docker-compose.yml.
$host = 'dbct';

// Database use name
$user = 'radias';

//database user password
$pass = 'radias';

// database name
$mydatabase = 'caixatermica';
// check the mysql connection status

$conn = new mysqli($host, $user, $pass, $mydatabase);
//$mysqli = new mysqli("localhost", "my_user", "my_password", "world");

/* Create table doesn't return a resultset */
$conn->query("CREATE TEMPORARY TABLE Exp1 LIKE caixatermica");
printf("Table myCity successfully created.\n");

/* Select queries return a resultset */
$result = $mysqli->query("SELECT * FROM caixatermica LIMIT 10");
printf("Select returned %d rows.\n", $result->num_rows);



?>

</body>
</html>
