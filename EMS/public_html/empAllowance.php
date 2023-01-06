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
         
        require 'empNav.php';
    ?>
    <!-- nav -->

    <!-- main content -->
    
    <div class="container">
        <div class="row">
            <?php 
         
                require 'empSidebar.php';
            ?>
            <div class="col-lg-9 col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Application</h4></div>
                        <a href="applyAllowance.php" style=" float:right;" class="btn btn-primary"><i class="fa fa-plus"></i>Apply Allowance</a>
                    </br></br>

                    <table class="table table-bordered">
                        <tr>
                            <th class="empNo">No.</th>
                            <th class="empName">Name</th>
                            <th class="empButton">Status</th>
                            <th class="empButton"></th>
                        </tr>
                        <?php 
                        $name = $_SESSION['name'];
                        $emp_ID = $_SESSION['id'];

                        $apply = "SELECT * FROM application WHERE emp_ID = '$emp_ID' AND type='allowance' ORDER BY status='Pending' DESC";
                        $applySQL = mysqli_query($conn, $apply);
                            $i=1;
                            $no = 0;
                        if (mysqli_num_rows($applySQL) > 0) {
                            while($application = mysqli_fetch_assoc($applySQL)) { 
                                $no = $no + $i;
                            ?>
                        
                        <tr>
                            <td class="empNo"><?php echo $no; ?></td>
                            <td><?php echo $name; ?></td>
                            <?php
                            if($application['status']=='Pending'){ // [val1] can be 'approved'
                                echo "<td style='background-color: #FFC107; color:#ffffff;'>".$application['status']."</td>"; 
                            }else if($application['status']=='Approved'){// [val2]can be 'rejected'
                                echo "<td style='background-color: #198754; color:#ffffff;'>".$application['status']."</td>"; 
                            }else if($application['status']=='Rejected'){ //[val3] can be 'on hold'
                                echo "<td style='background-color: #dc3545; color:#ffffff;'>".$application['status']."</td>";
                            }
                            ?>
                           
                            <td><a href="empAllDetails.php?app_ID=<?php echo $application['app_ID']; ?>" class="btn btn-block btn-xs btn-info">View</a></td>
                        </tr>

                        <?php }
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