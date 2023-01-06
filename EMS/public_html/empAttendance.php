<?php 

require 'conn.php';
session_start();
//echo $_SERVER['REMOTE_ADDR'];
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
    <?php 
         
        require 'empNav.php';
    ?>
    <!-- nav -->

    <!-- main content -->
    
    <div class="container">
        <div class="row">
            <?php 
         
                require 'empSidebar.php';
            ?>
            <div class="col-lg-9 col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Attendance</h4></div>
                    
                    </br>

                    <table class="table table-bordered">
                        <tr>
                            <th class="empNo">No.</th>
                            <th class="empName">Name</th>
                            <th class="empButton">Date</th>
                            <th class="empButton">Action</th>
                            <th class="empButton">Time</th>
                        </tr>
                        
                        <?php 
                        $name = $_SESSION['name'];
                        $emp_ID = $_SESSION['id'];

                        $attend = "SELECT * FROM punch WHERE emp_ID = '$emp_ID' ORDER BY date DESC";
                        $attendSQL = mysqli_query($conn, $attend);
                            $i=1;
                            $no = 0;
                        if (mysqli_num_rows($attendSQL) > 0) {
                            while($attendance = mysqli_fetch_assoc($attendSQL)) { 
                                $no = $no + $i;
                            ?>
                            
                        <tr>
                            <td class="empNo"><?php echo $no; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $attendance['date']; ?></td>
                                <?php
                                    if($attendance['action']=='punchin'){
                                        echo "<td>Check In</td>";
                                    }else if($attendance['action']=='punchout'){
                                        echo "<td>Check Out</td>";
                                    }
                                ?>
                            <td><?php echo $attendance['time']; ?></td>
                        </tr>

                        <?php }
                        } else {?>
                        <tr>
                            <td colspan="5">
                                    <?php echo "0 results"; ?> 
                            </td>
                            
                        </tr>
                            
                            
                        <?php    
                        }
                        
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- main content -->
    <?php 
        if( isset($_POST['punchin']) ){
            $employee_ID = $emp_ID;
            $date = date('Y-m-d');
            $time = date('H:i:s');
            $start_time = '08:30';
            $end_time = '18:00';
            
            
            //set up two DateTime objects
            $start = DateTime::createFromFormat('H-i', $start_time);
            $end = DateTime::createFromFormat('H-i', $end_time);
            if($_SERVER['REMOTE_ADDR']=='2001:e68:5406:125b:5c7e:63dd:839d:f30'){
            if($time<$start_time){
                $check = "SELECT * FROM punch WHERE emp_ID = '$employee_ID' AND date = '$date' ORDER BY punch_ID DESC LIMIT 1";
                $checkResult = mysqli_query($conn, $check);
                if (mysqli_num_rows($checkResult) > 0) {
                    while ($du = mysqli_fetch_assoc($checkResult)){
                        if($du['action']=='punchin'){
                            echo "<script>alert('You are already Check-In!');</script>";
                        }else{
                            $sql = "INSERT INTO punch (emp_ID, date, action, time, status) VALUES ( '$employee_ID','$date', 'punchin', '$time', 'On-Time')";
                            if (mysqli_query($conn, $sql)) {
                                echo "<script>alert('Check-In successful!');</script>";
                                echo "<meta http-equiv='refresh' content='0'>";
                            } else {
                                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                            }
                        }
                    }
                }else{
                $sql = "INSERT INTO punch (emp_ID, date, action, time) VALUES ( '$employee_ID','$date', 'punchin', '$time')";
                    if (mysqli_query($conn, $sql)) {
                        echo "<script>alert('Check-In successful!');</script>";
                        echo "<meta http-equiv='refresh' content='0'>";
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }
            }else if($time>$start_time && $time<$end_time){
                $sql = "INSERT INTO punch (emp_ID, date, action, time, status) VALUES ( '$employee_ID','$date', 'punchin', '$time', 'Late')";
                    if (mysqli_query($conn, $sql)) {
                        echo "<script>alert('You are late!');</script>";
                        echo "<meta http-equiv='refresh' content='0'>";
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
            }else{
                echo "<script>alert('Out of operation time!');</script>";
            }
        }else{
                    echo "<script>alert('Please Use the Company WiFi to Check-IN!');</script>";
                }
        }else if( isset($_POST['punchout']) ){
            $employee_ID = $emp_ID;
            $date = date('Y-m-d');
            $time = date('H:i:s');
            $chkTime = "SELECT * FROM employee WHERE emp_ID = '$employee_ID'";
            $chkTimeResult = mysqli_query($conn, $chkTime);
            while ($chk = mysqli_fetch_assoc($chkTimeResult)){
            $start_time = $chk['start'];
            $end_time = $chk['end'];
 
            //set up two DateTime objects
            $start = DateTime::createFromFormat('H-i', $start_time);
            $end = DateTime::createFromFormat('H-i', $end_time);
            if($_SERVER['REMOTE_ADDR']=='2001:e68:5406:125b:ce7:12ca:9905:a388'){
                $check = "SELECT * FROM punch WHERE emp_ID = '$employee_ID' AND date = '$date' ORDER BY punch_ID DESC LIMIT 1";
                $checkResult = mysqli_query($conn, $check);
                if (mysqli_num_rows($checkResult) > 0) {
                    while ($du = mysqli_fetch_assoc($checkResult)){
                        if($du['action']=='punchout'){
                            echo "<script>alert('You are already Check-Out!');</script>";
                        }else{
                            $sql = "INSERT INTO punch (emp_ID, date, action, time) VALUES ( '$employee_ID','$date', 'punchout', '$time')";
                            if (mysqli_query($conn, $sql)) {
                                echo "<script>alert('Check-Out successful!');</script>";
                                echo "<meta http-equiv='refresh' content='0'>";
                            } else {
                                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                            }
                        }
                    }
                }else{
                $sql = "INSERT INTO punch (emp_ID, date, action, time) VALUES ( '$employee_ID','$date', 'punchout', '$time')";
                    if (mysqli_query($conn, $sql)) {
                        echo "<script>alert('Check-Out successful!');</script>";
                        echo "<meta http-equiv='refresh' content='0'>";
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }
                
            }else{
                echo "<script>alert('Please Use the Company WiFi to Check-OUT!');</script>";
            }
        }
        }
?>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  </body>
</html>
