<?php
	include ("session-checker.php");
	require_once "config.php";
	if(isset($_POST['btnSubmit']))
	{ 
		$sql = "SELECT * FROM tabletickets WHERE TicketNumber = ? AND Status = ? ";
		if($stmt = mysqli_prepare($link, $sql))
		{
			$status1 = "CLOSED";
			mysqli_stmt_bind_param($stmt,"ss",$_GET['username'], $status1);
			if(mysqli_stmt_execute($stmt))
			{
				$result = mysqli_stmt_get_result($stmt);
				if(mysqli_num_rows($result) > 0)
				{
					$sql = "UPDATE tabletickets SET AssignedTo = ? WHERE TicketNumber = ?";
					if($stmt = mysqli_prepare($link, $sql))
					{
						mysqli_stmt_bind_param($stmt, "ss", $_POST['cmbProblem'], $_GET['username']);
						if(mysqli_stmt_execute($stmt))
						{
							if($stmt = mysqli_prepare($link, $sql))
							{
								echo "Ticket Assign";
								header("location:ticket-management(admin).php");
								exit();	
							}
							else
							{
								echo "Error on update statement";
							}
							
						}
						else
						{
							echo "Error on Assign statement";
						}	
					}
				}
				else
				{ //loading current value of account
					echo "<b style = 'color:red'>Status is not CLOSED</b>";
					if(isset($_GET['username']) && !empty(trim($_GET['username']))){
						$sql = "SELECT * FROM tabletickets WHERE TicketNumber = ?";
						if($stmt = mysqli_prepare($link, $sql)){
							mysqli_stmt_bind_param($stmt, "s", $_GET['username']);
							if(mysqli_stmt_execute($stmt)){
								$result = mysqli_stmt_get_result($stmt);
								$account = mysqli_fetch_array($result, MYSQLI_ASSOC);
							}
							else{
								echo "Error on select statement";
							}
						}
					}
				}
			}
		}
	}
	else{ //loading current value of account
		if(isset($_GET['username']) && !empty(trim($_GET['username']))){
			$sql = "SELECT * FROM tabletickets WHERE TicketNumber = ?";
			if($stmt = mysqli_prepare($link, $sql)){
				mysqli_stmt_bind_param($stmt, "s", $_GET['username']);
				if(mysqli_stmt_execute($stmt)){
					$result = mysqli_stmt_get_result($stmt);
					$account = mysqli_fetch_array($result, MYSQLI_ASSOC);
				}
				else{
					echo "Error on select statement";
				}
			}
		}
	}
?>
<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Popup Login Form Design | CodingNepal</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      <style>
	        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
	      	*{
			  	margin: 0;
			  	padding: 0;
			  	outline: none;
			  	box-sizing: border-box;
			  	font-family: 'Poppins', sans-serif;
			}
			body
			{
				height: 100vh;
				width: 100%;
				background: #F8F7F3;
			}	
	      	.container{
	         	position: absolute;
	         	top: 50%;
	         	left: 50%;
	         	transform: translate(-50%, -50%);
	      	}
	      	.container
	      	{
	         	background: #fff;
	         	width: 410px;
	         	padding: 30px;
	         	box-shadow: 0 0 8px rgba(0,0,0,0.1);
	      	}
	      	.container .text
	      	{
	         	font-size: 35px;
	         	font-weight: 600;
	         	text-align: center;
	      	}
	      	.container form
	     	{
	         	margin-top: -20px;
	      	}
	      	.container form .data{
	         	height: 45px;
	         	width: 100%;
	         	margin: 40px 0;
	      	}
	      	form .data label
	      	{
	         	font-size: 18px;
	      	}
	      	form .data input
	      	{
	         	height: 100%;
	         	width: 100%;
	         	padding-left: 10px;
	         	font-size: 17px;
	         	border: 1px solid silver;
	      	}
	      	form .data input:focus
	      	{
	         	border-color: #3498db;
	         	border-bottom-width: 2px;
	      	}
	      	form .btn
	      	{
	         	margin: 30px 0;
	         	height: 45px;
	         	width: 100%;
	         	position: relative;
	         	overflow: hidden;
	      	}
	      	form .btn .inner
	      	{
		        height: 100%;
		        width: 300%;
		        position: absolute;
		        left: -100%;
		        z-index: -1;
	         	transition: all 0.4s;
	      	}
	      	form .btn button
	      	{
	         	height: 100%;
	         	width: 100%;
	         	background: none;
	         	border: none;
	         	color: #fff;
	         	font-size: 18px;
	         	font-weight: 500;
	         	text-transform: uppercase;
	        	letter-spacing: 1px;
	        	cursor: pointer;
	      	}
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
    	<div class="center">
         	<div class="container">
            	<div class="text">
               		Update Tickets
            	</div>
	            <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
	               	<div class="data">
	                  	<label>Ticket Number:</label>
	                  	<input type = "text" value = "<?php echo $account['TicketNumber']; ?>" disabled>
	               	</div>
	               	<div class="data">
	                  	<label>Problem:</label>
	                  	<input type = "text" value = "<?php echo $account['Problem']; ?>" disabled>
	               	</div>
	               	<div class="data">
	               		<label>Detail:</label>
                        <input type="text" value = "<?php echo $account['Details']; ?>" disabled>
	               	</div>
	               	<div class="data">
	                 	<label>Select Account Assign to:</label>
	                  	<select name = "cmbProblem" id = "cmbProblem" class = "box" required>
                            <option value = "">--Select Account--</option>
                            <?php
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
                                    function build_table($result)
                                	{
                                		if(mysqli_num_rows($result) > 0)
                                    	{
                                    		while($row = mysqli_fetch_array($result))
                                        	{
                                        		?>
                                        		<option value = "<?php echo $row['username'] ?>"><?php echo $row['username'] ?></option>
                                        		<?php
                                        	}
                                    	}
                                	}
                            ?>
                        </select>
	               	</div>
	               	<br>
	               	<div class="btn">
			        	<div class="inner"></div>
				        <button type="submit" name="btnSubmit" value="Submit" style="background-color: green">Yes</button>
			        </div>
			        <div class="btn">
						<div class="inner"></div>
						<a href="ticket-management(admin).php">
							<button type="button" style="background-color: red">No</button>
						</a>
					</div>
	            </form>
        	</div>
      	</div>
  	</body>
</html>