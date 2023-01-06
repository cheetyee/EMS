        <div class="col-lg-3 col-md-3">
                <div class="panel panel-default">
                    <ul class="list-group">
                        <li class="list-group-item"><a href="dashboard.php" class="dropdown-btn"><i class='fas fa-home'></i> Dashboard
                            </a></li>
                        <li class="list-group-item">
						<a href="#" class="dropdown-btn"><i class='fas fa-coins'></i> Payroll <span class="fa fa-caret-down"></span></a>
						    <div class="dropdown-container">
							    <ul class="list-group">
							        <li class="list-group-item"><a href="history.php" class="dropdown-container-btn"> Employee Salary </a></li>
							        <li class="list-group-item"><a href="salary.php" class="dropdown-container-btn">Calculate Salary</a></li>
							        <li class="list-group-item"><a href="payheadType.php" class="dropdown-container-btn">Payhead Type</a></li>
							        
							        
							    </ul>
                            </div>
					    </li>
                        <li class="list-group-item">
						<a href="#" class="dropdown-btn"><i class='fas fa-user-friends'></i> Employee <span class="fa fa-caret-down"></span></a>
						    <div class="dropdown-container">
								<ul class="list-group">
									<li class="list-group-item"><a href="viewEmp.php" class="dropdown-container-btn">Employee List</a></li>
									<li class="list-group-item"><a href="holiday.php" class="dropdown-container-btn">Holidays</a></li>
									<li class="list-group-item"><a href="department.php" class="dropdown-container-btn">Departments</a></li>
									<li class="list-group-item"><a href="designation.php" class="dropdown-container-btn">Designations</a></li>
									<li class="list-group-item"><a href="position.php" class="dropdown-container-btn">Position</a></li>
									
								</ul>
							</div>
					    </li>
                        <li class="list-group-item"><a href="attendance.php" class="dropdown-btn"><i class='fas fa-user-clock'></i> Attendance</a></li>
                        <li class="list-group-item">
						<a href="#" class="dropdown-btn"><i class='fas fa-user-friends'></i> Application <span class="fa fa-caret-down"></span></a>
						    <div class="dropdown-container">
								<ul class="list-group">
									<li class="list-group-item"><a href="application.php" class="dropdown-container-btn">Leaves</a></li>
									<li class="list-group-item"><a href="allowance.php" class="dropdown-container-btn">Allowance</a></li>
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