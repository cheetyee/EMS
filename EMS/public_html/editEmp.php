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
                    <div class="panel-heading"><h4>Edit Employee Details</h4></div>
                    <div class="panel-body">
                        <form action="" method="POST">
                        <?php 
                        
                        $id = $_GET['emp_ID'];
                        $sql = "SELECT * FROM employee WHERE emp_ID='$id'";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while($employee = mysqli_fetch_assoc($result)) { ?>
                            <div class="form-group">
                                <label>Employee ID</label>
                                <input type="text" class="form-control input-sm" name="name" value="<?php echo $employee['emp_ID']?>" style="background-color:#e9ecef;" readonly>
                            </div>
                            </br>
                            <div class="form-group">
                                <label>Employee Name</label>
                                <input type="text" class="form-control input-sm" name="name" value="<?php echo $employee['name']?>" >
                            </div>
                            </br>
                            <div class="form-group">
                                <label>Employee Phone</label>
                                <input type="tel" class="form-control input-sm" name="phone_no" value="<?php echo $employee['phone_no']?>">
                            </div>
                            </br>
                            <div class="form-group">
                                <label>Employee Email</label>
                                <input type="email" class="form-control input-sm" name="email" value="<?php echo $employee['email']?>">
                            </div>
                            </br>
                            <div class="form-group">
                                <label>Employee Address</label>
                                <input type="tel" class="form-control input-sm" name="address" value="<?php echo $employee['address']?>">
                            </div>
                            </br>
                            <div class="row"> 
							    <div class="col-4">
                                    <div class="form-group">
                                        <label>Postcode </label>
                                        <input type="text" name="postcode" value="<?php echo $employee['postcode']?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" name="city" value ="<?php echo $employee['city']?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
    								<label>State <span class="text-danger">*</span></label>
    								<select name="state" class="form-control">
    								<option value="<?php echo $employee['state']?>"><?php echo $employee['state']?></option>
    								<?php 
    								$state = $employee['state'];
    									$sql = "SELECT * from state WHERE NOT state='$state' ";
    									$result = mysqli_query($conn, $sql);
    									if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) { ?>
    										<option value="<?php echo $row['state'];?>">
    											<?php echo $row['state'];?></option>
    											<?php }} ?> 
    								</select>
							        </div>
                                </div>
							</div>
                            </div>
                            </br>
                            <div class="form-group">
                                <label>Gender <span class="text-danger">*</span></label>
                                <select name="gender" class="form-control">
                                    <option value="<?php echo $employee['gender']?>">
                                    <?php 
                                    if ($employee['gender'] == 'M'){
                                    echo "Male";
                                    }else if($employee['gender'] == 'F'){
                                        echo "Female";
                                    }
                                    
                                    ?>
                                    
                                    
                                    </option>
                                          <?php
                                          $gender = $employee['gender'];
                                    if ($gender == 'M'){
                                        ?>
                                        <option value="F">Female</option>
                                        <?php
                                    }else if($gender=='F'){
                                        ?>
                                        
                                        <option value="M">Male</option>
                                        
                                        <?php
                                    }
                                    ?>
                            </select>
                            </div>
                            </br>
                            <div class="form-group">
								<label>Designation <span class="text-danger">*</span></label>
								<select value="<?php echo $employee['design_name']?>" name="design" class="form-control">
								    <option value="<?php echo $employee['design_name'];?>">
											<?php echo $employee['design_name'];?></option>
											
								<?php 
								$design = $employee['design_name'];
									$sql = "SELECT * from designation WHERE NOT design_name = '$design'";
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
								<label>Position </label>
								<select class="form-control" name="position">
								<option value="<?php echo $employee['position_name']?>" name="design" class="form-control"><?php echo $employee['position_name']?></option>
								<?php 
								$position = $employee['position_name'];
									$sql = "SELECT * from position WHERE NOT position_name = '$position'";
									$result = mysqli_query($conn, $sql);
									if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) { ?>
										<option value="<?php echo $row['position_name'];?>">
											<?php echo $row['position_name'];?></option>
											<?php }} ?> 
								</select>
							</div>
							</br>
                            <div class="form-group">
								<label>Department </label>
								<select value="<?php echo $employee['department']?>" name="depart" class="form-control">
								    <option value="<?php echo $employee['depart_name']?>" name="design" class="form-control"><?php echo $employee['depart_name']?></option>
								<?php 
								$depart = $employee['depart_name'];
									$sql = "SELECT * from department WHERE NOT depart_name ='$depart'";
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
        $position = $_POST['position'];
        $postcode = $_POST['postcode'];
        $state = $_POST['state'];
        $city = $_POST['city'];


        $sql = "UPDATE employee SET name='$name', phone_no='$phone', email='$email', address='$address', gender='$gender', depart_name='$depart', design_name='$design', start='$start', end='$end', position_name ='$position', postcode='$postcode', state='$state', city='$city' WHERE emp_ID='$id'";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Update successfully');window.location.assign('viewEmp.php');</script>";
            
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }

    }

    ?>

    
  </body>
</html>