<?php
//These are the defined authentication environment in the db service

// The MySQL service named in the docker-compose.yml.
$host = 'db';

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
    $stringData = $user->id." ".$user->username." ".$user->password;
    $stringData = $stringData . " ".$user->reg_date." ".$user->val1." ".$user->val2." ".$user->val3;
    echo $stringData;
    echo "<br>";

}
?>