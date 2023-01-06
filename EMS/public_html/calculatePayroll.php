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
                    <div class="panel-heading"><h4>Calculate Employee Salary</h4></div>
                    <div class="panel-body">
                        <form action="" method="POST">
                        <?php 
                        
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM employee WHERE emp_ID='$id'";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while($employee = mysqli_fetch_assoc($result)) { 
                                $empAmount = $employee['amount'];
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
                                            <input type="text" class="form-control input-sm" name="name" value="<?php echo $employee['payhead_name']?>" >
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input type="text" class="form-control input-sm" name="name" value="<?php echo $employee['amount']?>" >
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
                                                if($struc['allowance_type']=='non-fixed'){
                                            
                                ?>
                                            <div class="form-group">
                                                <label><?php echo $payhead_name?></label>
                                                <input type="text" class="form-control input-sm" name="amt" value="<?php echo $amount;?>">
                                            </div>
                                            
                                <?php       
                                            $earn += $amount; 
                                            $earn = number_format($earn,2,'.', '');}
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
                                        $type = "SELECT * FROM payheads WHERE payhead_name = '$payhead_name'AND payhead_type ='deductions' AND allowance_type ='non-fixed'";
                                        $result = mysqli_query($conn,$type);
                                        if(mysqli_num_rows($result)>0){
                                            while($struc = mysqli_fetch_assoc($result)){
                                ?>    
                                            <div class="form-group">
                                                <label><?php echo $payhead_name?></label>
                                                <input type="text" class="form-control input-sm" name="amt" value="<?php echo $amount?>">
                                            </div>
                                <?php
                                        $deduct = $amount++;
                                $deduct = number_format($deduct,2 ,'.', '');    }
                                        }
                                    }
                                }
                                
                                ?>
                                   </div>
               
                                
                            </div>
                            
                            </br>
                            <div class="row mb-3">
                                <div class="col">
                                    <div class="form-group">
                                        <h4>Statutory Contribution</h4>
                                    </div>
                                </div>
                            </div>
                                
                            <div class="row mb-3">
                                    <div class="col">
                                <?php 
                                $tax = 0;
                                $total = 0;
                                $socso = 0;
                                $epf = 0;
                                $id = $_GET['id'];
                                $sql = "SELECT * FROM payheads WHERE allowance_type = 'taxes'";
                                $result1 = mysqli_query($conn,$sql);
                                if(mysqli_num_rows($result1)>0){
                                    while($struc = mysqli_fetch_assoc($result1)){
                                        $payhead_name = $struc['payhead_name'];
                                        $amt = $struc['amount'];
                                ?>
                                            <div class="form-group">
                                                <label><?php echo $payhead_name?></label>
                                                <?php 
                                                if($payhead_name=='Income Tax'){
                                                    if($empAmount>=0 && $empAmount<=5000){
                                                        $total = ($empAmount * 0)/100;
                                                        $total = number_format($total,2,'.', '');
                                                    }else if($empAmount>=5001 && $empAmount<=20000){
                                                        $total = ($empAmount * 1)/100;
                                                        $total = number_format($total,2,'.', '');
                                                    }else if($empAmount>=20001 && $empAmount<=35000){
                                                        $total = ($empAmount * 3)/100;
                                                        $total = number_format($total,2,'.', '');
                                                    }else if($empAmount>=35000 && $empAmount<=50000){
                                                        $total = ($empAmount * 8)/100;
                                                        $total = number_format($total,2,'.', '');
                                                    }elseif($empAmount>=50001 && $empAmount<=70000){
                                                        $total = ($empAmount * 13)/100;
                                                        $total = number_format($total,2,'.', '');
                                                    }else if($empAmount>=70001 && $empAmount<=100000){
                                                        $total = ($empAmount * 21)/100;
                                                        $total = number_format($total,2,'.', '');
                                                    }else if($empAmount>=100001 && $empAmount<=250000){
                                                        $total = ($empAmount * 24)/100;
                                                        $total = number_format($total,2,'.', '');
                                                    }else if($empAmount>=250001 && $empAmount<=400000){
                                                        $total = ($empAmount * 24.5)/100;
                                                        $total = number_format($total,2,'.', '');
                                                    }else if($empAmount>=400001 && $empAmount<=600000){
                                                        $total = ($empAmount * 25)/100;
                                                        $total = number_format($total,2,'.', '');
                                                    }else if($empAmount>=600001 && $empAmount<=1000000){
                                                        $total = ($empAmount * 26)/100;
                                                        $total = number_format($total,2,'.', '');
                                                    }else if($empAmount>=1000001 && $empAmount<=2000000){
                                                        $total = ($empAmount * 28)/100;
                                                        $total = number_format($total,2,'.', '');
                                                    }else if($empAmount>2000000 ){
                                                        $total = ($empAmount * 30)/100;
                                                        $total = number_format($total,2,'.', '');
                                                    }
                                                    
                                                    
                                                ?>
                                                    <input type="text" class="form-control input-sm" name="amt" value="<?php echo $total;?>">
                                                <?php
                                                }else if($payhead_name=='Employee Provident Fund (EPF)'){
                                                        $epf = (($empAmount + $earn - $deduct) * 11)/100;
                                                        $epf = number_format($epf,2,'.', '');
                                                ?>
                                                    <input type="text" class="form-control input-sm" name="amt" value="<?php echo $epf;?>">
                                                <?php
                                                }else if($payhead_name=='Social Security Organisation (SOCSO)'){
                                                        $socso = (($empAmount + $earn - $deduct) * 0.5)/100;
                                                        $socso= number_format($socso,2,'.', '');
                                                
                                                ?>
                                                    <input type="text" class="form-control input-sm" name="amt" value="<?php echo $socso;?>">
                                                <?php
                                                $tax = $total + $epf + $socso;
                                                $tax = number_format($tax,2,'.', '');
                                                }
                                                
                                                ?>
                                               
                                            </div>
                                            
                                <?php       
                                            
                                        
                                    }
                                }
                                ?>
                                    </div>
                                </div>
                            </br>
                            
							</br>
                            <div class="form-group">
                                <input type="submit" value="Calculate" class="btn btn-block btn-sm btn-info"style="color:white" name=update>
                                <a href="editPayroll.php?id=<?php echo $employee['emp_ID']; ?>" class="btn btn-block btn-sm btn-warning"style="color:white">Edit Payroll</a>
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
        $date = date('Y-m-d H:i:s');
        echo $tax;
        $net = $empAmount + $earn - $deduct - $tax;
        $net = number_format($net,2,'.', '');

        $sql = "INSERT INTO salary (emp_ID, tax_total,earning_total,deduction_total,net_salary,pay_month,generate_date) VALUES('$id', '$tax','$earn','$deduct','$net','$month','$date')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Generate successfully');window.location.assign('history.php');</script>";
            
        } else {
            echo "Error updating record: " .$sql."". mysqli_error($conn);
        }

    }
                            }
                            
}

    ?>

    
        </body>
    </html>