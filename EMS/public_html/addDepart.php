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
    <?php date_default_timezone_set("Asia/Singapore");?>
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
                    <div class="panel-heading"><h4>Add Department</h4></div>
                    </br>
                    <div class="panel-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control input-sm" name="name" placeholder="Department Name *" required>
                            </div>
                            </br>
                            <div class="form-group">
                                <input type="submit" class="btn btn-sm btn-success" value="Add " name="add">
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
    
    if( isset($_POST['add']) ){
        $name = $_POST['name'];

        
                $sql = "INSERT INTO department (depart_name) VALUES ('$name')";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('New department created successfully');window.location.assign('department.php');</script>";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
        
    }
    
    ?>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </body>
</html>