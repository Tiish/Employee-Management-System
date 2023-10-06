<?php
// assign_task.php - Page to assign tasks to employees

include("koneksi.php");

// Check if the form is submitted
if (isset($_POST['assign_task'])) {
    $employee_id = $_POST['employee_id'];
    $task_title = $_POST['task_title'];
    $due_date = $_POST['due_date'];

    // Perform any necessary data validation here

    // Insert the task data into the "tasks" table
    $query = "INSERT INTO tasks (employee_id, task_title, due_date) VALUES ('$employee_id', '$task_title', '$due_date')";
    mysqli_query($koneksi, $query);

    // Redirect back to the admin dashboard after task assignment
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Task</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 80px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Assign Task</h2>
        <hr>

        <form method="post">
            <div class="form-group">
                <label for="employee_id">Select Employee:</label>
                <select class="form-control" name="employee_id" id="employee_id" required>
                    <option value="">Select an employee</option>
                    <?php
                    // Fetch the list of employees from the "employees" table
                    $query = "SELECT * FROM employees";
                    $result = mysqli_query($koneksi, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['ID_NO'] . '">' . $row['name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="task_title">Task Title:</label>
                <input type="text" class="form-control" id="task_title" name="task_title" required>
            </div>
            <div class="form-group">
                <label for="due_date">Due Date:</label>
                <input type="date" class="form-control" id="due_date" name="due_date" required>
            </div>
            <button type="submit" name="assign_task" class="btn btn-primary">Assign Task</button>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
