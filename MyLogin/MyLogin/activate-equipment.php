<?php
	require_once "config.php";
	include("session-checker.php");
	if(isset($_POST['btnSubmit']))
	{
		$sql = "UPDATE tableequipments SET status = 'WORKING', lastUpdatedBy = ? WHERE AssetNumber = ? ";
		if($stmt = mysqli_prepare($link, $sql))
		{
			mysqli_stmt_bind_param($stmt, "ss", $_SESSION['username'], trim($_POST['username']));
			if(mysqli_stmt_execute($stmt))
			{
				header("location: equipment-management.php");
				echo "Equipment Working !";
				exit();
			}
			else
			{
				echo "Error on Update statement";
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=1,initial-scale=1,user-scalable=1" />
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="Active.css">
		<title>Working Equipment</title> 
</head>
<body>
	<div class="center">
        <div class="container">
        	<div class="text">Working Equipment</div>
			<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> " method= "POST" role="login">
				<div class="data">
					<label>Are you sure you want to Work this Retire?</label>
					<input type="hidden" name="username" value ="<?php echo trim($_GET["username"]); ?>">
				</div>
				<div class="btn">
			        <div class="inner"></div>
					<button type="submit" name="btnSubmit" value="Submit">Yes</button>
		        </div>
			</form>
			<form>
				<div class="btn">
			        <div class="inner"></div>
			        <a href="equipment-management.php">
						<input type="button" name="No" value="No">
					</a>
		        </div>
			</form>
		</div>
	</div>
</body>
</html>