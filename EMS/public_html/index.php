<?php

require 'conn.php'; 
/*$sql = "SELECT * FROM employee";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        $pass = convert_uudecode($row['password']);
        echo $pass;
    }
}*/

//echo convert_uudecode("*.#8W,#@Y-61E,P```");
session_start();


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EMS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  </head>
  <body>

    <!-- login -->
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-lg-push-4 col-md-push-4">
                <div class="panel panel-default" style="margin-top: 50px;">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control input-sm" name="emp_ID" required placeholder="ID">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control input-sm" name="password" required placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-sm" name="adminLogin" value="Login as Admin">
                                <input type="submit" class="btn btn-success btn-sm" name="staffLogin" value="Login as Staff">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- login -->

    <?php 
 
    if( isset( $_POST['staffLogin'] ) ){
        $emp_ID = $_POST['emp_ID'];
        $pass = $_POST['password'];
        
        $sql = "SELECT * FROM employee WHERE emp_ID='$emp_ID'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0){
            while($user = mysqli_fetch_assoc($result)){
                $encode= convert_uuencode($pass);
                if($emp_ID == $user['emp_ID'] && $encode == $user['password']){
                    $_SESSION['name'] = $user['name'];
                    $_SESSION['id'] = $user['emp_ID'];
                    header('Location: empDashboard.php');
                }else{
                    echo '<script>alert("Error ID or Password incorrect!");</script>';    
                }
            }
        }else{
            echo '<script>alert("No Record Found!");</script>';
        }
    }else if( isset( $_POST['adminLogin'] ) ){
        $emp_ID = $_POST['emp_ID'];
        $pass = $_POST['password'];
        //echo convert_uudecode($pass);
        $sql = "SELECT * FROM employee WHERE emp_ID='$emp_ID'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0){
            while($user = mysqli_fetch_assoc($result)){
                
                $position = $user['position_name'];
                $SQL = "SELECT * FROM position WHERE position_name = '$position'";
                $RESULT = mysqli_query($conn, $SQL);
                if(mysqli_num_rows($RESULT)>0){
                    while($position = mysqli_fetch_assoc($RESULT)){
                        $role = $position['role_name'];
                        $encode= convert_uuencode($pass);
                        if($emp_ID == $user['emp_ID'] && $encode == $user['password']){
                            if($role == 'admin'){
                                $_SESSION['name'] = $user['name'];
                                $_SESSION['id'] = $user['emp_ID'];
                                header('Location: dashboard.php');
                            }else{
                                echo '<script>alert("You Dont Have Permission!");</script>';
                            }
                            
                        }else{
                            echo '<script>alert("Error ID or Password incorrect!!");</script>';
                        }
                        
                    }
                }
            }
                
        }else{
            echo '<script>alert("No Record Found!");</script>';
        }
    }


    ?>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </body>
</html>

