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
            <div class="col-lg-9 col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Employee Salary</h4></div>
                    </br>
                    
                    <table class="table table-bordered">
                        <tr>
                            <th class="empNo">No.</th>
                            <th class="empName">Name</th>
                            <th class="empButton">Month</th>
                            <th class="empButton">Net Salary</th>
                            <th class="empButton"></th>
                        </tr>
                        
                        <?php 
                        $id = $_SESSION['id'];
                        $sql = "SELECT * FROM salary WHERE emp_ID ='$id'";
                        $result = mysqli_query($conn, $sql);
                        $i = 1;
                        $no = 0;

                        if (mysqli_num_rows($result) > 0) {
                            while($employee = mysqli_fetch_array($result)) { 
                                
                                $no=$no + $i;
                            ?>

                        
                        <tr>
                            <td class="empNo"><?php echo $no; ?></td>
                            <td><?php echo $_SESSION['name']; ?></td>
                            <td class="empRole"><?php echo $employee['pay_month']; ?></td>
                            <td>RM <?php echo $employee['net_salary']; ?></td>
                            <td><a href="viewPayroll.php?id=<?php echo $employee['salary_id']; ?>" class="btn btn-block btn-xs btn-info">View</a></td>
                            
                            
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
