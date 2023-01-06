<?php 

require 'conn.php';
session_start();
$set = '1234567890';
$ID = substr(str_shuffle($set), 0, 5);
$n = 5;
$password = bin2hex(random_bytes($n));

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
                    <div class="panel-heading"><h4>Add Employee</h4></div>
                    </br>
                    <div class="panel-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label>Employee ID</label>
								<input name="id" type="text" value="<?php echo 'EMP-'.$ID; ?>" class="form-control" style="background-color:#e9ecef;" readonly>
							</div>
							</br>
                            <div class="form-group">
                                <label>Employee Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control input-sm" name="name" placeholder="Full Name *" required>
                            </div>
                            </br>
                            <div class="form-group">
                                <label>Employee Phone <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control input-sm" name="phone_no" placeholder="Phone No. *" required>
                            </div>
                            </br>
                            <div class="form-group">
                                <label>Employee Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control input-sm" name="email" placeholder="Email *" required>
                            </div>
                            </br>
                            <div class="form-group">
                                <label>Employee Password</label>
								<input name="pass" type="text" value="<?php echo $password; ?>" class="form-control" style="background-color:#e9ecef;" readonly>
							</div>
							</br>
                            <div class="form-group">
                                <label>Employee Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control input-sm" name="address" placeholder="Address *" required>
                            </div>
                            </br>
                            <div class="row"> 
							    <div class="col-4">
                                    <div class="form-group">
                                        <label>Postcode <span class="text-danger">*</span></label>
                                        <input type="text" name="postcode" placeholder="Eg. 12345 *" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>City <span class="text-danger">*</span></label>
                                        <input type="text" name="city" placeholder="City *" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
    								<label>State <span class="text-danger">*</span></label>
    								<select name="state" class="form-control">
    								<option>---Select State---</option>
    								<?php 
    									$sql = "SELECT * from state";
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
                                <select required name="gender" class="form-control">
                                    <?php?>
                                        <option value="">---Select Gender---</option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option> 
                            </select>
                            </div>
                            </br>
                            <div class="form-group">
								<label>Job Title <span class="text-danger">*</span></label>
								<select required name="designation" class="form-control">
								<option>---Select Job Title---</option>
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
								<label>Position <span class="text-danger">*</span></label>
								<select required name="position" class="form-control">
								<option>---Select Position---</option>
								<?php 
									$sql = "SELECT * from position";
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
								<select name="department" class="form-control">
								<option>---Select Designation---</option>
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
							<label>Working Hours <span class="text-danger">*</span></label>
							<div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Start From <span class="text-danger">*</span></label>
                                        <input type="time" class="form-control" name="start" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>End To <span class="text-danger">*</span></label>
                                        <input type="time" class="form-control" name="end" required>
                                    </div>    
                                </div>
                            </div>
							</br>
							<div class="row">
                                <div class="col-6">
                                    <div class="form-group">
    								<label>Salary Type <span class="text-danger">*</span></label>
    								<select name="salary" class="form-control">
    								<option>---Select Salary Type---</option>
    								<?php 
    								    $role= "salary";
    									$sql = "SELECT * from payheads WHERE payhead_role = '$role'";
    									$result = mysqli_query($conn, $sql);
    									if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) { ?>
    										<option value="<?php echo $row['payhead_name'];?>">
    											<?php echo $row['payhead_name'];?></option>
    											<?php }} ?> 
    								</select>
							        </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Amount <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="amount" required>
                                    </div>    
                                </div>
                            </div>
                            </br>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
    								    <label>Extra Payhead <span class="text-danger">*</span></label>
    							    </div>
    							</div>
    							<div class="row">
    							    <div class="form-group">
    							    <div class="row">
    								<?php
    								    $inc=5;
                                        $role= "extra";
    									$sql = "SELECT * from payheads WHERE payhead_role = '$role'";
    									$result = mysqli_query($conn, $sql);
    									if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) { 
                                            $inc = ($inc == 5) ? 1 : $inc+1; 
                                            if($inc == 1) echo "
                                            
                                                <div class='col-4'>";  
                         
                                    ?>
                                        <input type="checkbox" name="payhead[]"  value="<?php echo $row['payhead_name']?>"><?php echo $row['payhead_name']?>
                                        </br>
                                        <input type="text" name="amt[]"  value="<?php echo $row['amount']?>" style="visibility:hidden; ">
                                        </br>
                         
                                    <?php
                                    if($inc == 5) echo "</div>";
                                    }
                                    
    									}
                                        
    								?>
							        
                                </div>
                            </div>
							</br>
                            <div class="form-group">
                                <input type="submit" class="btn btn-sm btn-success" value="Add Employee" name="add">
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
        $phone_no = $_POST['phone_no'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $employee_ID = $_POST['id'];
        $pass = $_POST['pass'];
        $designName = $_POST['designation'];
        $departName = $_POST['department'];
        $date = date('Y-m-d');
        $start = $_POST['start'];
        $end = $_POST['end'];
        $position = $_POST['position'];
        $salary = $_POST['salary'];
        $amount = $_POST['amount'];
        
        $postcode = $_POST['postcode'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        
                $hash_password = convert_uuencode($pass);
                $sql = "INSERT INTO employee (emp_ID, name, phone_no, email, password, address, create_date, status, gender, depart_name, design_name, start, end, position_name, payhead_name, amount, postcode, state, city) VALUES "
                . "( '$employee_ID', '$name', '$phone_no', '$email','$hash_password', '$address', '$date', 'active', '$gender', '$departName', '$designName', '$start', '$end', '$position', '$salary', '$amount', '$postcode', '$state', '$city')";
                $hash_password = convert_uuencode($pass);
                $payhead = $_POST['payhead'];
                $amt = $_POST['amt'];
                    
                foreach($payhead as $item=>$payheads){
                    $pay = $payheads;
                    $pay_amt = $amt[$item];
                    //echo $payheads ."-".$employee_ID."-". $pay_amt;
                    
                    $structure = "INSERT INTO pay_structure (emp_ID, payhead_name, amount) VALUES ('$employee_ID', '$pay','$pay_amt')";
                    $run = mysqli_query($conn,$structure);
                    
                }

                
                if (mysqli_query($conn, $sql) == true) {
                    if ($run) {
                    echo "<script>alert('New record created successfully');window.location.assign('viewEmp.php');</script>";
                    } else {
                    echo "Error: " . $structure . "<br>" . mysqli_error($conn);
                    }
                    
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
        
    }
    
    ?>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </body>
</html>
