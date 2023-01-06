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
                    <div class="panel-heading"><h4>Add Holiday</h4></div>
                    </br>
                    <div class="panel-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control input-sm" name="name" placeholder="Name *" required>
                            </div>
                            </br>
                            <div class="form-group">
                                <input type="text" class="form-control input-sm" name="desc" placeholder="Description *" required>
                            </div>
                            </br>
                            <div class="form-group">
                                <input type="date" class="form-control calendar" name="date" placeholder="Date *" required>
                            </div>
							</br>
                            <div class="form-group">
				                <label for="payhead_type">Holiday Type</label>
				                <select class="form-control" id="type" name="type" required>
				                	<option value="">---Select Holiday Type---</option>
				                	<option value="Compulsory">Compulsory</option>
				                	<option value="Restricted">Restricted</option>
				                </select>
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
        $desc = $_POST['desc'];
        $date = $_POST['date'];
        $type = $_POST['type'];
        
                $sql = "INSERT INTO holiday (holiday_title, holiday_desc, holiday_date, holiday_type) VALUES ('$name','$desc','$date','$type')";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('New Holiday created successfully');window.location.assign('holiday.php');</script>";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
        
    }
    
    ?>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </body>
</html>
