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
                    <div class="panel-heading"><h4>Edit Employee Salary</h4></div>
                    <div class="panel-body">
                        <form action="" method="POST">
                        <?php 
                        
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM employee WHERE emp_ID='$id'";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while($employee = mysqli_fetch_assoc($result)) { 
                                $empAmount = $employee['amount'];
                                $payhead = $employee['payhead_name'];
                            ?>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Employee ID</label>
                                            <input type="text" class="form-control input-sm" name="id" value="<?php echo $employee['emp_ID']?>" style="background-color:#e9ecef;" readonly>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Employee Name</label>
                                            <input type="text" class="form-control input-sm" name="name" value="<?php echo $employee['name']?>" style="background-color:#e9ecef;" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Salary Type</label>
                                            <select class="form-control" name="salary">
                                                <option value="<?php echo $payhead?>"><?php echo $payhead?></option>
                                            <?php
                                            $payhead = $employee['payhead_name'];
                                            
                                            $sql = "SELECT * FROM payheads WHERE payhead_name <> '$payhead' AND payhead_role = 'salary' ";
                                            $run = mysqli_query($conn, $sql);
                                            if(mysqli_num_rows($run)>0){
                                                while($pay = mysqli_fetch_assoc($run)){
                                                    ?>
                                                    <option value="<?php echo $pay['payhead_name']?>"><?php echo $pay['payhead_name']?></option>
                                                    <?php
                                                }
                                            }
                                            ?>    
                                            </select>
                                            
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input type="text" class="form-control input-sm" name="amount" value="<?php echo $employee['amount']?>" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="form-group">
                                            <h4>Earning</h4>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <h4>Deduction</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                <?php 
                                $earn = 0;
                                $id = $_GET['id'];
                                $sql = "SELECT * FROM pay_structure WHERE emp_ID = '$id'";
                                $result1 = mysqli_query($conn,$sql);
                                if(mysqli_num_rows($result1)>0){
                                    while($struc = mysqli_fetch_assoc($result1)){
                                        $payhead_name = $struc['payhead_name'];
                                        $amount = $struc['amount'];
                                        $type = "SELECT * FROM payheads WHERE payhead_name = '$payhead_name' AND payhead_type = 'earnings'";
                                        $result = mysqli_query($conn,$type);
                                        if(mysqli_num_rows($result)>0){
                                            while($struc = mysqli_fetch_assoc($result)){
                                                
                                            
                                ?>
                                            <div class="form-group">
                                                <input type="text" style="border:none; margin-bottom:4px; width:100%;" name="name[]" value="<?php echo $payhead_name?>" readonly>
                                                
                                                <input type="text" class="form-control input-sm" name="amt[]" value="<?php echo $amount?>">
                                            </div>
                                            </br>
                                            
                                <?php       
                                            }
                                        }
                                    }
                                }
                                
                                
                                ?>
                                    </div>
                                    <div class="col">
                                <?php
                                $deduct = 0;
                                $id = $_GET['id'];
                                $sql = "SELECT * FROM pay_structure WHERE emp_ID = '$id' ";
                                $result1 = mysqli_query($conn,$sql);
                                if(mysqli_num_rows($result1)>0){
                                    while($struc = mysqli_fetch_assoc($result1)){
                                        $payhead_name = $struc['payhead_name'];
                                        $amount = $struc['amount'];
                                        $type = "SELECT * FROM payheads WHERE payhead_name = '$payhead_name'AND payhead_type ='deductions' AND allowance_type != 'taxes'";
                                        $result = mysqli_query($conn,$type);
                                        if(mysqli_num_rows($result)>0){
                                            while($struc = mysqli_fetch_assoc($result)){
                                                
                                ?>    
                                            <div class="form-group">
                                                
                                                <input type="text" style="border:none; margin-bottom:4px; width:100%; " name="name[]" value="<?php echo $payhead_name?>" readonly>
                                                
                                                <input type="text" class="form-control input-sm" name="amt[]" value="<?php echo $amount?>">
                                            </div>
                                            </br>
                                <?php
                                               
                                            }
                                        }
                                    }
                                }
                                
                                ?>
                                   </div>
               
                                
                            </div>
                            
                            </br>
                            
                            
							</br>
                            <div class="form-group">
                                <input type="submit" class="btn btn-sm btn-warning" value="Update" name="update">
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
    
    if( isset($_POST['update']) ){

        $id = $_POST['id'];
        $month = date('M');
        $date = date('d-m-y H:i:s');
        $salary = $_POST['salary'];
        $amount = $_POST['amount'];
        $sql = "UPDATE employee SET amount = '$amount' WHERE emp_ID = '$id' AND payhead_name ='$salary'";
            
        $payhead = $_POST['name'];
        $amt = $_POST['amt'];
                    
            foreach($amt as $item=>$AMT){
                $pay = $payhead[$item];
                $pay_amt = $AMT;
                $pay_amt = number_format($pay_amt,2,".","");
                //echo $payheads ."-".$employee_ID."-". $pay_amt;
                    
                $structure = "UPDATE pay_structure SET  amount = '$pay_amt' WHERE emp_ID ='$id' AND payhead_name = '$pay'";
                $run = mysqli_query($conn,$structure);
                    
                }

        
    if (mysqli_query($conn, $sql)) {
        if (mysqli_query($conn, $structure)) {
            echo "<script>alert('Update successfully');window.location.assign('salary.php');</script>";
            
        } else{
            echo "Error updating record: " .$structure."" .mysqli_error($conn);
        }
    }else {
            echo "Error updating record: " .$sql."" .mysqli_error($conn);
     }

    }
                            }
                            
}

    ?>

    
        </body>
    </html>