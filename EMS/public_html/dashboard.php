<?php 

require 'conn.php';
session_start();



/*$ip=$_SERVER['REMOTE_ADDR'];
$geo = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
$country = $geo["geoplugin_longitude"];
$city = $geo["geoplugin_latitude"];
echo $country;
echo $city;*/


if( !$_SESSION['name'] ){
    header( 'Location: index.php' );
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php date_default_timezone_set("Asia/Singapore");?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Weclome</title>
  </head>
  <body>

    <!-- nav -->
    <?php 
         
        require 'nav.php';
    ?>
    <!-- nav -->

    <!-- main content -->
    
    <div class="container">
        <div class="row">
            <?php 
         
                require 'sidebar.php';
            ?>
            <div class="col-lg-9 col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Dashboard</h4></div>
                            <div class="row ">
                                <div class="col-4">
                                    <?php 
                                    $now = date('Y-m-d');
                                    $punch = "punchin";
                                    $present = "SELECT emp_ID FROM punch WHERE date = '$now' AND status IS NOT NULL ";
                                    if ($result = mysqli_query($conn, $present)) {
                                        $row =mysqli_num_rows($result);
                                    }
                                    
                                    ?>
                                    <input type="submit" style="width:100%; height:200px;" class="btn btn-success" value="<?php echo $row?> Present" name="punchin">
                                    
                                </div>
                                <div class="col-4">
                                    <?php
                                    $sql = "SELECT emp_ID FROM employee";
                                    $result = mysqli_query($conn,$sql); 
                                    $emp = mysqli_num_rows($result);
                                    $now = date('Y-m-d');
                                    $sql = "SELECT * FROM application WHERE type ='leaves' AND status = 'Approved' AND start_date <= '$now' AND end_date >= '$now'";
                                    $result = mysqli_query($conn,$sql);
                                    $leave = mysqli_num_rows($result);
                                    $absent = "SELECT emp_ID FROM punch WHERE date = '$now' AND status IS NOT NULL";
                                    if($result = mysqli_query($conn,$absent)){
                                        $row = mysqli_num_rows($result);
                                        $ab = $emp-$row-$leave;
                                    }
                                    ?>
                                    <input type="submit" style="width:100%; height:200px;" class="btn btn-danger" value="<?php echo $ab?> Absent" name="punchout">
                                </div>
                                <div class="col-4">
                                    <?php
                                    $now = date('Y-m-d');
                                    $sql = "SELECT * FROM application WHERE type ='leaves' AND status = 'Approved' AND start_date <= '$now' AND end_date >= '$now'";
                                    if($result = mysqli_query($conn,$sql)){
                                        $leave = mysqli_num_rows($result);   
                                    }

                                    ?>
                                    <input type="submit" style="width:100%; height:200px;" class="btn btn-warning" value="<?php echo $leave?> On Leave" name="punchout">
                                </div>
                            </div>
                    </br></br>
                    <table class="table table-bordered">
                        <tr>
                            <th class="empID">Employee ID</th>
                            <th class="empName">Name</th>
                            <th class="empButton">Status</th>
                            <th class="empButton">Action</th>
                            <th class="empButton">Time</th>
                        </tr>
                        
                        <?php 
                        $now  = date('Y-m-d');
                        $sql = "SELECT employee.emp_ID, employee.name,punch.emp_ID, punch.status, punch.action, punch.time FROM employee INNER JOIN punch WHERE employee.emp_ID=punch.emp_ID AND date='$now' ";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while($employee = mysqli_fetch_assoc($result)) { 
                                $id = $employee['emp_ID'];
                                
                            ?>
                        <tr>
                            <td><?php echo $employee['emp_ID']; ?></td>
                            <td><?php echo $employee['name']; ?></td>
                            <td><?php echo $employee['status']; ?></td>
                            <td><?php echo $employee['action']; ?></td>
                            <td><?php echo $employee['time']; ?></td>
                            
                        </tr>

                        <?php    }
                        } else {?>
                        <tr>
                            
                            <td colspan="5">
                                    <?php echo "0 results"; ?> 
                            </td>
                            
                        </tr>
                            
                            
                        <?php    
                        }
                        
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- main content -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  </body>
</html>
