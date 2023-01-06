<?php 
include 'function.php';
date_default_timezone_set("Asia/Singapore");

if( !$_SESSION['name'] && !$_SESSION['id']){
    header( 'Location: index.php' );
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="main.css?v=<?php echo time();?>"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  
<style>

        p{
            margin-top: 15px;
   
        }

        
    </style>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="empDashboard.php">Employee Management System</a>
            </div>
        <ul class="nav navbar-nav navbar-right">
            <li class="nav-item dropdown dropdown-menu-start">
                <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"><?php
                $query = "SELECT * from `notification` where `status` = 'unread' AND `role` = 'admin' order by `date` DESC";
                if(count(fetchAll($query))>0){
                ?>
                <span class="badge badge-light"><?php echo count(fetchAll($query)); ?></span>
              <?php
                }
                    ?><i class='fas fa-bell'></i></a>
                <ul class="dropdown-menu">
                    <?php 
                    $query = "SELECT * from `notification` where `status` = 'unread' AND `role` = 'admin' order by `date` DESC";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        while($noti = mysqli_fetch_assoc($result)) { ?>
                            <a href="empViewNoti.php?id=<?php echo $noti['id'];?>&&app_ID=<?php echo $noti['app_ID'];?>" style="text-decoration:none; color:black;"><li><label style='color:blue'><?php echo $noti['name'];?></label>&nbsp<?php echo $noti['message'];?></li></a>
                            <li><hr class="dropdown-divider"></li>
                    <?php
                        }
                    }else{
                        echo "0 result";
                    }?>   
                    
                </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                  <i class='fas fa-user'> Welcome <small><?php echo $_SESSION['name']; ?></small></i>
              </a>
              <ul class="dropdown-menu" >
                  <?php
                  $name = $_SESSION['name'];
                  $id = $_SESSION['id'];
                    $emp = "SELECT * from `employee` where `name` = '$name' AND emp_ID = '$id'";
                    $result = mysqli_query($conn, $emp);
                    if (mysqli_num_rows($result) > 0) {
                        while($emp = mysqli_fetch_assoc($result)) {
                    ?>
                <li><a class="dropdown-item" href="empProfile.php?emp_ID=<?php echo $emp['emp_ID'];?>">My Profile</a></li>
                <?php }}?>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
              </ul>
            </li>
        </ul>
  </div>
</nav>
</br></br>
    </head>
    <body>
            
            

    </body>
    
    <script>
    $(document).ready(function(){
    // updating the view with notifications using ajax
    function load_unseen_notification(view = '')
    {
     $.ajax({
      url:"fetch.php",
      method:"POST",
      data:{view:view},
      dataType:"json",
      success:function(data)
      {
       $('.dropdown-menu').html(data.notification);
       if(data.unseen_notification > 0)
       {
        $('.count').html(data.unseen_notification);
       }
      }
     });
    }
    load_unseen_notification();
    // submit form and get new records
    $('#comment_form').on('submit', function(event){
     event.preventDefault();
     if($('#subject').val() != '' && $('#comment').val() != '')
     {
      var form_data = $(this).serialize();
      $.ajax({
       url:"insert.php",
       method:"POST",
       data:form_data,
       success:function(data)
       {
        $('#comment_form')[0].reset();
        load_unseen_notification();
       }
      });
     }
     else
     {
      alert("Both Fields are Required");
     }
    });
    // load new notifications
    $(document).on('click', '.dropdown-toggle', function(){
     $('.count').html('');
     load_unseen_notification('yes');
    });
    setInterval(function(){
     load_unseen_notification();;
    }, 5000);
    });
</script>
</html>