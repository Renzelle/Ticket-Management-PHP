<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   	<meta charset="UTF-8">
   	<meta name="viewport" content="width=device-width, initial-scale=1.0">

   	<!-- Boxicons -->
   	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
   	<!-- My CSS -->
   	<link rel="stylesheet" href="index.css">
   	<link rel="stylesheet" href="main.css">
   	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="search.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<script>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();
	});
	</script>
   <title>Account Management-AU IT Ticket Management System</title>
</head>
<body>
   	<!-- SIDEBAR -->
   	<section id="sidebar">
   		<a href="index(admin)" class="brand">
		  	<i class='bx bxs-smile'></i>
		    <span class="text">ICT 127</span>
		</a>
		<div class="profile">
            <img src="prof.jpg">
            <h3>Renzelle Apolinario</h3>
            <p>Designer</p>
        </div>
		<ul class="side-menu top">
			<li class="active">
		    	<a href="index.php">
		            <i class='bx bxs-dashboard' ></i>
		            <span class="text">Dashboard</span>
		        </a>
		    </li>
		    <li>
		        <a href="account-management.php">
		            <i class='bx bxs-user' ></i>
		            <span class="text">Account</span>
		        </a>
		    </li>
		    <li>
		        <a href="equipment-management.php">
		            <i class='bx bxs-folder' ></i>
		            <span class="text">Equipment</span>
		        </a>
		    </li>
		    <li>
		        <a href="ticket-management(admin).php">
		            <i class='bx bxs-bar-chart-alt-2' ></i>
		            <span class="text">Ticket</span>
		        </a>
		    </li>
		</ul>
		<ul class="side-menu">
		    <li>
		        <a href="#">
		            <i class='bx bxs-cog' ></i>
		            <span class="text">Settings</span>
		        </a>
		    </li>
		    <li>
            	<a href="logout.php" class="logout">
               		<i class='bx bxs-log-out-circle' ></i>
               		<span class="text">Logout</span>
            	</a>
            </li>
        </ul>
    </section>
   	<!-- SIDEBAR -->
   	<!-- CONTENT -->
   	<section id="content">
   	    <!-- MAIN -->
    	<main>
        	<div class="head-title">
            	<div class="left">
               		<h1>Account</h1>
               		<ul class="breadcrumb">
                  		<li>
                     		<a href="account-management.php">Account</a>
                  		</li>
                  		<li><i class='bx bx-chevron-right' ></i></li>
                  		<li>
                     		<a class="active" href="Dashboard.php">Home</a>
                  		</li>
               		</ul>
            	</div>
         	</div>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
				<div class="container-xl">
				    <div class="table-responsive">
				        <div class="table-wrapper">
				            <div class="table-title">
				                <div class="row">
				                    <div class="col-sm-5">
				                        <h2>Account <b>Management</b></h2>
				                    </div>
				                    <div class="col-sm-7">
				                    	<a href="#addAccountModal" class="btn btn-success" title="Add" data-toggle="modal"><i class="material-icons" >&#xE147;</i> <span>Add New Account</span></a>
				              			<div class="search-container">
				                        	<input type="text" placeholder="Search.." name="txtSearch">
		      								<button type="submit" name="btnSearch"><i class="fa fa-search"></i></button>  
		      							</div> 		                        				
				                    </div>
				                </div>
				            </div>
				            <?php
							    function build_table($result)
							    {
							        if(mysqli_num_rows($result) > 0)
							        {
							            echo "<table class='table table-striped table-hover'>";

							                echo "<tr>";
							                    echo "<th>Username</th>";
							                    echo "<th>Usertype</th>";
							                    echo "<th>Status</th>";
							                    echo "<th>Created by</th>";
							                    echo "<th>Last updated by</th>";
							                    echo "<th>Action</th>";
							                echo "</tr>";    
							                echo "<br>";
							            while($row = mysqli_fetch_array($result))
							            {
							            	echo "<tr>";
							                    echo  "<td>".$row['username']."</td>";
							                    echo  "<td>".$row['usertype']."</td>";
							                    echo  "<td>".$row['status']."<t/d>";
							                    echo  "<td>".$row['createdby']."</td>";
							                    echo  "<td>".$row['lastUpdatedBy']."</td>";
							                    echo "<td>";

								                    echo "<a href = 'activate-account.php?username=" . $row['username'] . "' class='edit'style='color:green'><i class='material-icons' data-toggle='tooltip' title='Activate'>account_circle</a></i>";

								                    echo "<a href = 'deactive-account.php?username=" . $row['username'] . "' class='edit' style='color:red'><i class='material-icons' data-toggle='tooltip' title='Deactivate'>block</a></i>";

								                    echo "<a href = 'update-account.php?username=" . $row['username'] . "' class='edit'style='color:#DA9423'><i class='material-icons' data-toggle='tooltip' title='Update'>&#xE254;</a></i>";

								                    echo "<a href = 'delete-account.php?username=" . $row['username'] . "' class='delete' ><i class='material-icons' data-toggle='tooltip' title='Delete'>&#xE872;</a></i>";

							                    echo "</td>"; 
							                echo "</tr>";
							            }
							            echo "</table>";
							        }
							        else
							        {
							            echo "No data found";
							        }
							    }

							    require_once "config.php";

							    if(isset($_POST['btnSearch']))
							    {
							        $sql = "SELECT * FROM tableaccounts WHERE username <> ? AND (username LIKE ? OR usertype LIKE ?) ORDER BY username";
							        if($stmt = mysqli_prepare($link, $sql))
							        {
							            $searchValue = '%' . $_POST['txtSearch'] . '%';
							            mysqli_stmt_bind_param($stmt, "sss", $_SESSION['username'], $searchValue, $searchValue);
							            if(mysqli_stmt_execute($stmt))
							            {
							                $result = mysqli_stmt_get_result($stmt);
							                build_table($result);
							            }
							        }
							        else
							        {
							            echo "Error on search";
							        }
							    }
							    else
							    {
							        $sql = "SELECT * FROM tableaccounts WHERE username <> ? ORDER BY username";
							        if($stmt = mysqli_prepare($link, $sql))
							        {
							            mysqli_stmt_bind_param($stmt, "s", $_SESSION['username']);
							            if(mysqli_stmt_execute($stmt))
							            {
							                $result = mysqli_stmt_get_result($stmt);
							                build_table($result);   
							            }
							        }
							        else
							        {
							            echo "Error on accounts load";
							        }
							    }
							?>
				        </div>
				    </div>
				</div> 
			</form>   
			<?php
				require_once "config.php";
				if(isset($_POST['btnSubmit']))
				{

					$sql = "SELECT * FROM tableaccounts WHERE username = ?";
					if($stmt = mysqli_prepare($link, $sql))
					{
						mysqli_stmt_bind_param($stmt, "s", $_POST['txtUsername']);
						if(mysqli_stmt_execute($stmt))
						{
							$result = mysqli_stmt_get_result($stmt);
							if(mysqli_num_rows($result) != 1)
							{
								$sql = "INSERT INTO tableaccounts (username, password, usertype, status, createdby) VALUES(?, ?, ?, ?, ?)";
								if($stmt = mysqli_prepare($link, $sql))
								{
									$status = "ACTIVE";
									mysqli_stmt_bind_param($stmt, "sssss", $_POST['txtUsername'], $_POST['txtPassword'], $_POST['cmbUsertype'], $status, $_SESSION['username']);
									if(mysqli_stmt_execute($stmt))
									{
										echo "User Account Added!";
										exit();
									}
									else
									{
										echo "Error on insert statement";
									}
								}
							}
							else
							{
								echo "User account is already existing!";
							}
						}
						else
						{
							echo "Error on select statement";
						}
					}
				}
			?>
			<div id="addAccountModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method= "POST">
							<div class="modal-header">						
								<h4 class="modal-title">Add Account</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							</div>
							<div class="modal-body">					
								<div class="form-group">
									<label>Username</label>
									<input type="text" name = "txtUsername" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" name = "txtPassword" class="form-control" required>
								</div>
								<div class ="form-group">
									<label>Usetype</label>
									<select name = "cmbUsertype" id = "cmbBox" required>
					                    <option value = "">--Select User Type--</option>
					                    <option value = "ADMINISTRATOR">Administrator</option>
					                    <option value = "TECHNICAL">Technical</option>
					                    <option value = "USER">User</option>
					                </select>
								</div>					
							</div>
							<div class="modal-footer">
								<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
								<input type="submit" class="btn btn-success" name = "btnSubmit" value="Add">
							</div>
						</form>
					</div>
				</div>
			</div> 
    	</main>
    <!-- MAIN -->
   	</section>
   	<!-- CONTENT -->
</body>
</html>
<script src="script.js"></script>