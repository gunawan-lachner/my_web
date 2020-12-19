<?php
$host = 'db'; // from docker
$user = 'devuser';
$password = 'devpass';

$conn = new mysqli($host,$user,$password);
if($conn->connect_error) {
    echo 'connection failed' . $conn->connect_error;
}
echo 'Sucessfully connected to MYSQL';
?>
