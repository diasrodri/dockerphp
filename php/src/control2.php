<html>
<body>
<h1>Control2.php MSQL actions database using PHP</h1>


<?php

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

$sql="insert into Exp4 (reg_date, t1, t2, t3, cur) values (CURRENT_TIMESTAMP,1.0,1.0,1.0,1.0)";
$conn->query($sql);

echo "Table myCity successfully created" ."<br>";


if($stmt = $conn->query("SHOW TABLES")){
    echo "----"."<br>";
    echo "No of records : ".$stmt->num_rows."<br>";
    while ($row = $stmt->fetch_array()) {
  echo $row[0]."<br>";
    }
  }else{
  echo $connection->error;
  }
  


$sql = "CREATE TABLE Exp4 (
id int not null auto_increment,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
t1 FLOAT NOT NULL,
t2 FLOAT NOT NULL,
t3 FLOAT NOT NULL,
cur FLOAT NOT NULL,
primary key (id)
)";

if ($conn->query($sql) === TRUE) {
  echo "Table Exp4 created successfully \n";
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
  echo " " . PHP_EOL;
  
} else {
  echo "Error creating table: " . $conn->error;
}

$conn->close();

?>

</body>
</html>
