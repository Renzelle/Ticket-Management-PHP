<?php
require_once "config.php";
include("session-checker.php");
if(isset($_POST['btnSubmit'])){
	$sql = "DELETE FROM tableaccounts WHERE username = ?";
	if($stmt = mysqli_prepare($link, $sql)){
		mysqli_stmt_bind_param($stmt, "s", trim($_POST['txtUsername']));
		if(mysqli_stmt_execute($stmt)){
			$sql = "INSERT INTO tabledeletelogs (datelog, timelog, ID, performedBy, module) VALUES (?, ?, ?, ?, ?)";
			if($stmt = mysqli_prepare($link, $sql)){
				$module = "Accounts";
				mysqli_stmt_bind_param($stmt, "sssss", date("m/d/Y"), date("h:i:sa"), $_POST['txtUsername'], $_SESSION['username'], $module);
				if(mysqli_stmt_execute($stmt)){
					echo "User account deleted!";
					header("location: account-management.php");
					exit();
				}
				else{
					echo "Error on insert logs";
				}
			}
		}
		else{
			echo "Error on delete statement";
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
        	<div class="text">Delete Account</div>
			<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> " method= "POST" role="login">
				<div class="data">
					<label>Are you sure you want to delete this account?</label>
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
			        <a href="account-management.php">
						<input type="button" name="No" value="No">
					</a>
		        </div>
			</form>
		</div>
	</div>
</body>
</html>