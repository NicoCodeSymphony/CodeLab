<?php

// CONNECTION

include 'connection.php';
$con = connections();



// DELETE


if (isset($_POST['id'])) {
    $con = connections();

    $id = $_POST['id'];

    $query = "DELETE FROM practice WHERE ID=$id";

    $result = mysqli_query($con, $query);

    if ($result) {
        $response = array("success" => "true");
    } else {
        $response = array("success" => "false");
    }

    echo json_encode($response);
} else {
    echo json_encode(array("success" => "false", "message" => "Missing parameter"));
}

// INSERT


if(isset($_POST["name"])){
    $name = $_POST["name"];
}
else return;

$query = "INSERT INTO `practice`(`name`) VALUES ('$name')";

$exe = mysqli_query($con, $query);

$arr = [];

if($exe){
    $arr["success"] = "true";
}

else{
    $arr["success"] = "false";
}

print(json_encode($arr));


// UPDATE

if (isset($_POST['id']) && isset($_POST['name'])) {
    $con = connections();

    $id = $_POST['id'];
    $name = $_POST['name'];

    $query = "UPDATE practice SET name='$name' WHERE ID=$id";

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



// READ DATA

$query = "SELECT ID, name FROM practice";
$exe = mysqli_query($con, $query);

$arr = [];

while($row=mysqli_fetch_array($exe)){
    $arr[] = $row;
}

print(json_encode($arr));


