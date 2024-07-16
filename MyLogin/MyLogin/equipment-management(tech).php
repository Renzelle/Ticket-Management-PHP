<!DOCTYPE html>
<?php
	session_start();
?>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- Boxicons -->
   <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
   <!-- My CSS -->
   <link rel="stylesheet" href="try.css">
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
  	<title>Equipment Management-AU IT Ticket Management System</title>
  	<style>
    .box 
    {
        width: 100%;
        height: 30px;
        border: 1px solid #999;
        font-size: 18px;
        color: #000000;
        background-color: #eee;
        border-radius: 5px;
        box-shadow: 4px 4px #ccc;
    }
    </style>
</head>
<body>
   	<!-- SIDEBAR -->
   	<section id="sidebar">
   		<a href="index(tech)" class="brand">
		  	<i class='bx bxs-smile'></i>
		    <span class="text">ITC 127</span>
		</a>
		<div class="profile">
            <img src="prof.jpg">
            <h3>Renzelle Apolinario</h3>
            <p>Designer</p>
        </div>
		<ul class="side-menu top">
			<li class="active">
		    	<a href="index(tech).php">
		            <i class='bx bxs-dashboard' ></i>
		            <span class="text">Dashboard</span>
		        </a>
		    </li>
		    <li>
		        <a href="equipment-management(tech).php">
		            <i class='bx bxs-folder' ></i>
		            <span class="text">Equipment</span>
		        </a>
		    </li>
		    <li>
		        <a href="ticket-management(technical).php">
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
            	<a href="logout(ticket).php" class="logout">
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
               	<h1>Equipment</h1>
               	<ul class="breadcrumb">
                  	<li>
                    	<a href="equipment-management.php">Equipment</a>
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
			                        <h2>Equipment <b>Management</b></h2>
			                    </div>
			                    <div class="col-sm-7">
			                    	<a href="#addEquipmentModal" class="btn btn-success" title="Add" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Equipment</span></a>
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
						                    echo "<th>Asset Number</th>";
						                    echo "<th>Serial Number</th>";
						                    echo "<th>Type</th>";
						                    echo "<th>Department</th>";
						                    echo "<th>Status</th>";
						                    echo "<th>Created by</th>";
						                    echo "<th>Last updated by</th>";
						                    echo "<th>Action</th>";
						                echo "</tr>";    
						                echo "<br>";
						            while($row = mysqli_fetch_array($result))
						            {
						            	echo "<tr>";
						                    echo  "<td>".$row['AssetNumber']."</td>";
						                    echo  "<td>".$row['SerialNumber']."</td>";
						                    echo  "<td>".$row['Type']."<t/d>";
						                    echo  "<td>".$row['Department']."</td>";
						                    echo  "<td>".$row['Status']."</td>";
						                    echo  "<td>".$row['Createdby']."</td>";
						                    echo  "<td>".$row['Lastupdatedby']."</td>";
						                    echo "<td>";

							                    echo "<a href = 'activate-equipment.php?username=" . $row['AssetNumber'] . "' class='edit'style='color:green'><i class='material-icons' data-toggle='tooltip' title='Working'>account_circle</a></i>";

							                    echo "<a href = 'retire-equipment.php?username=" . $row['AssetNumber'] . "' class='edit'style='color:red'><i class='material-icons' data-toggle='tooltip' title='Retire'>block</a></i>";

							                    echo "<a href = 'repair-equipment.php?username=" . $row['AssetNumber'] . "'style='color:#B6AD9F'><i class='material-icons' data-toggle='tooltip' title='Repair'>build</a></i>";

							                    echo "<a href = 'update-equipment.php?username=" . $row['AssetNumber'] . "' class='edit'style='color:#DA9423'><i class='material-icons' data-toggle='tooltip' title='Update'>&#xE254;</a></i>";

							                    echo "<a href = 'delete-equipment.php?username=" . $row['AssetNumber'] . "' class='delete' ><i class='material-icons' data-toggle='tooltip' title='Delete'>&#xE872;</a></i>";
							                    
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
						        $sql = "SELECT * FROM tableequipments WHERE AssetNumber <> ? AND (AssetNumber LIKE ? OR SerialNumber LIKE ? OR Type LIKE ? OR Department LIKE ?) ORDER BY AssetNumber";
						        if($stmt = mysqli_prepare($link, $sql))
						        {
						            $searchValue = '%' . $_POST['txtSearch'] . '%';
						            mysqli_stmt_bind_param($stmt, "sssss", $_SESSION['username'], $searchValue, $searchValue, $searchValue, $searchValue);
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
						        $sql = "SELECT * FROM tableequipments WHERE AssetNumber <> ? ORDER BY AssetNumber";
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

					$sql = "SELECT * FROM tableequipments WHERE AssetNumber = ? OR SerialNumber = ?";
					if($stmt = mysqli_prepare($link, $sql))
					{
						mysqli_stmt_bind_param($stmt, "ss", $_POST['txtAssetNumber'], $_POST['txtSerialNumber']);
						if(mysqli_stmt_execute($stmt))
						{
							$result = mysqli_stmt_get_result($stmt);
							if(mysqli_num_rows($result) != 1)
							{
								$sql = "INSERT INTO tableequipments (AssetNumber, SerialNumber, Type, Manufacturer, YearModel, Description, Department, Status, Createdby) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
								if($stmt = mysqli_prepare($link, $sql))
								{
									$status = "WORKING";
									$numericYear = $_POST['txtYearModel'];
									mysqli_stmt_bind_param($stmt, "sssssssss", $_POST['txtAssetNumber'], $_POST['txtSerialNumber'], $_POST['cmbType'], $_POST['txtManufacturer'],$numericYear, $_POST['txtDescription'], $_POST['cmbDepartment'], $status, $_SESSION['username']);
									if(preg_match("/^[0-9]*$/",$numericYear))
									{
										$lengthYear = strlen($numericYear);
										if($lengthYear != 4)
										{
											echo "*Year must have 4 digits";	
										}
										else
										{
											if(mysqli_stmt_execute($stmt))
											{
												echo "Equipment Added!";
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
										echo "*Year should be numeric";
									}
								}
							}
							else
							{
								echo "AssetNumber/SerialNumber is already existing!";
							}
						}
						else
						{
							echo "Error on select statement";
						}
					}
				}
			?>
		<div id="addEquipmentModal" class="modal fade" data-keyboard="false" data-backdrop="static">
			<div class="modal-dialog">
				<div class="modal-content">
					<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method= "POST">
						<div class="modal-header">						
							<h4 class="modal-title">Add Equipment</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<div class="modal-body">					
							<div class="form-group">
								<label>Asset Number:"</label>
								<input type="text" name = "txtAssetNumber" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Serial Number</label>
								<input type="text" name = "txtSerialNumber" class="form-control" required>
							</div>
							<div class ="form-group">
								<label>Usetype</label>
								<select name = "cmbType" id = "cmbType" class="box" required>
				                    <option value = "">--Select type--</option>
									<option value = "Monitor">Monitor</option>
									<option value = "CPU">CPU</option>
									<option value = "Keyboard">Keyboard</option>
									<option value = "Mouse">Mouse</option>
									<option value = "AVR">AVR</option>
									<option value = "MAC">MAC</option>
									<option value = "Printer">Printer</option>
									<option value = "Projector">Projector</option>
				                </select>
							</div>
							<div class="form-group">
								<label>Manufacturer</label>
								<input type="text" name = "txtManufacturer" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Year Model</label>
								<input type="text" name = "txtYearModel" class="form-control" required>
							</div>	
							<div class="form-group">
								<label>Description</label>
								<textarea id="text" name="txtDescription" style="width: 100%" rows="4" cols="50" required>
								</textarea>
							</div>	
							<div class ="form-group">
								<label>Department</label>
								<select name = "cmbDepartment" id = "cmbDepartment" class="box" required>
									<option value = "">--Select Department--</option>
									<option value = "Education">Education</option>
									<option value = "Nursing">Nursing</option>
									<option value = "Busines">Business</option>
									<option value = "Liberal Arts, Social Sciences, and Humanities">Liberal Arts, Social Sciences, and Humanities</option>
									<option value = "Business, Technology & Management">Business, Technology & Management</option>
									<option value = "Business Administration">Business Administration</option>
									<option value = "Science and Mathematics">Science and Mathematics</option>
									<option value = ">Education, Industrial Arts, Skills Training and Continuing Education">Education, Industrial Arts, Skills Training and Continuing Education</option>
									<option value = "Hospitality & Tourism Mgt">Hospitality & Tourism Mgt</option>
									<option value = "Institute of Accountancy">Institute of Accountancy</option>
									<option value = "Radiologic Technology">Radiologic Technology</option>
									<option value = "Computer Science">Computer Science</option>
									<option value = "Medical Laboratory Science">Medical Laboratory Science</option>
									<option value = "Pharmacy">Pharmacy</option>
									<option value = "Physical Therapy">Physical Therapy</option>
									<option value = "Midwifery">Midwifery</option>
									<option value = "BS Psychology">BS Psychology</option>
									<option value = "Criminal Justice">Criminal Justice</option>
									<option value = "Law">Law</option>
								</select>
							</div>			
						</div>
						<div class="modal-footer">
							<input type="button" class="btn btn-default"data-bs-dismiss="modal" value="Cancel">
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