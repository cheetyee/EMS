<?php 

require 'conn.php'; 
$id = $_GET['emp_ID'];
$sql = "DELETE FROM employee WHERE emp_ID='$id'";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Record deleted successfully');</script>";
    header('Location: viewEmp.php');
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

?>
