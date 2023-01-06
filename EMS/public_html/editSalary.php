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
                    <div class="panel-heading"><h4>Edit Employee Salary</h4></div>
                    <div class="panel-body">
                        <form action="" method="POST">
                        <?php 
                        
                        $id = $_GET['emp_ID'];
                        $sql = "SELECT * FROM employee WHERE emp_ID='$id'";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while($employee = mysqli_fetch_assoc($result)) { ?>
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control input-sm" name="name" value="<?php echo $employee['emp_ID']?>" style="background-color:#e9ecef;">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control input-sm" name="name" value="<?php echo $employee['name']?>" >
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            
                            </br>
                            
                            </br>
                            <div class="form-group">
                                <input type="tel" class="form-control input-sm" name="phone_no" value="<?php echo $employee['phone_no']?>">
                            </div>
                            </br>
                            <div class="form-group">
                                <input type="email" class="form-control input-sm" name="email" value="<?php echo $employee['email']?>">
                            </div>
                            </br>
                            <div class="form-group">
                                <input type="tel" class="form-control input-sm" name="address" value="<?php echo $employee['address']?>">
                            </div>
                            </br>
                            <div class="form-group">
                                <label>Gender <span class="text-danger">*</span></label>
                                <select value="<?php echo $employee['gender']?>" name="gender" class="form-control">
                                         <option value="M">Male</option>
                                         <option value="F">Female</option> 
                            </select>
                            </div>
                            </br>
                            <div class="form-group">
								<label>Designation <span class="text-danger">*</span></label>
								<select value="<?php echo $employee['design_name']?>" name="design" class="form-control">
								<?php 
									$sql = "SELECT * from designation";
									$result = mysqli_query($conn, $sql);
									if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) { ?>
										<option value="<?php echo $row['design_name'];?>">
											<?php echo $row['design_name'];?></option>
											<?php }} ?> 
								</select>
							</div>
							</br>
                            <div class="form-group">
								<label>Department </label>
								<select value="<?php echo $employee['department']?>" name="depart" class="form-control">
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
							<label>Working Hours </label>
							<div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Start From</label>
                                        <input type="time" class="form-control" name="start" value="<?php echo $employee['start']?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>End To</label>
                                        <input type="time" class="form-control" name="end" value="<?php echo $employee['end']?>">
                                    </div>    
                                </div>
                            </div>
							</br>
                            <div class="form-group">
                                <input type="submit" class="btn btn-sm btn-success" value="Update" name="update">
                            </div>
                            </br>

                        <?php    }
                        } else {
                            echo "0 results";
                        }
                        
                        ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main content -->

    <?php 

    if( isset($_POST['update']) ){

        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone_no'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $design = $_POST['design'];
        $depart = $_POST['depart'];
        $start = $_POST['start'];
        $end = $_POST['end'];


        $sql = "UPDATE employee SET name='$name', phone_no='$phone', email='$email', address='$address', gender='$gender', depart_name='$depart', design_name='$design', start='$start', end='$end' WHERE emp_ID='$id'";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Update successfully');window.location.assign('viewEmp.php');</script>";
            
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }

    }

    ?>

    
  </body>
</html>
                        <div class="form-group">
								<label>Extra Payhead </label>
							    <table>
								<?php 
								    $role= "extra";
								    $inc = 4;
									$sql = "SELECT * from payheads WHERE payhead_role = '$role'";
									$result = mysqli_query($conn, $sql);
									if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                    $inc = ($inc == 4) ? 1 : $inc+1; 
                                    if($inc == 1) echo "<tr>";  
                         
                                    ?>
                                        <td class="col-3"><input type="checkbox" name="payhead[]" style="margin-right:5px;" value="<?php echo $row['payhead_name'];?>"><?php echo $row['payhead_name'];?> </td>
                         
                                    <?php
                                    if($inc == 4) echo "</tr>";
                                    }
                                    if($inc == 1) echo "<td></td><td></td><td></td></tr>"; 
                                    if($inc == 2) echo "<td></td><td></td></tr>"; 
                                    if($inc == 3) echo "<td></td></tr>"; 
                                    
                                       
                                    ?>
                                       
											<?php  }?> 
											</table>
								
							</div>
							
							<?php
							if(isset($_POST['save'])){
							    $payhead = $_POST['payhead'];
							    foreach($payhead as $extra){
							        $query = "INSERT INTO pay_structure (emp_ID, payhead_name) VALUES ('$employee_ID', '$extra')";
							        $query_run = mysqli($conn, $query);
							    }
							    if($query_run){
							        
							    }
							}
							?>