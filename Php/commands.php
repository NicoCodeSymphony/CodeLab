<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // Prevent SQL injection
    $delete_id = mysqli_real_escape_string($conn, $delete_id);

    $delete_sql = "DELETE FROM simpletable WHERE ID = '$delete_id'";

    if ($conn->query($delete_sql) === TRUE) {
        // Deletion successful
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        // Handle deletion error if needed
        echo "Error deleting record: " . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_id'])) {
    $edit_id = $_POST['edit_id'];
    $edit_first_name = mysqli_real_escape_string($conn, $_POST['edit_firstname']);
    $edit_last_name = mysqli_real_escape_string($conn, $_POST['edit_lastname']);
    $edit_gender = mysqli_real_escape_string($conn, $_POST['edit_gender']);
    $edit_email = mysqli_real_escape_string($conn, $_POST['edit_email']);
    $edit_birthdate = mysqli_real_escape_string($conn, $_POST['edit_birthdate']);
    $edit_address = mysqli_real_escape_string($conn, $_POST['edit_address']);

    // SQL query to update data in the database
    $update_sql = "UPDATE simpletable SET 
                   `First Name` = '$edit_first_name',
                   `Last Name` = '$edit_last_name',
                   `Gender` = '$edit_gender',
                   `Email` = '$edit_email',
                   `Birtdate` = '$edit_birthdate',
                   `Address` = '$edit_address'
                   WHERE ID = '$edit_id'";

    if ($conn->query($update_sql) === TRUE) {
        // Record updated successfully
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        // Handle update error if needed
        echo "Error updating record: " . $conn->error;
    }
}



// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = mysqli_real_escape_string($conn, $_POST['firstname']);
    $last_name = mysqli_real_escape_string($conn, $_POST['lastname']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    // SQL query to insert data into the database
    $sql = "INSERT INTO simpletable (`First Name`, `Last Name`, `Gender`, `Email`, `Birtdate`, `Address`)
            VALUES ('$first_name', '$last_name', '$gender', '$email', '$birthdate', '$address')";

    if ($conn->query($sql) === TRUE) {
        // Record inserted successfully
        $_SESSION['submitted_form'] = true;
    }

    // Redirect to the current page to avoid form resubmission
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}


?>