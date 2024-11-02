<?php  

$servername = "localhost"; 

$username = "root"; 

$password = "AnemiLover!1"; 

$dbname = "saveameal"; 

 

$conn = new mysqli($servername, $username, $password, $dbname); 

 

if($conn->connect_error){ 

    die("Connection failed: " . $conn->connect_error); 

} 

 

?> 