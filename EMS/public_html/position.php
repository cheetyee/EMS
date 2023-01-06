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
                    <div class="panel-heading"><h4>Position List</h4></div>
                    <a href="addPosition.php" style=" float:right;" class="btn btn-primary"><i class="fa fa-plus"></i> Add Position</a>
                    </br></br>
                    
                    <table class="table table-bordered">
                        <tr>
                            <th class="empNo">No.</th>
                            <th class="empName">Name</th>
                            <th class="empButton">Role</th>
                        </tr>
                        <?php 
                        
                        $sql = "SELECT * FROM position";
                        $result = mysqli_query($conn, $sql);
                         $i= 1;
                         $no= 0;

                        if (mysqli_num_rows($result) > 0) {
                            while($design = mysqli_fetch_assoc($result)) { 
                            $no = $no + $i;
                            ?>

                        
                        <tr>
                            <td class="empNo"><?php echo $no; ?></td>
                            <td><?php echo $design['position_name']; ?></td>
                            <td><?php echo $design['role_name']; ?></td>
                            
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