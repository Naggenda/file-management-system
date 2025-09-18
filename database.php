<?php
// Start the session
session_start();
// Change the below variables to reflect your MySQL database details
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'Joshua2@3';
$DATABASE_NAME = 'file';
// Try and connect using the info above
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
// Check for connection errors
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error
    exit('Failed to connect to MySQL!');
}