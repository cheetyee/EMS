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
                    <div class="panel-heading"><h4>Attendance</h4></div>
                    
                    </br>

                    <table class="table table-bordered">
                        <tr>
                            <th class="empID">Employee ID</th>
                            <th class="empName">Name</th>
                            <th class="empButton">Date</th>
                            <th class="empButton">Status</th>
                        </tr>
                        
                        <?php 
                        

                        $attend = "SELECT * FROM punch WHERE status IS NOT NULL";
                        $attendSQL = mysqli_query($conn, $attend);
                        if (mysqli_num_rows($attendSQL) > 0) {
                            while($attendance = mysqli_fetch_assoc($attendSQL)) {
                                $id = $attendance['emp_ID'];
                        $emp = "SELECT * FROM employee WHERE emp_ID ='$id'";
                        $empSQL = mysqli_query($conn, $emp);
                        if (mysqli_num_rows($empSQL) > 0) {
                            while($employee = mysqli_fetch_assoc($empSQL)) { 
                                $emp_ID = $employee['emp_ID'];
                                
                            ?>
                            
                        <tr>
                            <td ><?php echo $attendance['emp_ID']; ?></td>
                            <td><?php echo $employee['name']; ?></td>
                            <td><?php echo $attendance['date']; ?></td>
                            <td><?php echo $attendance['status']; ?></td>
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