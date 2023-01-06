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
                    <div class="panel-heading"><h4>Edit Employee Details</h4></div>
                    <div class="panel-body">
                        <form action="" method="POST">
                        <?php 
                        
                        $id = $_SESSION['id'];
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
                                <input type="text" class="form-control input-sm" name="name" id="input" value="<?php echo $employee['name']?>" disabled>
                            </div>
                            </br>
                            <div class="form-group">
                                <label>Phone No. </label>
                                <input type="tel" class="form-control input-sm" name="phone_no" id="input" value="<?php echo $employee['phone_no']?>" disabled>
                            </div>
                            </br>
                            <div class="form-group">
                                <label>Email </label>
                                <input type="email" class="form-control input-sm" name="email" id="input" value="<?php echo $employee['email']?>" disabled>
                            </div>
                            </br>
                            <div class="form-group">
                                <label>Password </label>
                                <input type="email" class="form-control input-sm" name="pass" id="input" value="<?php echo $pass?>" disabled>
                            </div>
                            </br>
                            <div class="form-group">
                                <label>Address </label>
                                <input type="tel" class="form-control input-sm" name="address" value="<?php echo $employee['address'].' '.$employee['postcode'].' '.$employee['city'].' '.$employee['state']?> " disabled>
                            </div>
                            
                            </br>
                            
                            <?php
                            $gender = $employee['gender'];
                            if ($employee['gender']=='F'){
                                $gender = 'Female';
                            }else if ($employee['gender']=='M'){
                                $gender = 'Male';
                            }
                            ?>
                            <div class="form-group">
                                <label>Gender </label>
                                <input type="text" class="form-control input-sm" name="gender"  value="<?php echo $gender ?>" disabled>
                                
                            </div>
							</br>
                            <div class="form-group">
                                <a href="editProfile.php?emp_ID=<?php echo $employee['emp_ID']; ?>" class="btn btn-block btn-warning">Edit</a>
                                
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