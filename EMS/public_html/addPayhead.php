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
    <script language="javascript" type="text/javascript">
        function toggleMe(val) 
        {
        	var designation = document.getElementById('designation');
        	amount.style.visibility = "hidden";
        	rate.style.visibility = "hidden";
        	if(val=='fixed'|| val =='non-fixed')
        	{
        		amount.style.visibility = "visible";
        	    
        		
        	}
        	else if(val=='taxes')
        	{
        		rate.style.visibility = "visible";
        	    
        		
        	}else
        	{
        		amount.style.visibility = "hidden";
        		rate.style.visibility = "hidden";
        	    
        		
        	}
        }
</script>
    
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
                    <div class="panel-heading"><h4>Add Salary Type</h4></div>
                    </br>
                    <div class="panel-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control input-sm" name="name" placeholder="Payhead Name *" required>
                            </div>
                            </br>
                            <div class="form-group">
                                <input type="text" class="form-control input-sm" name="desc" placeholder="Payhead Description *" required>
                            </div>
                            </br>
                            <div class="form-group">
				                <label for="payhead_type">Pay Head Type:</label>
				                <select class="form-control" id="payhead_type" name="type" required>
				                	<option value="">---Select Pay Head Type---</option>
				                	<option value="earnings">Earnings</option>
				                	<option value="deductions">Deductions</option>
				                </select>
				            </div>
				            </br>
				            <div class="form-group">
				                <label for="payhead_type">Pay Head Role:</label>
				                <select class="form-control" id="payhead_type" name="role" required>
				                	<option value="">---Select Pay Head Role---</option>
				                	<option value="salary">Salary</option>
				                	<option value="extra">Extra</option>
				                </select>
				            </div>
                            </br>
                            <div class="form-group">
				                <label for="payhead_type">Allowance Type:</label>
				                <select name="aType" class="form-control" onchange="toggleMe(this.value)">   
                                <option value="0">---Select Allowance Type---</option> 
                                <option value="fixed">Fixed</option>
                                <option value="non-fixed">Non-Fixed</option>
                                <option value="taxes">Taxes</option> 
                                </select>
				            </div>
				            </br>
				            <div class="form-group"  >
				                 <input name="amount" class=" form-control" type="text" id="amount" Placeholder="Amount" style="visibility:hidden"/>
				            </div>
				            <div class="form-group">
				                <input name="rate" class=" form-control" type="text" id="rate" Placeholder="Rate(%)" style="visibility:hidden"/>
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
        $type = $_POST['type'];
        $role = $_POST['role'];
        $allowanceType = $_POST['aType'];
        $amount = $_POST['amount'];
        
                
                    $SQL = "INSERT INTO payheads (payhead_name, payhead_desc, payhead_type, payhead_role, allowance_type, amount) VALUES ('$name','$desc','$type', '$role', '$allowanceType', '$amount')";
                
                if (mysqli_query($conn, $SQL)) {
                    echo "<script>alert('New payhead created successfully');window.location.assign('payheadType.php');</script>";
                    
                }else{
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    echo "Error: " . $SQL . "<br>" . mysqli_error($conn);
                }
        
    }
    
    ?>
    
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </body>
</html>
