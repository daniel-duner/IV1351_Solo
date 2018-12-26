<?php
$servername = "192.168.0.2";
$username = "danne";
$password = "danne123";
$dbname = "tasty_recipes";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    echo "works";
}

$sql = "SELECT * FROM users";
$result =  mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
    echo $row['user_id'];
}

echo "<br>still works";