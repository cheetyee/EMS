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
                    <div class="panel-heading"><h4>Employee Details</h4></div>
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
                                <input type="text" class="form-control input-sm" name="name" value="<?php echo $employee['emp_ID']?>" disabled>
                            </div>
                            </br>
                            <div class="form-group">
                                <label>Employee Name</label>
                                <input type="text" class="form-control input-sm" name="name" value="<?php echo $employee['name']?>" disabled>
                            </div>
                            </br>
                            <div class="form-group">
                                <label>Employee Phone</label>
                                <input type="tel" class="form-control input-sm" name="phone_no" value="<?php echo $employee['phone_no']?>" disabled>
                            </div>
                            </br>
                            <div class="form-group">
                                <label>Employee Email</label>
                                <input type="email" class="form-control input-sm" name="email" value="<?php echo $employee['email']?>" disabled>
                            </div>
                            </br>
                            <div class="form-group">
                                <label>Employee Address </label>
                                <input type="tel" class="form-control input-sm" name="address" value="<?php echo $employee['address'].' '.$employee['postcode'].' '.$employee['city'].' '.$employee['state']?> " disabled>
                            </div>
                            </br>
                            <div class="form-group">
                                <label>Gender <span class="text-danger">*</span></label>
                                <select name="gender" class="form-control" disabled>
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
								<label>Designation </label>
								<select class="form-control" name="design" disabled>
								<option value="<?php echo $employee['design_name']?>" name="design" class="form-control" disabled><?php echo $employee['design_name']?></option>
								<?php 
									$sql = "SELECT * from designation";
									$result = mysqli_query($conn, $sql);
									if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) { ?>
										<option value="<?php echo $employee['design_name']?>">
											<?php echo $employee['design_name']?></option>
											<?php }} ?> 
								</select>
							</div>
							</br>
                            <div class="form-group">
								<label>Position </label>
								<select class="form-control" name="position" disabled>
								<option value="<?php echo $employee['position_name']?>" name="design" class="form-control" disabled><?php echo $employee['position_name']?></option>
								<?php 
									$sql = "SELECT * from position";
									$result = mysqli_query($conn, $sql);
									if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) { ?>
										<option value="<?php echo $employee['position_name'];?>">
											<?php echo $employee['position_name'];?></option>
											<?php }} ?> 
								</select>
							</div>
							</br>
                            <div class="form-group">
								<label>Department </label>
								<select name="department" class="form-control" disabled>
								<option value="<?php echo $employee['depart_name']?>" name="design" class="form-control" disabled><?php echo $employee['depart_name']?></option>
								<?php 
									$sql = "SELECT * from department";
									$result = mysqli_query($conn, $sql);
									if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) { ?>
										<option value="<?php echo $employee['depart_name'];?>">
											<?php echo $employee['depart_name'];?></option>
											<?php }} ?> 
								</select>
							</div>
							</br>
							<label>Working Hours </label>
							<div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Start From</label>
                                        <input type="time" value="<?php echo $employee['start']?>" class="form-control" name="start" disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>End To</label>
                                        <input type="time" value="<?php echo $employee['end']?>" class="form-control" name="end" disabled>
                                    </div>    
                                </div>
                            </div>
							</br>
							<div class="row">
                                <div class="col-6">
                                    <div class="form-group">
    								<label>Salary Type </label>
    								<select name="salary" class="form-control" disabled>
    								<option value="<?php echo $employee['salary']?>" name="design" class="form-control" disabled></option>
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
                                        <label>Amount</label>
                                        <input type="text" value="<?php echo $employee['amount']?>" class="form-control" name="amount" disabled>
                                    </div>    
                                </div>
                            </div>
							
							</br>
							<div class="form-group">
								<label>Extra Payhead </label>
							    <table>
								<?php 
								    $role= "extra";
								    $inc = 4;
									$sql = "SELECT * from pay_structure WHERE emp_ID = '$id'";
									$result = mysqli_query($conn, $sql);
									if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                    $inc = ($inc == 4) ? 1 : $inc+1; 
                                    if($inc == 1) echo "<tr>";  
                                    ?>
                                        <div class="row">
                                            <div class="col">
                                                <input type="checkbox" checked="checked" name="payhead" style="margin-right:5px;" value="<?php echo $row['payhead_name'];?>"disabled><?php echo $row['payhead_name'];?> 
                                            </div>
                                        </div>
                         
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
							</br>
                            <div class="form-group">
                                <a href="editEmp.php?emp_ID=<?php echo $employee['emp_ID']; ?>" class="btn btn-block btn-xs btn-warning" style="color:white;">Edit </a>
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


    
  </body>
</html>