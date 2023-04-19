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
$user = 'radias';
$pass = 'radias';
$mydatabase = 'caixatermica';
$conn = new mysqli($host, $user, $pass, $mydatabase);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

$sql="insert into caixatermica (reg_date, t1, t2, t3, cur) values (CURRENT_TIMESTAMP,1.0,1.0,1.0,1.0)";
$conn->query($sql);
printf("Table myCity successfully created.\n");


$sql = "CREATE TABLE Exp2 (
id int not null auto_increment,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
t1 FLOAT NOT NULL,
t2 FLOAT NOT NULL,
t3 FLOAT NOT NULL,
cur FLOAT NOT NULL,
primary key (id)
)";

if ($conn->query($sql) === TRUE) {
  echo "Table Exp2 created successfully \n";
} else {
  echo "Error creating table: " . $conn->error;
  echo "\n";
}

$sql="insert into Exp2 (reg_date, t1, t2, t3, cur) values (CURRENT_TIMESTAMP,1.0,1.0,1.0,1.0)";
$conn->query($sql);
printf("Table myCity successfully created.\n");

$conn->close();



// Create connection
$conn = new mysqli($host,$user, $pass, $mydatabase);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE MyGuests (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
  echo "Table MyGuests created successfully \n";
} else {
  echo "Error creating table: " . $conn->error;
}

$conn->close();



?>

</body>
</html>
