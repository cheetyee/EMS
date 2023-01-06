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
                    <div class="panel-heading"><h4>Employee Payslip</h4></div>
                    <div class="panel-body">
                        <?php 
                        
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM salary WHERE salary_id='$id'";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while($salary = mysqli_fetch_assoc($result)) { 
                            $date = $salary['generate_date'];
                            $emp_ID = $salary['emp_ID'];
                            $newDate = date("d-m-Y", strtotime($date));
                            $SQL = "SELECT * FROM employee WHERE emp_ID = '$emp_ID'";
                            $result = mysqli_query($conn, $SQL);
                            $emp = mysqli_fetch_assoc($result);
                            
                            ?>
                            <div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<h4 class="payslip-title"><?php echo $salary['pay_month']?> Payslip</h4>
									<div class="row">
										<div class="col-sm-6 m-b-20">
											<img src="../upload/Logo.png" class="inv-logo" alt="">
											<ul class="list-unstyled mb-0">
												<li>B26 & B28, </li>
												<li>Jalan Tun Ismail 10,</li>
												<li>25000 Kuantan, Pahang</li>
											</ul>
										</div>
										<div class="col-sm-6 m-b-20">
											<div class="invoice-details">
												<h3 class="text-uppercase"></h3>
												<ul class="list-unstyled">
													<li>Date: <span><?php echo $newDate ?></span></li>
												</ul>
											</div>
										</div>
									</div>
									</br></br>
									<div class="row">
										<div class="col-lg-12 m-b-20">
											<ul class="list-unstyled">
												<li><h5 class="mb-0"><strong><?php echo $emp['name']?></strong></h5></li>
												<li><span><?php echo $emp['design_name'].' '.$emp['position_name']?></span></li>
												<li>Employee ID: <?php echo $emp_ID?></li>
											</ul>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div>
												<h4 class="m-b-10"><strong>Earnings</strong></h4>
												<table class="table table-bordered">
													<tbody>
														<tr>
															<td><strong><?php echo $emp['payhead_name']?></strong></td>
															<td><span class="float-right">RM <?php echo $emp['amount']?></span></td>
														</tr>
														<?php
														$emp_ID = $salary['emp_ID'];
                                                        $sql = "SELECT * FROM pay_structure WHERE emp_ID = '$emp_ID'";
                                                        $result1 = mysqli_query($conn,$sql);
                                                        if(mysqli_num_rows($result1)>0){
                                                            while($struc = mysqli_fetch_assoc($result1)){
                                                                $payhead_name = $struc['payhead_name'];
                                                                $amount = $struc['amount'];
                                                                $type = "SELECT * FROM payheads WHERE payhead_name = '$payhead_name' AND payhead_type = 'earnings'";
                                                                $result = mysqli_query($conn,$type);
                                                                if(mysqli_num_rows($result)>0){
                                                                    while($pay = mysqli_fetch_assoc($result)){
                                                                        if($pay['allowance_type']=='non-fixed' ){
                                                                    
                                                        ?>
                                                        	<tr>
    															<td><strong><?php echo $pay['payhead_name']?></strong></td>
    															<td><span class="float-right">RM <?php echo $amount?></span></td>
														    </tr>
														    <?php
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
														?>
														<tr>
															<td><strong>Total Earnings</strong></td>
															<td><span class="float-right"><strong>RM <?php $total = $emp['amount']+ $salary['earning_total'];
															$total = number_format($total,2);
															echo $total;
															?></strong></span></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<div class="col-sm-6">
											<div>
												<h4 class="m-b-10"><strong>Deductions</strong></h4>
												<table class="table table-bordered">
													<tbody>
														<?php
														$emp_ID = $salary['emp_ID'];
                                                        $sql = "SELECT * FROM pay_structure WHERE emp_ID = '$emp_ID'";
                                                        $result1 = mysqli_query($conn,$sql);
                                                        if(mysqli_num_rows($result1)>0){
                                                            while($struc = mysqli_fetch_assoc($result1)){
                                                                $payhead_name = $struc['payhead_name'];
                                                                $amount = $struc['amount'];
                                                                $type = "SELECT * FROM payheads WHERE payhead_name = '$payhead_name' AND payhead_type = 'deductions'";
                                                                $result = mysqli_query($conn,$type);
                                                                if(mysqli_num_rows($result)>0){
                                                                    while($pay = mysqli_fetch_assoc($result)){
                                                                        if($pay['allowance_type']=='non-fixed' ){
                                                                    
                                                        ?>
                                                        	<tr>
    															<td><strong><?php echo $pay['payhead_name']?></strong></td>
    															<td><span class="float-right">RM <?php echo $amount?></span></td>
														    </tr>
														    <?php
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
														?>
														<tr>
															<td><strong>Total Deduction</strong></td>
															<td><span class="float-right"><strong>RM <?php $total = $salary['deduction_total'];
															$total = number_format($total,2);
															echo $total;
															?></strong></span></td>
														</tr>
													</tbody>
												</table>
												</br>
												</br>
											</div>
										</div>
										<div class="col-sm-12">
											<div>
												<h4 class="m-b-10"><strong>Statutory Contribution</strong></h4>
												<table class="table table-bordered">
												    <tbody>
														<?php
														$emp_ID = $salary['emp_ID'];
                                                        $sql = "SELECT * FROM payheads WHERE allowance_type = 'taxes'";
                                                        $result1 = mysqli_query($conn,$sql);
                                                        if(mysqli_num_rows($result1)>0){
                                                            while($struc = mysqli_fetch_assoc($result1)){
                                                                $payhead_name = $struc['payhead_name'];
                                                                $amt = $struc['amount'];
                                                        ?>
                                                                                            
                                                        
                                                        	<tr>
    															<td><strong><?php echo $struc['payhead_name']?></strong></td>
    															<?php
    															if($payhead_name=='Income Tax'){
                                                                    if($emp['amount']>=0 && $emp['amount']<=5000){
                                                                        $total = ($emp['amount'] * 0)/100;
                                                                    }else if($emp['amount']>=5001 && $emp['amount']<=20000){
                                                                        $total = ($emp['amount'] * 1)/100;
                                                                    }else if($emp['amount']>=20001 && $emp['amount']<=35000){
                                                                        $total = ($emp['amount'] * 3)/100;
                                                                    }
    															?>
    															<td><span class="float-right">RM <?php echo $total?></span></td>
    															<?php
    															}else if($payhead_name=='Employee Provident Fund (EPF)'){
                                                                $total = (($emp['amount'] + $salary['earning_total'] - $salary['deduction_total']) * 11)/100;
                                                                $total = number_format($total,2);
                                                                ?><td><span class="float-right">RM <?php echo $total?></span></td>
                                                                <?php
    															}else if($payhead_name=='Social Security Organisation (SOCSO)'){
                                                                    $total = (($emp['amount'] + $salary['earning_total'] - $salary['deduction_total']) * 0.5)/100;
                                                                    $total = number_format($total,2);
                                                            
                                                            ?><td><span class="float-right">RM <?php echo $total?></span></td>
                                                            <?php
    															}
                                                            ?>
														    
														    <?php
                                                                    }
                                                                }
														?>
														</tr>
														<tr>
															<td><strong>Total Taxes</strong></td>
															<td><span class="float-right"><strong>RM <?php $total = $salary['tax_total'];
															$total = number_format($total,2);
															echo $total;
															?></strong></span></td>
														</tr>
												</table>
											</div>
									    </div>
										<div class="col-sm-12">
											<p><strong>Net Salary: RM <?php echo $salary['net_salary']?></strong> </p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>

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
 
    </br></br></br></br></br></br>
  </body>
</html>
                        