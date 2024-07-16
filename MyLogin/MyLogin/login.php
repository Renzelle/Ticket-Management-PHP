<?php
	if(isset($_POST['btnLogin']))
	{
		require_once "config.php";

		$sql = "SELECT * FROM tbluseraccount WHERE ID_Number = ? AND Password = ?";

		if($stmt = mysqli_prepare($link, $sql))
		{
			mysqli_stmt_bind_param($stmt, "ss", $_POST['txtUsername'], $_POST['txtPassword']);

			if(mysqli_stmt_execute($stmt))
			{
				$result = mysqli_stmt_get_result($stmt);
				if(mysqli_num_rows($result) > 0)
				{
					$account = mysqli_fetch_array($result, MYSQLI_ASSOC);

					session_start();
					$_SESSION['username'] = $_POST['txtUsername'];
					$_SESSION['usertype'] = $account['usertype'];

					header("location: index(admin).php");
				}
				else
				{
					echo "Incorrect Login credentials or account is inactive";
				}
			}
		}
		else
		{
			echo "Error on select statement";
		}
	}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
    	<meta charset="utf-8">
    	<link rel="stylesheet" href="style.css">
    	<title>Account Management Form</title>
  	</head>
  	<body>
		<div class="wrapper">
	    	<div class="title">Login Form</div>
	    	<form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
	    		<div class="field">
	          		<input type="text" name = "txtUsername" required>
	          		<label>Username</label>
	        	</div>
	        	<div class="field">
	          		<input type="password" name = "txtPassword" required>
	          		<label>Password</label>
	        	</div>
	        	<div class="content">
	          		<div class="checkbox">
	            		<input type="checkbox" id="remember-me">
	            		<label for="remember-me">Remember me</label>
	          		</div>
	          		<div class="pass-link"><a href="#">Forgot password?</a></div>
	        	</div>
	        	<div class="field">
	          		<input type="submit" name = "btnLogin" value="Login">
	        	</div>
	        	<div class="signup-link">Not a member? <a href="#">Signup now</a></div>
	      	</form>
	    </div>
	 </body>
</html>
