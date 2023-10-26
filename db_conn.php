<?php
$servername = "localhost";
$username = "test";
$password = "test";
$dbname = "crud";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
// Verifie si la connection est bien établie entre le serveur et la BDD

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";
