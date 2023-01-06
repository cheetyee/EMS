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
                    <div class="panel-heading"><h4>Employee Salary</h4></div>
                    
                    </br></br>
                    
                    <table class="table table-bordered">
                        <tr>
                            <th class="empID">Employee ID</th>
                            <th class="empName">Name</th>
                            <th class="empButton"></th>
                            <th class="empButton"></th>
                        </tr>
                        <?php 
                        
                        $sql = "SELECT * FROM employee";
                        $result = mysqli_query($conn, $sql);
                        

                        if (mysqli_num_rows($result) > 0) {
                            while($employee = mysqli_fetch_assoc($result)) { ?>
                            

                        
                        <tr>
                            <td class="empID"><?php echo $employee['emp_ID']; ?></td>
                            <td><?php echo $employee['name']; ?></td>
                            <td><a href="calculatePayroll.php?id=<?php echo $employee['emp_ID']; ?>" class="btn btn-block btn-sm btn-info"style="color:white"><i class="fa fa-calculator"> Calculate</a></td>
                            <td><a href="editPayroll.php?id=<?php echo $employee['emp_ID']; ?>" class="btn btn-block btn-sm btn-warning"style="color:white">Edit</a></td>
                            
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
