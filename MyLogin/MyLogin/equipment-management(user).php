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
		    	<a href="index(user).php">
		            <i class='bx bxs-dashboard' ></i>
		            <span class="text">Dashboard</span>
		        </a>
		    </li>
		    <li>
		        <a href="equipment-management(user).php">
		            <i class='bx bxs-folder' ></i>
		            <span class="text">Equipment</span>
		        </a>
		    </li>
		    <li>
		        <a href="ticket-management.php">
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
						?>
			        </div>
			    </div>
			</div> 
		</form>  
	</main>
    <!-- MAIN -->
   	</section>
   	<!-- CONTENT -->
</body>
</html>
<script src="script.js"></script>