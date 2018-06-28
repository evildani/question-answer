<?php
function var_dump_ret($mixed = null) {
  ob_start();
  var_dump($mixed);
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}

$servername = "localhost";
$username = "user";
$password = "password";
$dbname = "questions";
$myfile = fopen("/home/daniel/testfile.txt", "a");
fwrite($myfile,"New Resquest\n");
fwrite($myfile, var_dump_ret($_SERVER));
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_GET["username"];
$answer = $_GET["answer"];
#print "Usnermae = $username<br>";
$query = "SELECT answer FROM questions where username = '$username'";
$result = $conn->query($query) or die('Query failed: ' . mysql_error());


if ($result->num_rows >= 0) {
    if ($result->num_rows == 1){
        $row = $result->fetch_row();
        #print_r( $row);
        if( $row[0] == $answer)
        {
        print "Success";
        }
        else{
        print "Wrong";
        }
    }
    else {
        print "ERROR: No questions set up for user";
    }
}
else {
        print "ERROR: More than one questions selected: $result->num_rows";
}
fclose($myfile);
?>
