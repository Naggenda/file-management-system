<?php

$search = $_POST['search'];
// $column = $_POST['column'];

$servername = "localhost";
$username = "root";
$password = "Joshua2@3";
$db = "file";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error){
	die("Connection failed: ". $conn->connect_error);
}

$sql = "select * from file_manager where real_name like '%$search%'";

$result = $conn->query($sql);

if ($result->num_rows > 0){
while($row = $result->fetch_assoc() ){
	echo $row["real_name"];
}
} else {
	echo "0 records";
}

$conn->close();

