<?php

$localhost	= "localhost";
$username	= "root";
$password	= "";
$dbname		= "budrim";

$con = new mysqli($localhost, $username, $password, $dbname);

if($con->connect_error) {
	die("connection failed : " . $conn->connect_error);
}
