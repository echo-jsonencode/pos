<?php

$host = 'localhost';
$username = 'root';
$password = '';
$db_name = 'ironmed';

$conn = new mysqli($host, $username, $password, $db_name);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


CONST DEFAULT_PASSWORD = 'default123';

session_start();
