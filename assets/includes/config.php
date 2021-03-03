<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "root";
$dbName = "user_sys";

/* Attempt to connect to MySQL database */
$link = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($link === false) {
    die("ERROR: Could not connect.");
}
