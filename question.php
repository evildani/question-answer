<?php
$servername = "localhost";
$username = "user";
$password = "passpord";
$dbname = "questions";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_GET["username"];
#print "Usnermae = $username<br>";
$query = "SELECT question FROM questions where username = '$username'";
$result = $conn->query($query) or die('Query failed: ' . mysql_error());
#print "Query: $query</br>";
#$result = mysql_query($query) or die('Query failed: ' . mysql_error());


if ($result->num_rows >= 0) {
    if ($result->num_rows == 1){
        $row = $result->fetch_row();
        #print_r( $row);
        print $row[0];
    }
    else {
        print "ERROR: No questions set up for user";
    }
}
else {
        print "ERROR: More than one questions selected: $result->num_rows";
}
?>
