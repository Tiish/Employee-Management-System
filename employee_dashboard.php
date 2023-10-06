<?php
session_start();

// Check if user is not logged in
if (!isset($_SESSION['ID_NO'])) {
    header("Location: employee_login.php");
    exit();
}

// Retrieve user login information
$loggedInID_NO = $_SESSION['ID_NO'];

// Include the database connection file (koneksi.php)
include("koneksi.php");

// Fetch additional user data from the database based on the logged-in ID_NO
$userQuery = "SELECT * FROM employees WHERE ID_NO = '$loggedInID_NO'";
$userResult = mysqli_query($koneksi, $userQuery);
$userData = mysqli_fetch_assoc($userResult);

// Logout logic
if (isset($_GET['logout'])) {
    // Perform any necessary logout actions here
    // Redirect to employee_login.php after logout
    session_destroy();
    header("Location: employee_login.php");
    exit();
}

// Handle status update
if (isset($_POST['status'])) {
    $status = $_POST['status'];

    // Update the status in the database for the logged-in user
    $query = "UPDATE employees SET status = '$status' WHERE ID_NO = '$loggedInID_NO'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "Status updated successfully: " . $status;
    } else {
        echo "Failed to update status";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Dashboard</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
        .container {
            margin-top: 50px;
        }
    </style>

</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $loggedInID_NO; ?></h2>
        <!-- Display additional user information -->
        <p>Name: <?php echo $userData['name']; ?></p>
        <p>Place of Birth: <?php echo $userData['Place_of_Birth']; ?></p>
        <p>Date of Birth: <?php echo $userData['Date_of_Birth']; ?></p>
        <p>Phone Number: <?php echo $userData['Phone_Number']; ?></p>
        <p>Position: <?php echo $userData['Position']; ?></p>
        <p>Status: <?php echo $userData['status']; ?></p>
        <p>Tasks: <?php echo $userData['Tasks']; ?></p>
        
        <br>
        <div>
            <button type="button" class="btn btn-success status-btn" data-status="Completed">Completed</button>
            <button type="button" class="btn btn-info status-btn" data-status="In Progress">In Progress</button>
            <button type="button" class="btn btn-warning status-btn" data-status="Closed">Closed</button>
        </div>
        <br>
        <a href="?logout=true" class="btn btn-primary">Logout</a>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".status-btn").click(function() {
                var status = $(this).data("status");
                updateStatus(status);
            });

            function updateStatus(status) {
                $.ajax({
                    url: "update_status.php", // Path to the PHP script to handle the status update
                    method: "POST",
                    data: {
                        status: status
                    },
                    success: function(response) {
                        console.log(response); // Optional: Display the response from the PHP script
                        // Optional: Perform additional actions after the status update
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText); // Optional: Display the error message
                    }
                });
            }
        });
    </script>
</body>
</html>
