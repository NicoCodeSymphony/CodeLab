<?php

include 'connection.php';

// Check if the required parameters are set
if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['numItem'])) {
    $con = connections();

    // Sanitize user inputs
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $numItem = mysqli_real_escape_string($con, $_POST['numItem']);

    $query = "UPDATE practice SET name='$name', price='$price', numItem='$numItem' WHERE ID=$id";

    $result = mysqli_query($con, $query);

    if ($result) {
        $response = array("success" => "true");
    } else {
        $response = array("success" => "false");
    }

    echo json_encode($response);
} else {
    echo json_encode(array("success" => "false", "message" => "Missing parameters"));
}

?>
