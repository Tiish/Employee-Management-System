<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include the database connection file
    include("koneksi.php");

    // Get the user's ID_NO (you can replace this with the appropriate user identifier)
    $ID_NO = 1; // Change this to the actual user's ID_NO

    // Check if the 'old_password' and 'new_password' keys are present in the $_POST array
    if (isset($_POST['old_password']) && isset($_POST['new_password'])) {
        // Get the user's input for old and new passwords
        $oldPassword = $_POST['old_password'];
        $newPassword = $_POST['new_password'];

        // Fetch the user's current password from the database
        $sql = "SELECT password FROM employees WHERE ID_NO = '$ID_NO'";
        $result = mysqli_query($koneksi, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $currentPassword = $row['password'];

            // Verify if the old password matches the current password (plain text comparison)
            if ($oldPassword === $currentPassword) {
                // Update the password with the new one
                $updateSql = "UPDATE employees SET password = '$newPassword' WHERE ID_NO = '$ID_NO'";
                $updateResult = mysqli_query($koneksi, $updateSql);

                if ($updateResult) {
                    echo '<div class="alert alert-success" role="alert">Password changed successfully!</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Failed to update the password.</div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">Incorrect old password.</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Error fetching user data.</div>';
        }

        // Close the database connection
        mysqli_close($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password Change</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
        .container {
            margin-top: 80px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Password Change</h2>
        <hr>

        <form class="form-horizontal" action="" method="post">
            <div class="form-group">
                <label class="col-sm-3 control-label">Old Password</label>
                <div class="col-sm-6">
                    <input type="password" name="old_password" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">New Password</label>
                <div class="col-sm-6">
                    <input type="password" name="new_password" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                    <a href="admin_dashboard.php" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
