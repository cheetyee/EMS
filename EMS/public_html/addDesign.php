<?php 

require 'conn.php';
session_start();

if( !$_SESSION['name'] ){
    header( 'Location: index.php' );
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Weclome</title>
    
  </head>
  <body>

    <!-- nav -->
    <?php require 'nav.php'; ?>
    <!-- nav -->

    <!-- main content -->
    <div class="container">
        <div class="row">
            <?php require 'sidebar.php'; ?>
            <div class="col-lg-9 col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Add Designation</h4></div>
                    </br>
                    <div class="panel-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control input-sm" name="name" placeholder="Designation Name *" required>
                            </div>
                            </br>
                            <div class="form-group">
								<label>Department</label>
								<select name="department" class="form-control">
								<option>---Select Department---</option>
								<?php 
									$sql = "SELECT * from department";
									$result = mysqli_query($conn, $sql);
									if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) { ?>
										<option value="<?php echo $row['depart_name'];?>">
											<?php echo $row['depart_name'];?></option>
											<?php }} ?> 
								</select>
							</div>
							</br>
                            <div class="form-group">
				                <label for="payhead_type">Role</label>
				                <select class="form-control" id="role" name="role" required>
				                	<option value="">---Select Role---</option>
				                	<option value="admin">Admin</option>
				                	<option value="employee">Employee</option>
				                </select>
				            </div>
                            </br>
                            <div class="form-group">
                                <input type="submit" class="btn btn-sm btn-success" value="Add " name="add">
                            </div>
                            </br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main content -->

    <?php 
    
    if( isset($_POST['add']) ){
        $name = $_POST['name'];
        $depart = $_POST['department'];
        $role = $_POST['role'];
        
                $sql = "INSERT INTO designation (design_name, depart_name, role_name) VALUES ('$name','$depart','$role')";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('New Designation created successfully');window.location.assign('designation.php');</script>";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
        
    }
    
    ?>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </body>
</html>
