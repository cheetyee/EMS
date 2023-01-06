<!DOCTYPE html>
<html>
<head>
 <title>Notification using PHP Ajax Bootstrap</title>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body>
 <br /><br />
 <div class="container bg-dark">
  <nav class="navbar navbar-inverse">
   <div class="container-fluid">
    <div class="navbar-header">
     <a class="navbar-brand" href="#">PHP Notification Tutorial</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
     <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <i class="fas fa-bell" style="font-size:18px;"></i></a>
      <ul class="dropdown-menu"></ul>
     </li>
    </ul>
   </div>
  </nav>
  <br />
  <form method="post" id="comment_form">
   <div class="form-group">
    <label>Enter Subject</label>
    <input type="text" name="subject" id="subject" class="form-control">
   </div>
   <div class="form-group">
    <label>Enter Comment</label>
    <textarea name="comment" id="comment" class="form-control" rows="5"></textarea>
   </div>
   <div class="form-group">
    <input type="submit" name="post" id="post" class="btn btn-info" value="Post" />
   </div>
  </form>
 </div>
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