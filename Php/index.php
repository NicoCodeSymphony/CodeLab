<?php
session_start();
include 'connection.php';
include 'commands.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Form</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="overlay.css">
</head>
<body>

    <div class="content">

        <div class="heading">
            <h3>John Nico M. Edisan</h3>
            <h1>Let's Getting Started</h1>
        </div>


        <div class="container">
            <div class="grid">
                <div class="card-wrapper">
                    <div class="avatar-wrapper"></div>
                    <h2> <span>Free</span> Music Session</h2>
                    <p>Do you want to join as a part of our musical team? Schedule your 30 minute
                        music session!. Fill out the quick form, and together we'll explore.
                    </p>
                    <a href="" class="button is-secondary-dark w-inline-block">
                        <div class="secondary-button-text">Schedule discovery call</div>
                    </a>
                </div>
                <div class="info-form">
                <form method='POST' action='index.php' onsubmit='return confirmDelete();'>
                        <div class="first__col">
                            <div class="input-form">
                                <label for="name">First name</label> <br>
                                <input type="text" placeholder="Your First Name" name="firstname" required>
                            </div>
                            <div class="input-form">
                                <label for="name">Last name</label> <br>
                                <input type="text" placeholder="Your Last Name" name="lastname" required>
                            </div>

                            <div class="input-form">
                                <label for="name">Gender</label> <br>
                                <select name="gender" id="" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="first__col">
                        <div class="input-form" style="margin-top: 50px">
                            <label for="name">Email</label> <br>
                            <input style="width: 30vw;" name="email" type="email" placeholder="Your Email Address" required>
                        </div>
                        <div class="input-form" style="margin-top: 50px">
                            <label for="name">Birthdate</label> <br>
                            <input style="width: 13vw;" type="date" placeholder="Your Birthdate" name="birthdate" required>
                        </div>
                    </div>

                    <div class="input-form" style="margin-top: 50px">
                        <label for="name">Address</label> <br>
                        <input style="width: 47vw;" type="text" placeholder="Your Address" name="address" required>
                    </div>

                    <input type="submit" onclick="submitForm()" style="height: 38px; width: 85px; margin-top: 50px;" class="button is-secondary-dark w-button" value="Submit" data-wait="Please Wait...">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="table-container">
        <table>
            <caption> <span>Music</span> Session Participants</caption>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Birthdate</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>


                    <?php
                        $result = $conn->query("SELECT * FROM simpletable");

                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                echo "<tr>
                            <td>{$row['ID']}</td>
                            <td>{$row['First Name']}</td>
                            <td>{$row['Last Name']}</td>
                            <td>{$row['Gender']}</td>
                            <td>{$row['Birtdate']}</td>
                            <td>{$row['Email']}</td>
                            <td>{$row['Address']}</td>
                            <td class='action-buttons'>
                            <button class='edit' onclick=\"openEditPopup(
                                '{$row['ID']}',
                                '{$row['First Name']}',
                                '{$row['Last Name']}',
                                '{$row['Gender']}',
                                '{$row['Email']}',
                                '{$row['Birtdate']}',
                                '{$row['Address']}'
                            )\">Edit</button>
                                <button class='delete' onclick='deleteRecord({$row['ID']})'>Delete</button>
                            </td>
                          </tr>";
                            }
                        } else{
                            echo "<tr><td colspan='7'> No data available</d></tr>";
                        }

                        $conn->close();
                    ?>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Add this div for the pop-up -->
<div id="editPopup" class="overlay">
    <div class="popup">
        <h2>Edit Participant</h2>
        <form id="editForm" method="POST" action="index.php">
            <input type="hidden" id="editId" name="edit_id">

            <label for="editFirstname">First Name:</label>
            <input type="text" id="editFirstname" name="edit_firstname" required><br>

            <label for="editLastname">Last Name:</label>
            <input type="text" id="editLastname" name="edit_lastname" required><br>

            <label for="editGender">Gender:</label>
            <select id="editGender" name="edit_gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select><br>

            <label for="editEmail">Email:</label>
            <input type="email" id="editEmail" name="edit_email" required><br>

            <label for="editBirthdate">Birthdate:</label>
            <input type="date" id="editBirthdate" name="edit_birthdate" required><br>

            <label for="editAddress">Address:</label>
            <input type="text" id="editAddress" name="edit_address" required><br>

            <button type="submit" class="button is-secondary-dark w-button" onclick="editForm()">Done</button>
        </form>
        <button class="button is-secondary-dark w-button" style="margin-top: 15px;" onclick="closeEditPopup()">Cancel</button>
    </div>
</div>

<!-- JavaScript -->







    <!--   https://www.jords.co.uk/   -->
    </body>

    <script src="js/script.js"></script>
    <script src="js/overlay.js"></script>
</html>