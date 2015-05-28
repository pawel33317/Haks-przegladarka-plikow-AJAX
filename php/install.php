<?php
	include 'config.php';

	$sql = "CREATE TABLE users (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	login VARCHAR(256) NOT NULL UNIQUE,
	haslo VARCHAR(256) NOT NULL,
	ranga INT
	)";
	if ($mysqli->query($sql) === TRUE) {
		echo "Table users created successfully<br>";
	} else {
		echo "Error creating table: " . $mysqli->error.'<br>';
	}

	$sql = "CREATE TABLE folder (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	link TEXT,
	rodzajhasla INT,
	haslo VARCHAR(256),
	idwlasciciela INT,
	opis TEXT
	)";
	if ($mysqli->query($sql) === TRUE) {
		echo "Table folder created successfully<br>";
	} else {
		echo "Error creating table: " . $mysqli->error.'<br>';
	}

	$sql = "CREATE TABLE nowe (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	link TEXT,
	idwlasciciela INT
	)";
	if ($mysqli->query($sql) === TRUE) {
		echo "Table folder nowe successfully<br>";
	} else {
		echo "Error creating table: " . $mysqli->error.'<br>';
	}

	
	$sql = "INSERT INTO users (login, haslo, ranga)
	VALUES ('pawel33317', '".md5('haslo01k')."', 10)";

	if ($mysqli->query($sql) === TRUE) {
		echo "New record created successfully<br>";
	} else {
		echo "Error: " . $sql . "<br>" . $mysqli->error.'<br>';
	}

?>