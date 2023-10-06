<?php
include("koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MySQLi Exercise</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-datepicker.css" rel="stylesheet">

    <style>
        .content {
            margin-top: 80px;
        }
    </style>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand visible-xs-block visible-sm-block" href="">Employee Data</a>
                <a class="navbar-brand hidden-xs hidden-sm" href="">Employee Data</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="admin_dashboard.php">Master Data</a></li>
                    <li class="active"><a href="add.php">Add Data</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <div class="container">
        <div class="content">
            <h3>Employee Data &raquo; Add Data</h3>
            <hr />

            <?php
            if(isset($_POST['add'])){
                $ID_NO            = $_POST['ID_NO'];
                $name           = $_POST['name'];
                $Place_of_Birth   = $_POST['Place_of_Birth'];
                $Date_of_Birth  = $_POST['Date_of_Birth'];
                $address         = $_POST['address'];
                $phone_number     = $_POST['phone_number'];
                $position        = $_POST['position'];
                $username       = $_POST['username'];
                $pass1          = $_POST['pass1'];
                $pass2          = $_POST['pass2'];

                $cek = mysqli_query($koneksi, "SELECT * FROM employees WHERE ID_NO='$ID_NO'");
                if(mysqli_num_rows($cek) == 0){
                    if($pass1 == $pass2){
                        $insert = mysqli_query($koneksi, "INSERT INTO employees(ID_NO, name, Place_of_Birth, Date_of_Birth, address, phone_number, position, username, password)
                                                            VALUES('$ID_NO','$name', '$Place_of_Birth', '$Date_of_Birth', '$address', '$phone_number', '$position', '$username', '$pass1')") or die(mysqli_error());
                        if($insert){
                            echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Employee Data Successfully Saved.</div>';
                        }else{
                            echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Oops, Failed to Save Employee Data!</div>';
                        }
                    } else{
                        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Passwords do not match!</div>';
                    }
                }else{
                    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ID_NO already exists!</div>';
                }
            }
            ?>

            <form class="form-horizontal" action="" method="post">
                <div class="form-group">
                    <label class="col-sm-3 control-label">ID_NO</label>
                    <div class="col-sm-2">
                        <input type="text" name="ID_NO" class="form-control" placeholder="ID_NO" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Name</label>
                    <div class="col-sm-4">
                        <input type="text" name="name" class="form-control" placeholder="Name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Place of Birth</label>
                    <div class="col-sm-4">
                        <input type="text" name="Place_of_Birth" class="form-control" placeholder="Place of Birth" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Date of Birth</label>
                    <div class="col-sm-4">
                        <input type="text" name="Date_of_Birth" class="input-group date form-control" date="" data-date-format="yyyy-mm-dd" placeholder="0000-00-00" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Address</label>
                    <div class="col-sm-3">
                        <textarea name="address" class="form-control" placeholder="Address"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Phone Number</label>
                    <div class="col-sm-3">
                        <input type="text" name="phone_number" class="form-control" placeholder="Phone Number" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Position</label>
                    <div class="col-sm-2">
                        <select name="position" class="form-control" required>
                            <option value=""> ----- </option>
                            <option value="Operator">Operator</option>
                            <option value="Leader">Leader</option>
                            <option value="Supervisor">Supervisor</option>
                            <option value="Manager">Manager</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Username</label>
                    <div class="col-sm-2">
                        <input type="text" name="username" class="form-control" placeholder="Username">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-2">
                        <input type="password" name="pass1" class="form-control" placeholder="Password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Confirm Password</label>
                    <div class="col-sm-2">
                        <input type="password" name="pass2" class="form-control" placeholder="Confirm Password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">&nbsp;</label>
                    <div class="col-sm-6">
                        <input type="submit" name="add" class="btn btn-sm btn-primary" value="Save">
                        <a href="admin_dashboard.php" class="btn btn-sm btn-danger">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script>
        $('.date').datepicker({
            format: 'yyyy-mm-dd',
        })
    </script>
</body>
</html>
