<?php
$host="host";
$port= 000;
$socket="";
$user="user";
$password="password";
$dbname="dbname";

//estableciendo la conexiòn con la base de datos 
$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());
	$con->set_charset('utf8mb4');

return $con;
$con->close();


