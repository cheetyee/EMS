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
                $emp = "SELECT * FROM employee WHERE name ='$name'";
                $empSQL = mysqli_query($conn, $emp);
                    if (mysqli_num_rows($empSQL) > 0) {
                        while($employee = mysqli_fetch_assoc($empSQL)) {
                            
                            
                        }
                    }?>
            <div class="col-lg-9 col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Apply Allowance</h4></div>
                    </br>
                    <div class="panel-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Employee ID</label>
								<input name="id" type="text" value="<?php echo $emp_ID; ?>" class="form-control" style="background-color:#e9ecef;" readonly>
							</div>
							</br>
							<div class="form-group">
							    <label>Employee Name</label>
								<input name="name" type="text" value="<?php echo $name; ?>" class="form-control" style="background-color:#e9ecef;" readonly>
							</div>
                            </br>
                            <div class="form-group">
                                <label>Allowance Name <span class="text-danger">*</span></label>
                                <select class="form-control" name="allowance" required>
                                    <option value="">---Select Allowance That Want To Claim---</option>
                                
                                <?php
                                $sql = "SELECT * FROM payheads WHERE allowance_type = 'fixed'";
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
                                <label>Amount <span class="text-danger">*</span></label>
								<input name="amount" type="text" class="form-control" Placeholder="Amount" required>
							</div>
							</br>
							<div class="form-group">
							    <label>Supporting Document <span class="text-danger">*</span></label>
								<input name="image" type="file" class="form-control" id="image" required>
							</div>
                            </br>
                            </br>
                            <div class="form-group">
                                <input type="submit" id="save" class="btn btn-success" value="Apply" name="apply">
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
    
    if( isset($_POST['apply']) ){
        $employee_ID = $_SESSION['id'];
        $allowance = $_POST['allowance'];
        $amount = $_POST['amount'];
        $image = $_FILES['image']['name'];
        
 
        $set = '1234567890';
        $id = substr(str_shuffle($set), 0, 5);
        $app_ID = 'APP-'.$id;
        // Get file info 
        /*$fileName = basename($_FILES["prove"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['prove']['tmp_name']; */
            //$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"])); 
            if(file_exists("upload/" . $_FILES["image"]["name"])){
                $store = $_FILES["image"]["name"];
                $_SESSION['status'] = "Image already exists . '.$store.'";
                
            }else{
        
                $sql = "INSERT INTO application (app_ID, emp_ID, status, type, name, image, amount) VALUES "
                . "( '$app_ID', '$employee_ID', 'Pending', 'allowance','$allowance', '$image', '$amount')";
                            
                if (mysqli_query($conn, $sql)) {
                    move_uploaded_file($_FILES["image"]["tmp_name"], "upload/".$_FILES["image"]["name"]);
                    $message = "apply for Claim";
                    $query ="INSERT INTO `notification` ( `name`,`app_ID`, `type`, `message`, `status`, `date`, `role`) VALUES ( '$name','$app_ID', 'apply', '$message', 'unread', CURRENT_TIMESTAMP, 'employee')";   
                    if (mysqli_query($conn, $query)) {
                        echo "<script>alert('Your application has been send. Please wait for the response.');window.location.assign('empAllowance.php');</script>";
                    }else {
                    echo "Error: " . $query . "<br>" . mysqli_error($conn);
                }
                    
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
        
            }
    }
    
    ?>

  </body>
  <script>  
 $(document).ready(function(){  
      $('#save').click(function(){  
           var image_name = $('#image').val();  
           if(image_name === '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#image').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) === -1)  
                {  
                     alert('Invalid Image File');  
                     $('#image').val('');  
                     return false;  
                }  
           }  
      });  
 });  
 </script>
</html>