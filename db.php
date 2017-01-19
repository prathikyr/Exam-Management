<?php
	
	$host = 'localhost';
	$database = 'exam';
	$username = 'root';
	$password = 'pop';

	$conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>