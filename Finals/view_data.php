<?php

include 'connection.php';
$con = connections();

$query = "SELECT * FROM practice";
$exe = mysqli_query($con, $query);

$arr = [];

while($row=mysqli_fetch_array($exe)){
    $arr[] = $row;
}

print(json_encode($arr));