<?php
include("koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Page</title>

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
				<a class="navbar-brand visible-xs-block visible-sm-block" href="http://www.hakkoblogs.com">Data employees</a>
				<a class="navbar-brand hidden-xs hidden-sm" href="http://www.hakkoblogs.com">Data employees</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="index.php">Master Data</a></li>
					<li><a href="add.php">Add Data</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>
	<div class="container">
		<div class="content">
			<h2>Data employees &raquo; Edit Data</h2>
			<hr />
			
			<?php
			$ID_NO = $_GET['ID_NO'];
			$sql = mysqli_query($koneksi, "SELECT * FROM employees WHERE ID_NO='$ID_NO'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			if(isset($_POST['save'])){
				$ID_NO		     = $_POST['ID_NO'];
				$name		     = $_POST['name'];
				$Place_of_Birth	 = $_POST['Place_of_Birth'];
				$Date_of_Birth	 = $_POST['Date_of_Birth'];
				$address		     = $_POST['address'];
				$phone_number		 = $_POST['phone_number'];
				$position		 = $_POST['position'];
				$status			 = $_POST['status'];
				
				$update = mysqli_query($koneksi, "UPDATE employees SET name='$name', Place_of_Birth='$Place_of_Birth', Date_of_Birth='$Date_of_Birth', address='$address', phone_number='$phone_number', position='$position', status='$status' WHERE ID_NO='$ID_NO'") or die(mysqli_error());
				if($update){
					header("Location: edit.php?ID_NO=".$ID_NO."&pesan=sukses");
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>';
				}
			}
			
			if(isset($_GET['pesan']) && $_GET['pesan'] == 'sukses'){
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data has been successfully saved.</div>';
			}
			?>
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">ID_NO</label>
					<div class="col-sm-2">
						<input type="text" name="ID_NO" value="<?php echo $row ['ID_NO']; ?>" class="form-control" placeholder="ID_NO" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Name</label>
					<div class="col-sm-4">
						<input type="text" name="name" value="<?php echo $row ['name']; ?>" class="form-control" placeholder="name" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Place_of_Birth</label>
					<div class="col-sm-4">
						<input type="text" name="Place_of_Birth" value="<?php echo $row ['Place_of_Birth']; ?>" class="form-control" placeholder="Place_of_Birth" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Date_of_Birth</label>
					<div class="col-sm-4">
						<input type="text" name="Date_of_Birth" value="<?php echo $row ['Date_of_Birth']; ?>" class="input-group date form-control" date="" data-date-format="yyyy-mm-dd" placeholder="0000-00-00" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Address
					dress</label>
					<div class="col-sm-3">
						<textarea name="address" class="form-control" placeholder="address"><?php echo $row ['Address']; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Phone_Number</label>
					<div class="col-sm-3">
						<input type="text" name="phone_number" value="<?php echo $row ['Phone_Number']; ?>" class="form-control" placeholder="Phone_Number" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">position</label>
					<div class="col-sm-2">
						<select name="position" class="form-control" required>
							<option value=""> - Change Position - </option>
							<option value="Operator" <?php if ($row['Position'] == 'Operator') echo 'selected'; ?>>Operator</option>
							<option value="Leader" <?php if ($row['Position'] == 'Leader') echo 'selected'; ?>>Leader</option>
                            <option value="Supervisor" <?php if ($row['Position'] == 'Supervisor') echo 'selected'; ?>>Supervisor</option>
							<option value="Manager" <?php if ($row['Position'] == 'Manager') echo 'selected'; ?>>Manager</option>
						</select>
					</div>
                    <div class="col-sm-3">
                        <b>Current Position :</b>
                        <?php
                            $position = $row['Position'];
                            $labelClass = '';
                            switch ($position) {
                                case 'Operator':
                                    $labelClass = 'label label-info';
                                    break;
                                case 'Leader':
                                    $labelClass = 'label label-warning';
                                    break;
                                case 'Supervisor':
                                    $labelClass = 'label label-success';
                                    break;
                                case 'Manager':
                                    $labelClass = 'label label-primary';
                                    break;
                                default:
                                    $labelClass = 'label label-default';
                                    break;
                            }
                        ?>
                        <span class="<?php echo $labelClass; ?>"><?php echo $row['Position']; ?></span>
				    </div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Status</label>
					<div class="col-sm-2">
						<select name="status" class="form-control">
							<option value="">- Task Status -</option>
                            <option value="Completed" <?php if ($row['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                            <option value="In progress" <?php if ($row['status'] == 'In progress') echo 'selected'; ?>>In progress</option>
                            <option value="Closed" <?php if ($row['status'] == 'Closed') echo 'selected'; ?>>Closed</option>
						</select> 
					</div>
                    <div class="col-sm-3">
                        <b>Current Status :</b> 
                        <?php
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
                        ?>
                        <span class="<?php echo $labelClass; ?>"><?php echo $row['status']; ?></span>
				    </div>
                </div>
				<!--<div class="form-group">
					<label class="col-sm-3 control-label">Username</label>
					<div class="col-sm-2">
						<input type="text" name="username" value="<?php //echo $row['username']; ?>" class="form-control" placeholder="Username">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Password</label>
					<div class="col-sm-2">
						<input type="password" name="pass1" value="<?php //echo $row['password']; ?>" class="form-control" placeholder="Password">
					</div>
				</div>-->
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-sm btn-primary" value="Save">
						<a href="index.php" class="btn btn-sm btn-danger">Back</a>
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
