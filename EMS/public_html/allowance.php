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
                    <div class="panel-heading"><h4>Allowance</h4></div>
                        </br>

                    <table class="table table-bordered">
                        <tr>
                            <th class="empID">Employee ID</th>
                            <th class="empName">Name</th>
                            <th class="empButton">Status</th>
                            <th class="empButton"></th>
                        </tr>
                        <?php 
                        $name = $_SESSION['name'];
                        $emp = "SELECT * FROM employee WHERE name ='$name'";
                        $empSQL = mysqli_query($conn, $emp);
                        if (mysqli_num_rows($empSQL) > 0) {
                            while($employee = mysqli_fetch_assoc($empSQL)) { 
                                $emp_ID = $employee['emp_ID'];

                        $apply = "SELECT * FROM application WHERE type='allowance' ORDER BY status='Pending' DESC";
                        $applySQL = mysqli_query($conn, $apply);

                        if (mysqli_num_rows($applySQL) > 0) {
                            while($application = mysqli_fetch_assoc($applySQL)) { ?>
                        
                        <tr>
                            <td><?php echo $application['emp_ID']; ?></td>
                            <td><?php echo $employee['name']; ?></td>
                            <?php
                            if($application['status']=='Pending'){ // [val1] can be 'approved'
                                echo "<td style='background-color: #FFC107; color:#ffffff;'>".$application['status']."</td>"; 
                            }else if($application['status']=='Approved'){// [val2]can be 'rejected'
                                echo "<td style='background-color: #198754; color:#ffffff;'>".$application['status']."</td>"; 
                            }else if($application['status']=='Rejected'){ //[val3] can be 'on hold'
                                echo "<td style='background-color: #dc3545; color:#ffffff;'>".$application['status']."</td>";
                            }
                            ?>
                            <td><a href="allDetails.php?app_ID=<?php echo $application['app_ID']; ?>" class="btn btn-block btn-xs btn-info">View</a></td>
                        </tr>

                        <?php }
                        } else {?>
                        <tr>
                            <td colspan="5">
                                    <?php echo "0 results"; ?> 
                            </td>
                            
                        </tr>
                            
                            
                        <?php    
                        }}}
                        
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