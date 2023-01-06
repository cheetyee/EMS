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
            <?php
                $name = $_SESSION['name'];
                $emp_ID = $_SESSION['id'];
                                if(isset($_GET['app_ID'])){
                                    $app_ID = $_GET['app_ID'];
                                    $app = "SELECT * FROM application WHERE app_ID ='$app_ID' AND emp_ID ='$emp_ID'";
                                    $showApp = mysqli_query($conn, $app);
                                    while($row=mysqli_fetch_array($showApp)){
                                        $start = $row['start_date'];
                                        $end = $row['end_date'];
                                        $reason = $row['reason'];
                                        $status = $row['status'];
                                        $allowance = $row['name'];
                                        $amount = $row['amount'];
                                        
                                         
                    ?>
            <div class="col-lg-9 col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Apply Leaves</h4></div>
                    </br>
                    <div class="panel-body">
                        <form action="" method="POST">
                            <div class="form-group">
								<input name="id" type="text" value="<?php echo $emp_ID; ?>" class="form-control" style="background-color:#e9ecef;" readonly>
							</div>
							</br>
							<div class="form-group">
								<input name="name" type="text" value="<?php echo $name; ?>" class="form-control" style="background-color:#e9ecef;" readonly>
							</div>
                            </br>
                            <div class="form-group">
                                <label>Allowance Name <span class="text-danger">*</span></label>
                                <select class="form-control" name="allowance" style="background-color:#e9ecef;" readonly>
                                    
                                
                                <?php
                                $sql = "SELECT * FROM payheads WHERE payhead_name = '$allowance'";
                                $result = mysqli_query($conn,$sql);
                                if(mysqli_num_rows($result)>0){
                                    while($row = mysqli_fetch_assoc($result)){
                                        $payhead_name = $row['payhead_name'];
                                        ?>
                                        <option value="<?php echo $payhead_name?>"><?php echo $payhead_name?></option>
                                        <?php
                                    }
                                }
                                ?>
                                </select>
                            </div>
                            </br>
                            <div class="form-group">
                                <label>Amount </label>
								<input name="amount" type="text" value="<?php echo $amount?>" class="form-control"  style="background-color:#e9ecef;" readonly>
							</div>
							</br>
							
							<div class="form-group">
							    <label>Supporting Document <span class="text-danger">*</span></label>
							    </br>
							    <?php $app = "SELECT * FROM application WHERE app_ID ='$app_ID' AND emp_ID ='$emp_ID'";
                                    $showApp = mysqli_query($conn, $app);
                                    while($row=mysqli_fetch_array($showApp)){
                                        
							        echo '<img src="upload/'.$row['image'].'" width="300px;" height="240px;">';
							    }?>                         
							    
								
							</div>
                            </br>
                            </br>
                            </br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }}?>
    <!-- main content -->


  </body>
</html>