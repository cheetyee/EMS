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
                    <div class="panel-heading"><h4>Apply Allowance</h4></div>
                    </br>
                    <div class="panel-body">
                        <?php
                            $name = $_SESSION['name'];
                            $emp_ID = $_SESSION['id'];
                                if(isset($_GET['app_ID'])){
                                    $app_ID = $_GET['app_ID'];
                                    $app = "SELECT * FROM application WHERE app_ID ='$app_ID'";
                                    $showApp = mysqli_query($conn, $app);
                                    if(mysqli_num_rows($result)>0){
                                        while($row=mysqli_fetch_array($showApp)){
                                            $start = $row['start_date'];
                                            $end = $row['end_date'];
                                            $reason = $row['reason'];
                                            $status = $row['status'];
                                            $allowance = $row['name'];
                                            $amount = $row['amount'];
                                            $image = $row['image'];
                                            echo $status;
                                                    
                                                     
                                ?>
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
                                <label>Allowance Name </label>
                                <select class="form-control" name="allowance" style="background-color:#e9ecef;" readonly>
                                
                                        <option value="<?php echo $allowance?>"><?php echo $allowance?></option>

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
							    <?php 
                                        
							        echo '<img src="upload/'.$image.'" width="300px;" height="240px;">';
							   ?>                         
							    
								
							</div>
							<?php 
							
							if($status=='Pending'){?>
                                <div class="form-group">
                                <input type="submit" class="btn btn-success" value="Approve" name="approve">
                                <input type="submit" class="btn btn-danger" value="Reject" name="reject">
                            </div>
                            <?php
                            }?>
                            </br>
                            </br>
                            </br>
                        </form>
                        <?php }}} ?>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!-- main content -->
<?php 
    
    if( isset($_POST['approve']) ){
        $app_ID = $_GET['app_ID'];
        $name = $_SESSION['name'];
        $amount = $_POST['amount'];
        $allowance = $_POST['allowance'];
        $emp_ID = $_POST['id'];

                $sql = "UPDATE application SET status='Approved', approved_by = '$name'  WHERE app_ID = '$app_ID'";

                if (mysqli_query($conn, $sql)) {
                    $message = "has been respond to your claim";
                    $query ="INSERT INTO `notification` ( `name`, `app_ID`, `type`, `message`, `status`, `date`, `role`) VALUES ( '$name', '$app_ID', 'respond', '$message', 'unread', CURRENT_TIMESTAMP, 'admin')";   
                    if (mysqli_query($conn, $query)) {
                        $update = "UPDATE pay_structure SET amount = amount-'$amount' WHERE payhead_name = '$allowance' AND emp_ID='$emp_ID'";
                        if (mysqli_query($conn, $update)) {
                        echo "<script>alert('Your application has been send. Please wait for the response.');window.location.assign('application.php');</script>";
                        }else{
                            echo "Error: " . $update . "<br>" . mysqli_error($conn);
                        }
                    }else {
                    echo "Error: " . $query . "<br>" . mysqli_error($conn);
                    }
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
    }else if( isset($_POST['reject']) ){
        $app_ID = $_GET['app_ID'];
        $name = $_SESSION['name'];
                $sql = "UPDATE application SET status='Rejected', approved_by = '$name' WHERE app_ID = '$app_ID'";

                if (mysqli_query($conn, $sql)) {
                    $message = "has been respond to your application";
                    $query ="INSERT INTO `notification` ( `name`, `app_ID`, `type`, `message`, `status`, `date`, `role`) VALUES ( '$name', '$app_ID', 'respond', '$message', 'unread', CURRENT_TIMESTAMP, 'admin')";   
                    if (mysqli_query($conn, $query)) {
                        echo "<script>alert('Your application has been send. Please wait for the response.');window.location.assign('allowance.php');</script>";
                    }else {
                    echo "Error: " . $query . "<br>" . mysqli_error($conn);
                    }
                }else{
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
    
    }?>

  </body>
</html>
