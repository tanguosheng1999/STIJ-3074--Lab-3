<?php
$servername = "localhost";
$username = "tgscom1_watchtimedbadmin";
$password = "F%MI1!MWo]t9";
$dbname = "tgscom1_watchtimedb";

try {
   $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
?>