<div class="col-lg-3 col-md-3">
                <div class="panel panel-default">
                    <ul class="list-group">
                        <li class="list-group-item"><a href="empDashboard.php" class="dropdown-btn"><i class='fas fa-home'></i> Dashboard </a></li>
                        <li class="list-group-item"><a href="empPayroll.php" class="dropdown-btn"><i class='fas fa-coins'></i> Payroll </a></li>
                        <li class="list-group-item"><a href="empAttendance.php" class="dropdown-btn"><i class='fas fa-user-clock'></i> Attendance</a></li>
                        <li class="list-group-item">
						<a href="#" class="dropdown-btn"><i class='fas fa-user-friends'></i> Application <span class="fa fa-caret-down"></span></a>
						    <div class="dropdown-container">
								<ul class="list-group">
									<li class="list-group-item"><a href="empApplication.php" class="dropdown-container-btn">Leaves</a></li>
									<li class="list-group-item"><a href="empAllowance.php" class="dropdown-container-btn">Allowance</a></li>
								</ul>
							</div>
					    </li>
                    </ul>
                </div>
            </div>
            <script>

    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;
    
    for (i = 0; i < dropdown.length; i++) {
      dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
        } else {
          dropdownContent.style.display = "block";
        }
      });
    }
    </script> 