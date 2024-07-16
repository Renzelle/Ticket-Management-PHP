<!DOCTYPE html>
<html lang="en">
<head>
   	<meta charset="UTF-8">
  	 <meta name="viewport" content="width=device-width, initial-scale=1.0">

  	 <!-- Boxicons -->
  	 <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  	 <!-- My CSS -->
   	<link rel="stylesheet" href="index.css">
   	<link rel="stylesheet" href="footer.css">
	
  	<title>Home</title>
	<style>
		img {
			max-width: 100%;
			height: auto;
			border-radius: 50%;
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
		    	<a href="index.php">
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
	               	<h1>Dashboard</h1>
	               	<ul class="breadcrumb">
	                  	<li>
	                    	<a href="Dashboard.php">Dashboard</a>
	                  	</li>
	                  	<li><i class='bx bx-chevron-right' ></i></li>
	                  	<li>
	                    	<a class="active" href="Dashboard.php">Home</a>
	                  	</li>
	               	</ul>
	            </div>
	        </div> 
	        <?php
		        	session_start();

			        if(isset($_SESSION['username']))
			        {	
			        	echo "<center>";
				            echo "<h1 style = 'font-size:100px;'>Welcome, " . $_SESSION['username'] . "</h1>";
				            echo "<h4 style = 'font-size:50px;'>Usertype:" . $_SESSION['usertype'] . "</h4>";
			            echo "</center>";
			        }
			        else
			        {

			            header("location: login.php");
			        }
			    ?>  
		</main>
    <!-- MAIN -->
   	</section>
   	<!-- CONTENT -->
   	<div class="footer-basic">
        <footer>
            <div class="social"><a href="#"><i class="icon ion-social-instagram"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-facebook"></i></a></div>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Home</a></li>
                <li class="list-inline-item"><a href="#">Services</a></li>
                <li class="list-inline-item"><a href="#">About</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
            </ul>
            <p class="copyright">© 2022 APOLINARIO</p>
        </footer>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<script src="script.js"></script>