<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'test';

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die('Could not connect to the database: ' . mysqli_connect_error());
}

// Check if the query was successful

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['inputState'];  

    $sql = "INSERT INTO form (`First Name`, `Last Name`, `Email`, `Address`, `Birthdate`, `Gender`) 
            VALUES ('$fname', '$lname', '$email', '$address', '$birthday', '$gender')";

    if (mysqli_query($conn, $sql)) {
        echo "New record added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // SQL query to delete the record
    $sql_delete = "DELETE FROM form WHERE ID = $delete_id";

    if (mysqli_query($conn, $sql_delete)) {
        echo "Record deleted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Fetch data from the database
$sql = "SELECT * FROM form"; 
$result = mysqli_query($conn, $sql);


// Close the connection
mysqli_close($conn);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>


<form class="row g-3" method="post" action="form.php">
  <div class="col-md-6">
    <label for="fname" class="form-label">First Name</label>
    <input type="text" class="form-control" id="fname" name="fname">
  </div>
  <div class="col-md-6">
    <label for="lname" class="form-label">Last Name</label>
    <input type="text" class="form-control" id="lname" name="lname">
  </div>
  <div class="col-12">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="">
  </div>
  <div class="col-12">
    <label for="inputAddress" class="form-label">Address</label>
    <input type="text" class="form-control" id="inputAddress" name="address" placeholder="">
  </div>
  <div class="col-md-6">
    <label for="birthday" class="form-label">Birthday</label>
    <input type="date" class="form-control" id="birthday" name="birthday">
  </div>
  <div class="col-md-4">
    <label for="inputState" class="form-label">Gender</label>
    <select id="inputState" class="form-select" name="inputState">
      <option selected>Choose...</option>
      <option>Male</option>
      <option>Female</option>
    </select>
  </div>
  <div class="col-12">
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary" style="margin-bottom: 100px;">add </button>
  </div>
</form>














<table class="table  table-dark table-sm">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Email</th>
      <th scope="col">Gender</th>
      <th scope="col">Birthdate</th>
       <th scope="col">Address</th>
       <th scope="Action">Action</th>
    </tr>
  </thead>
  <tbody>
    
  <?php
    if ($result) {
        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<th scope='row'>{$row['ID']}</th>";
            echo "<td>{$row['First Name']}</td>";
            echo "<td>{$row['Last Name']}</td>";
            echo "<td>{$row['Email']}</td>";
            echo "<td>{$row['Gender']}</td>";
            echo "<td>{$row['Birthdate']}</td>";
            echo "<td>{$row['Address']}</td>";
            echo "<td class='btnContainer'>
                    <button class='edit btn btn-warning'>Edit</button>
                    <button class='delete btn btn-danger' onclick='deleteRow(this)'>Delete</button>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
  ?>
    <tr>
      
      </td>
      
    </tr>
    <tr>
      
    </tr>
    <tr>
      
    </tr>

    

  </tbody>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script>
function deleteRow(button) {
    // Traverse the DOM to find the parent row and remove it
    var row = button.closest('tr');
    row.remove();
}
</script>
</body>
</html>