<?php

include "connection.php";
$con = connections();

if (isset($_POST["name"])) {
    $name = $_POST["name"];
    $price = $_POST['price'];
    $numItem = $_POST['numItem'];
} else {
    return;
}

$query = "INSERT INTO `practice` (`name`, `price`, `numItem`) VALUES ('$name', '$price', '$numItem')";

$exe = mysqli_query($con, $query);

$arr = [];

if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print(json_encode($arr));

?>
