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
    <?php require 'empNav.php'; ?>
    <!-- nav -->

    <!-- main content -->
    <div class="container">
        <div class="row">
            <?php require 'empSidebar.php'; ?>
            <?php
                $name = $_SESSION['name'];
                $emp_ID = $_SESSION['id'];
                $emp = "SELECT * FROM employee WHERE name ='$name'";
                $empSQL = mysqli_query($conn, $emp);
                    if (mysqli_num_rows($empSQL) > 0) {
                        while($employee = mysqli_fetch_assoc($empSQL)) { 
                            
                        }
                    }?>
            <div class="col-lg-9 col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Apply Leaves</h4></div>
                    </br>
                    <div class="panel-body">
                        <form action="" method="POST">
                            <div class="form-group">
								<input name="id" type="text" value="<?php echo $emp_ID; ?>" class="form-control" style="background-color:#e9ecef;" readonly>
							</div>
							</br>
							<div class="form-group">
								<input name="name" type="text" value="<?php echo $name; ?>" class="form-control" style="background-color:#e9ecef;" readonly>
							</div>
                            </br>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Start From</label>
                                        <input class="form-control calendar" type="date" name="start" placeholder="DD/MM/YYYY" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>End To</label>
                                        <input class="form-control calendar" type="date" name="end" placeholder="DD/MM/YYYY" required>
                                    </div>    
                                </div>
                            </div>
                            </br>
                            <div class="form-group">
                                <textarea type="text" class="form-control input-sm" name="reason" placeholder="Reason *" required></textarea>
                            </div>
                            </br>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" value="Apply" name="apply">
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
    
    if( isset($_POST['apply']) ){
        $employee_ID = $_SESSION['id'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $reason = $_POST['reason'];
 
        $set = '1234567890';
        $id = substr(str_shuffle($set), 0, 5);
        $app_ID = 'APP-'.$id;
                $sql = "INSERT INTO application (app_ID, emp_ID, start_date, end_date, reason, status) VALUES "
                . "( '$app_ID', '$employee_ID', '$start', '$end','$reason', 'Pending')";
                            
                if (mysqli_query($conn, $sql)) {
                    $message = "apply for Leave";
                    $query ="INSERT INTO `notification` ( `name`,`app_ID`, `type`, `message`, `status`, `date`, `role`) VALUES ( '$name','$app_ID', 'apply', '$message', 'unread', CURRENT_TIMESTAMP, 'employee')";   
                    if (mysqli_query($conn, $query)) {
                        echo "<script>alert('Your application has been send. Please wait for the response.');window.location.assign('empApplication.php');</script>";
                    }else {
                    echo "Error: " . $query . "<br>" . mysqli_error($conn);
                }
                    
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
        
    }
    
    ?>

  </body>
</html>
