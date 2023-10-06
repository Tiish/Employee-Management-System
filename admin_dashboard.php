<?php
include("koneksi.php");

// Logout logic
if (isset($_GET['logout'])) {
    // Perform any necessary logout actions here
    // Redirect to index.php after logout
    header("Location: index.php");
    exit();
}

// Initialize the $filter variable
$filter = '';

// Check if the filter is set in the query string
if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
}

// Delete logic
if (isset($_GET['aksi']) && $_GET['aksi'] == 'delete') {
    $ID_NO = $_GET['ID_NO'];
    $cek = mysqli_query($koneksi, "SELECT * FROM employees WHERE ID_NO='$ID_NO'");
    if (mysqli_num_rows($cek) == 0) {
        echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data not found.</div>';
    } else {
        $delete = mysqli_query($koneksi, "DELETE FROM employees WHERE ID_NO='$ID_NO'");
        if ($delete) {
            echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data deleted successfully.</div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Failed to delete data.</div>';
        }
    }
}

// Get tasks from the tasks table
$tasksQuery = "SELECT * FROM tasks";
$tasksResult = mysqli_query($koneksi, $tasksQuery);
$tasks = mysqli_fetch_all($tasksResult, MYSQLI_ASSOC);

// Check if the form is submitted
if (isset($_POST['assign_task']) && isset($_POST['task_title'])) {
    $employeeID = $_POST['assign_task'];
    $taskTitle = $_POST['task_title'];

    // Update the Tasks column in the employees table
    $updateQuery = "UPDATE employees SET Tasks='$taskTitle' WHERE ID_NO='$employeeID'";
    $updateResult = mysqli_query($koneksi, $updateQuery);

    if ($updateResult) {
        echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Task assigned successfully.</div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Failed to assign task.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
        .content {
            margin-top: 80px;
        }

        h2 {
            margin-bottom: 30px;
        }

        .alert {
            margin-top: 20px;
        }

        .form-inline {
            margin-bottom: 20px;
        }

        .table th {
            text-align: center;
        }

        .table td {
            vertical-align: middle;
        }

        .label {
            font-size: 12px;
            padding: 5px 8px;
            text-transform: uppercase;
            border-radius: 2px;
        }

        .btn-group-sm > .btn,
        .btn-sm {
            font-size: 12px;
            padding: 5px 10px;
        }

        .center {
            text-align: center;
        }

        .logout-btn {
            margin-top: 10px;
        }
    </style>

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
                    <li class="active"><a href="">Master Data</a></li>
                    <li><a href="add.php">Add Data</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <div class="container">
        <div class="content">
            <h2>Employee Data</h2>
            <hr />

            <?php
            if (isset($_GET['aksi']) && $_GET['aksi'] == 'delete') {
                $ID_NO = $_GET['ID_NO'];
                $cek = mysqli_query($koneksi, "SELECT * FROM employees WHERE ID_NO='$ID_NO'");
                if (mysqli_num_rows($cek) == 0) {
                    echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data not found.</div>';
                } else {
                    $delete = mysqli_query($koneksi, "DELETE FROM employees WHERE ID_NO='$ID_NO'");
                    if ($delete) {
                        echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data deleted successfully.</div>';
                    } else {
                        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Failed to delete data.</div>';
                    }
                }
            }
            ?>

            <form class="form-inline" method="get">
                <div class="form-group">
                    <select name="filter" class="form-control" onchange="form.submit()">
                        <option value="">Filter Employee Data</option>
                        <option value="Completed" <?php if ($filter == 'Completed') { echo 'selected'; } ?>>Completed</option>
                        <option value="In progress" <?php if ($filter == 'In progress') { echo 'selected'; } ?>>In progress</option>
                        <option value="Closed" <?php if ($filter == 'Closed') { echo 'selected'; } ?>>Closed</option>
                    </select>
                </div>
            </form>
            <br />
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th class="center">No</th>
                        <th class="center">ID_NO</th>
                        <th>Name</th>
                        <th>Place of Birth</th>
                        <th>Date of Birth</th>
                        <th class="center">Phone Number</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Tasks</th>
                        <th class="center">Tools</th>
                    </tr>
                    <?php
                    $query = "SELECT * FROM employees";
                    if (!empty($filter)) {
                        $query .= " WHERE status='$filter'";
                    }
                    $query .= " ORDER BY ID_NO ASC";
                    $sql = mysqli_query($koneksi, $query);

                    if (mysqli_num_rows($sql) == 0) {
                        echo '<tr><td colspan="9" class="center">No data available.</td></tr>';
                    } else {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($sql)) {
                            echo '
                            <tr>
                                <td class="center">' . $no . '</td>
                                <td class="center">' . $row['ID_NO'] . '</td>
                                <td><a href="profile.php?ID_NO=' . $row['ID_NO'] . '"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> ' . $row['name'] . '</a></td>
                                <td>' . $row['Place_of_Birth'] . '</td>
                                <td>' . $row['Date_of_Birth'] . '</td>
                                <td class="center">' . $row['Phone_Number'] . '</td>
                                <td>' . $row['Position'] . '</td>
                                <td>';

                            $status = $row['status'];
                            $labelClass = '';

                            switch ($status) {
                                case 'Completed':
                                    $labelClass = 'label label-success';
                                    break;
                                case 'In progress':
                                    $labelClass = 'label label-info';
                                    break;
                                case 'Closed':
                                    $labelClass = 'label label-warning';
                                    break;
                                default:
                                    $labelClass = 'label label-default';
                                    break;
                            }

                            echo '<span class="' . $labelClass . '">' . $status . '</span>';

                            echo '
                                </td>
                                <td>
                                    <form method="post">
                                        <div class="form-group">
                                            <select name="task_title" class="form-control">';
                            foreach ($tasks as $task) {
                                echo '<option value="' . $task['task_title'] . '">' . $task['task_title'] . '</option>';
                            }
                            echo '
                                            </select>
                                        </div>
                                        <button type="submit" name="assign_task" value="' . $row['ID_NO'] . '" class="btn btn-success btn-sm">Assign Task</button>
                                    </form>
                                </td>
                                <td class="center">
                                    <a href="edit.php?ID_NO=' . $row['ID_NO'] . '" title="Edit Data" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                    <a href="password.php?ID_NO=' . $row['ID_NO'] . '" title="Change Password" data-placement="bottom" data-toggle="tooltip" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></a>
                                    <a href="?aksi=delete&ID_NO=' . $row['ID_NO'] . '" title="Delete Data" onclick="return confirm(\'Are you sure you want to delete the data ' . $row['name'] . '?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                </td>
                            </tr>
                            ';
                            $no++;
                        }
                    }
                    ?>
                </table>
            </div>

            <a href="index.php?logout=true" class="btn btn-primary logout-btn">Logout</a>

        </div>
    </div>
    <center>
        <p></p>
    </center>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
