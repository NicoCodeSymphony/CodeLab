<?php
$server = "mysql:host=localhost;dbname=prelim";
$user = "root";
$pass = "";
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

try {
    $connection = new PDO($server, $user, $pass, $options);
} catch (PDOException $e) {
    echo "There is some problem in the connection: " . $e->getMessage();
}

$dropbox = array();

if (!empty($_POST['gender'])) {
    $dropbox[] = "gender = :gender";
}

if (!empty($_POST['address'])) {
    $dropbox[] = "home_address = :address";
}

if (!empty($_POST['member_type'])) {
    $dropbox[] = "member_type = :member_type";
}

if (!empty($_POST['from']) && !empty($_POST['to'])) {
    $dropbox[] = "DATE(date_created) BETWEEN :date_from AND :date_to";
}

$sql = "SELECT * FROM members_table";

if (!empty($dropbox)) {
    $sql .= " WHERE " . implode(" AND ", $dropbox);
}

$stmt = $connection->prepare($sql);

if (!empty($_POST['gender'])) {
    $stmt->bindParam(':gender', $_POST['gender']);
}

if (!empty($_POST['address'])) {
    $stmt->bindParam(':address', $_POST['address']);
}

if (!empty($_POST['member_type'])) {
    $stmt->bindParam(':member_type', $_POST['member_type']);
}

if (!empty($_POST['from']) && !empty($_POST['to'])) {
    $stmt->bindParam(':date_from', $_POST['from']);
    $stmt->bindParam(':date_to', $_POST['to']);
}

$stmt->execute();
$result = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRELIM EXAMINATION</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
</head>
<body>

<div class="header">
    <div class="logo">JOHN NICO EDISAN'S DATA TABLE</div>
</div>

<div class="container">
        <form method="post" action="">
            <h1>FILTER BY</h1>
            <div class="grid">
            <div class="horizontal-dropdowns">
                <div class="form-group">
                    <select class="form-control" name="gender" id="gender">
                        <option value="">Gender</option>
                       
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" name="address" id="home">
                        <option value="">Home Address</option>
                        <option value="Metro Manila">Metro Manila</option>
                        <option value="Cebu City">Cebu City</option>
                        <option value="Davao City">Davao City</option>
                        <option value="Baguio City">Baguio City</option>
                        <option value="Bogo City">Bogo City</option>
                        <option value="Iloilo City">Iloilo City</option>
                        <option value="Bohol City">Bohol</option>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" name="member_type" id="member_type">
                        <option value="">Member Type</option>
                        <option value="Member">Member</option>
                        <option value="Seller">Seller</option>
                    </select>
                </div>
                </div>
                <div class="second">
                <div class="form-group-date">
                    <label for="date_from">Date From</label><br>
                    <input type="date" name="from" placeholder="Date From">
                </div>
                <div class="form-group-date">
                    <label for="date_to">Date To</label><br>
                    <input type="date" name="to" placeholder="Date To">
                </div>
                </div>
                </div>
                <button type="submit" class="btn btn-primary">Apply Filter</button>
        </form>
    </div>

    <div class="button-container">
    <!-- 11 buttons to Member ID-->
    <button id="btn" onclick="invisible(0)">Member ID</button>
    <button id="btn" onclick="invisible(1)">First Name</button>
    <button id="btn" onclick="invisible(2)">Last Name</button>
    <button id="btn" onclick="invisible(3)">Gender</button>
    <button id="btn" onclick="invisible(4)">Birthdate</button>
    <button id="btn" onclick="invisible(5)">Home Address</button>
    <button id="btn" onclick="invisible(6)">Email</button>
    <button id="btn" onclick="invisible(7)">Username</button>
    <button id="btn" onclick="invisible(8)">Password</button>
    <button id="btn" onclick="invisible(9)">Member Type</button>
    <button id="btn" onclick="invisible(10)">Date Created</button>
</div>


<div style="margin: 50px 120px; display: flex; justify-content: space-between; font-size: 1.2em;">
    <div style="font-size: 1.2em;">Table-Details Report</div>
    <div id="clock"></div>
</div>
    
    <div class="table-container">
    <h1 style="padding: 20px 10px; text-align: center;">LIST OF PEOPLE <br><span style="font-style: italic; font-size: 17px;">NOTE: Scroll Horizontally to view other data</span></h1>
    <table>
    <thead>
        <tr>
            <th>Member ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>Birthdate</th>
            <th>Home Address</th>
            <th>Email</th>
            <th>Username</th>
            <th>Password</th>
            <th>Member Type</th>
            <th>Date Created</th>
        </tr>
    </thead>
    <tbody>
    <?php
    if ($result) {
        foreach ($result as $row) {
    ?>
        <tr>
            <td><?php echo $row['member_id']?></td>
            <td><?php echo $row['first_name']?></td>
            <td><?php echo $row['last_name']?></td>
            <td><?php echo $row['gender']?></td>
            <td><?php echo $row['birthdate']?></td>
            <td><?php echo $row['home_address']?></td>
            <td><?php echo $row['email']?></td>
            <td><?php echo $row['username']?></td>
            <td><?php echo $row['password']?></td>
            <td><?php echo $row['member_type']?></td>
            <td><?php echo $row['date_created']?></td>
        </tr>
    <?php 
        }
    } 
    ?>
    </tbody>
</table>
</div>

<script>
    const buttons = document.querySelectorAll('#btn');

    buttons.forEach(button => {
        button.addEventListener('click', function onClick() {
            if (button.classList.contains('active')) {
                button.style.backgroundColor = '';
                button.style.color = '';
                button.classList.remove('active');
            } else {
                button.style.backgroundColor = '#00ff00';
                button.style.color = '#000';
                button.classList.add('active');
            }
        });
    });

    function invisible(columnIndex) {
        const table = document.querySelector("table");
        const rows = table.rows;

        if (rows.length > 0) {
            const isVisible = rows[0].cells[columnIndex].style.display !== "none";

            for (let i = 0; i < rows.length; i++) {
                rows[i].cells[columnIndex].style.display = isVisible ? "none" : "";
            }
        }
    }

    function updateClock() {
            const now = new Date();

            const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            const day = days[now.getDay()];
            const month = months[now.getMonth()];
            const date = now.getDate();
            const year = now.getFullYear();
            let hour = now.getHours();
            const minute = now.getMinutes();
            const ampm = hour >= 12 ? 'pm' : 'am';
            if (hour > 12) {
                hour -= 12;
            }

            const timeString = `${day} ${month}. ${date} ${year}, ${hour}:${minute < 10 ? '0' : ''}${minute}${ampm}`;
            document.getElementById('clock').textContent = timeString;
        }
        setInterval(updateClock, 1000);
        updateClock();
</script>



</body>
</html>

