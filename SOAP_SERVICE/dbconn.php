<?php

$host         = "localhost";

$username     = "root";

$password     = "";

$dbname       = "university";

try {

    $dbconn = new PDO('mysql:host=localhost;dbname=university', $username, $password);

} catch (PDOException $e) {

    print "Error!: " . $e->getMessage() . "<br/>";

    die();

}