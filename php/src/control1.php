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
$mydatabase = 'Exp';
// check the mysql connection status

$conn = new mysqli($host, $user, $pass, $mydatabase);
//$mysqli = new mysqli("localhost", "my_user", "my_password", "world");

/* Create table doesn't return a resultset */
$conn->query("CREATE TEMPORARY TABLE Exp1 LIKE caixatermica");
printf("Table Exp1 successfully created.\n");

$conn->query(" create table `Exp` (
    id int not null auto_increment,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    t1 FLOAT NOT NULL,
    t2 FLOAT NOT NULL,
    t3 FLOAT NOT NULL,
    cur FLOAT NOT NULL,
    primary key (id)
);
");

$conn->query("insert into `Exp` (reg_date, t1, t2, t3, cur) values
    (CURRENT_TIMESTAMP,"0.0","0.0","0.0","0.0");
    ");
?>

</body>
</html>
