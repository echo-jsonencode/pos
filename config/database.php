<?php

$host = 'localhost';
$username = 'dev';
$password = 'devpassword';
$db_name = 'pos';

$conn = new mysqli($host, $username, $password, $db_name);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}