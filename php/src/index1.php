<?php
//These are the defined authentication environment in the dbct service

// The MySQL service named in the docker-compose.yml.
$host = 'dbct';

// Database use name
$user = 'radias';

//database user password
$pass = 'radias';

// check the MySQL connection status
$conn = new mysqli($host, $user, $pass);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected to MySQL server successfully!";
}
?>
