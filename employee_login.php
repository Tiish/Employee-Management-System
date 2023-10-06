<?php
include("koneksi.php");
session_start();

if (isset($_POST['login'])) {
    $ID_NO = $_POST['ID_NO'];
    $password = $_POST['password'];

    $query = "SELECT * FROM employees WHERE ID_NO = '$ID_NO' AND password = '$password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) == 1) {
        // Login successful
        $_SESSION['ID_NO'] = $ID_NO;
        echo '<script>alert("Login successful! Welcome, ' . $ID_NO . '");</script>';
        // Redirect to the employee_dashboard.php page after a successful login
        echo '<script>window.location.href = "employee_dashboard.php";</script>';
        exit();
    } else {
        // Login failed
        $login_error = "Invalid ID_NO or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Login</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
        .container {
            margin-top: 150px;
        }
    </style>

</head>
<body>
    <div class="container">
        <div style="width: 300px; margin: 0 auto;">
            <h2 class="text-center">Employee Login</h2>
            <br>

            <?php if (isset($login_error)) { ?>
                <div class="alert alert-danger"><?php echo $login_error; ?></div>
            <?php } ?>

            <form method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="ID_NO" placeholder="ID_NO" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
