<?php
session_start();
include("koneksi.php");

// Check if the user clicked the login button
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform your database validation here to check username and password

    // Assuming you have a table named 'admin' with columns 'username' and 'password'
    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) == 1) {
        // Authentication successful
        $_SESSION['admin_username'] = $username;
        echo '<script>alert("Login successful! Welcome, ' . $username . '");</script>';
        // Redirect to the admin_dashboard.php page after a successful login
        echo '<script>window.location.href = "admin_dashboard.php";</script>';
        exit();
    } else {
        // Invalid credentials
        echo '<div class="alert alert-danger">Invalid username or password.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="col-md-4">
            <h2 class="text-center">Admin Login</h2>
            <form method="post" action="index.php">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                </div>
            </form>
            <div class="text-center">
                <a href="employee_login.php" class="btn btn-secondary mt-3">Employee Login</a>
            </div>
        </div>
    </div>
</body>
</html>
