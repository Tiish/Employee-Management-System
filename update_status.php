<?php
session_start();

// Check if user is not logged in
if (!isset($_SESSION['ID_NO'])) {
    header("Location: employee_login.php");
    exit();
}

// Include the database connection file (koneksi.php)
include("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST["status"];

    // Retrieve the logged-in user's ID_NO
    $loggedInID_NO = $_SESSION['ID_NO'];

    // Update the status in the database for the logged-in user
    $query = "UPDATE employees SET status = '$status' WHERE ID_NO = '$loggedInID_NO'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "Status updated successfully: " . $status;
    } else {
        echo "Failed to update status";
    }
} else {
    echo "Invalid request";
}
?>
