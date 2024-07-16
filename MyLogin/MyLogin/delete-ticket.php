<?php
	require_once "config.php";
	include("session-checker.php");
	if(isset($_POST['btnSubmit']))
	{
		$sql = "SELECT * FROM tabletickets WHERE TicketNumber = ? AND Status = ?";
		if($stmt = mysqli_prepare($link, $sql))
		{
			$Status = "CLOSED";
			mysqli_stmt_bind_param($stmt,"ss",$_POST['txtUsername'], $Status);
			if(mysqli_stmt_execute($stmt))
			{
				$result = mysqli_stmt_get_result($stmt);
				if(mysqli_num_rows($result) > 0)
				{
					$sql = "DELETE FROM tabletickets WHERE TicketNumber = ?";
					if($stmt = mysqli_prepare($link, $sql))
					{
						mysqli_stmt_bind_param($stmt, "s", trim($_POST['txtUsername']));
						if(mysqli_stmt_execute($stmt))
						{
							$sql = "INSERT INTO tabledeletelogsticket (datelog, timelog, ID, performedBy, module) VALUES (?, ?, ?, ?, ?)";
							if($stmt = mysqli_prepare($link, $sql))
							{
								$module = "Ticket";
								mysqli_stmt_bind_param($stmt, "sssss", date("Y/m/d"), date("h:i:sa"), $_POST['txtUsername'], $_SESSION['username'], $module);
								if(mysqli_stmt_execute($stmt))
								{
									echo "Ticket deleted!";
									header("location: ticket-management(admin).php");
									exit();
								}
								else
								{
									echo "Error on insert logs";
								}
							}
						}
						else
						{
							echo "Error on delete statement";
						}
					}
				}
				else
				{
					echo "<b style = 'color:red'>Status is not yet CLOSED</b>";
				}
			}
		}
	}
?>
<html>
	<head>
		<script src="https://kit.fontawesome.com/a076d05399.js"></script>
	    <link rel="stylesheet" href="Active.css">
	    <title>Delete Account-AU IT Ticket Management System</title>
	</head>
	<body>
		<div class="center">
	        <div class="container">
	        	<div class="text">Delete Ticket</div>
				<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> " method= "POST" role="login">
					<div class="data">
						<label>Are you sure you want to delete this ticket?</label>
						<input type="hidden" name="txtUsername" value ="<?php echo trim($_GET["username"]); ?>">
					</div>
					<div class="btn">
				        <div class="inner"></div>
						<button type="submit" name="btnSubmit" value="Submit">Yes</button>
			        </div>
				</form>
				<form>
					<div class="btn">
				        <div class="inner"></div>
				        <a href="ticket-management(admin).php">
							<input type="button" name="No" value="No">
						</a>
			        </div>
				</form>
			</div>
		</div>
	</body>
</html>