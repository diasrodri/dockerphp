<html>
<body>
<?php

// The MySQL service named in the docker-compose.yml.
$host = 'db';
// Database use name
$user = 'radias';
//database user password
$pass = 'radias';
// database name
$mydatabase = 'caixatermica';
// check the mysql connection status

/*$servername = "127.0.0.1";
$username = "radias";
$password = "sfd180215";
$dbname = "caixatermica";
*/

// $link = mysqli_connect($servername, $username, $password, $dbname);
$link = new mysqli($host, $user, $pass, $mydatabase);

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . "\n" . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . "\n" . PHP_EOL;
    exit;
}

echo "Success: A proper connection to MySQL was made! The caixatermica database is great." . PHP_EOL;
echo "<br>";

echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;
echo "<br>";

$date = date_create();
$datef=date_format($date, 'Y-m-d H:i:s');
echo $datef;
echo "<br>";

$sql = "INSERT INTO `caixatermica` ";
$sql = $sql . "(`username`, `password`, `val1`, `val2`, `val3`) VALUES ";
$sql = $sql . "('$_GET[user]','$_GET[pass]','$_GET[v1]','$_GET[v2]','$_GET[v3]')";

if (mysqli_query($link,$sql))
  {
  echo "1 record added" . PHP_EOL;
  echo "<br>";
  echo 'v1=' . htmlspecialchars($_GET["v1"]) . ' v2=' . htmlspecialchars($_GET["v2"]) . '!';
  // echo 'v1=',$_GET[v1],' v2=',$_GET[v2],' v3=',$_GET[v3], 'cu=',$_GET[cu] . PHP_EOL;
  echo "<br>";
  }else
  {
  echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
  echo "<br>";
  }

mysqli_close($link);
?>
</body>
</html>