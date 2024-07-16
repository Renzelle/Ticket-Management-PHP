<?php
include ("session-checker.php");
require_once "config.php";
if(isset($_POST['btnSubmit'])){ //update
	$sql = "UPDATE tableaccounts SET password = ?, usertype = ?, lastUpdatedBy = ? WHERE username = ?";
	if($stmt = mysqli_prepare($link, $sql)){
		mysqli_stmt_bind_param($stmt, "ssss", $_POST['txtpassword'], $_POST['cmbusertype'], $_SESSION['username'], 
			$_GET['username']);
		if(mysqli_stmt_execute($stmt)){
			echo "User account updated!";
			header("location:account-management.php");
			exit();
		}
		else{
			echo "Error on update statement";
		}
	}
}
else{ //loading current value of account
	if(isset($_GET['username']) && !empty(trim($_GET['username']))){
		$sql = "SELECT * FROM tableaccounts WHERE username = ?";
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
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=1,initial-scale=1,user-scalable=1" />
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="Active.css">
    <title>Update Account Form</title>
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
	<div class="center">
        <div class="container">
        	<div class="text">Update Account</div>
			<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
				<div class="data">
					<label>Username: <?php echo $account['username']; ?></label>
				</div>
				<div class="data">
					<label>Password:<input type = "text" name = "txtpassword" value = "<?php echo $account['password']; ?>" required></label>			
				</div>
				<div class="data">
		        	<label>Current Usertype: <?php echo $account['usertype']; ?></label>
		        </div>
				<div class="data">
					<label>Change to:</label>
					<select name = "cmbusertype" id = "cmbusertype" class="box" required>
						<option value = "">--Select User type--</option>
						<option value = "ADMINISTRATOR">Administrator</option>
						<option value = "TECHNICAL">Technical</option>
						<option value = "USER">User</option>
					</select>
				</div>
		        <div class="btn">
		        	<div class="inner"></div>
			        <button type="submit" name="btnSubmit" value="Submit">Yes</button>
		        </div>
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