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
                    <div class="panel-heading"><h4>Edit Employee Details</h4></div>
                    <div class="panel-body">
                        <form action="" method="POST">
                        <?php 
                        
                        $id = $_GET['holiday_ID'];
                        $sql = "SELECT * FROM holiday WHERE holiday_id='$id'";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while($holiday = mysqli_fetch_assoc($result)) { ?>
                            
                            <div class="form-group">
                                <input type="text" class="form-control input-sm" name="name" value="<?php echo $holiday['holiday_title']?>" disabled>
                            </div>
                            </br>
                            <div class="form-group">
                                <input type="tel" class="form-control input-sm" name="desc" value="<?php echo $holiday['holiday_desc']?>" disabled>
                            </div>
                            </br>
                            <div class="form-group">
                                <input type="date" class="form-control input-sm" name="date" value="<?php echo $holiday['holiday_date']?>" disabled>
                            </div>
                            </br>
                            <div class="form-group">
                                <input type="text" class="form-control input-sm" name="type" value="<?php echo $holiday['holiday_type']?>" disabled>
                            </div>
                            </br>

                        <?php    }
                        } else {
                            echo "0 results";
                        }
                        
                        ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main content -->


    
  </body>
</html>