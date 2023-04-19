<?php
//These are the defined authentication environment in the dbct service

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

// select query
$sql = 'SELECT * FROM caixatermica';

if ($result = $conn->query($sql)) {
    while ($data = $result->fetch_object()) {
        $users[] = $data;
    }
}

foreach ($users as $user) {
    echo "<br>";
    $stringData = $user->id . " " . $user->reg_date;
    $stringData = $stringData . " " . $user->t1 . " " . $user->t2;
    $stringData = $stringData . " " . $user->t3. " " . $user->cur;
    echo $stringData;
    echo "<br>";

}

echo "<br>";

// select query
$sql = "SELECT * FROM Exp4";

if ($result = $conn->query($sql)) {
    while ($data1 = $result->fetch_object()) {
        $users1[] = $data1;
    }
}

foreach ($users1 as $user) {
    echo "<br>";
    $stringData = $user->id . " " . $user->reg_date;
    $stringData = $stringData . " " . $user->t1 . " " . $user->t2;
    $stringData = $stringData . " " . $user->t3. " " . $user->cur;
    echo $stringData;
    echo "<br>";

}


?>