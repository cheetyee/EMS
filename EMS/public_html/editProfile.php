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
    <script>
        function enable_disable()  {
            $("input").prop('disabled', false);
            
        }
    </script>
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
                    <div class="panel-heading"><h4>Edit Profile</h4></div>
                    <div class="panel-body">
                        <form action="" method="POST">
                        <?php 
                        
                        $id = $_GET['emp_ID'];
                        $sql = "SELECT * FROM employee WHERE emp_ID='$id'";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while($employee = mysqli_fetch_assoc($result)) { 
                                $pass = convert_uudecode($employee['password']);
                            
                            ?>
                            <div class="form-group">
                                <label>ID </label>
                                <input type="text" class="form-control input-sm" name="id" value="<?php echo $employee['emp_ID']?>" disabled>
                            </div>
                            </br>
                            <div class="form-group">
                                <label>Name </label>
                                <input type="text" class="form-control input-sm" name="name" id="input" value="<?php echo $employee['name']?>" >
                            </div>
                            </br>
                            <div class="form-group">
                                <label>Phone No. </label>
                                <input type="tel" class="form-control input-sm" name="phone_no" id="input" value="<?php echo $employee['phone_no']?>" >
                            </div>
                            </br>
                            <div class="form-group">
                                <label>Email </label>
                                <input type="email" class="form-control input-sm" name="email" id="input" value="<?php echo $employee['email']?>" >
                            </div>
                            </br>
                            <div class="form-group">
                                <label>Password </label>
                                <input type="text" class="form-control input-sm" name="pass" id="input" value="<?php echo $pass?>" >
                            </div>
                            </br>
                            <div class="form-group">
                                <label>Address </label>
                                <input type="text" class="form-control input-sm" name="address" id="input" value="<?php echo $employee['address']?>" >
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
                                <input type="submit" class="btn btn-sm btn-success" value="Save" name="save">
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
if( isset($_POST['save']) ){

        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone_no'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $pass = $_POST['pass'];
        $encode = convert_uuencode($pass);

        $sql = "UPDATE employee SET name='$name', phone_no='$phone', email='$email', password='$encode', address='$address', gender='$gender' WHERE emp_ID='$id'";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Update successfully');window.location.assign('profile.php');</script>";
            
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }

    }

    
?>

    
  </body>
</html>