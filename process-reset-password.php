<?php

$token = $_POST["token"];

$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/database.php";

$sql = "SELECT * FROM user WHERE reset_token_hash = ?";

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if($account === null){
    die("token not found");
}

if (strtotime($user["expirery"]) <= time()){
    die("token has expired");
}


$sql = "UPDATE accounts SET password = ?,
token = NULL, expirery = NULL WHERE id = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("ss", $password, $account['id']);

$stmt->execute();

header('location: index.php');

