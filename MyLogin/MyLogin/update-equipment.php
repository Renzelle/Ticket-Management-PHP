<?php
	include ("session-checker.php");
	require_once "config.php";
	if(isset($_POST['btnSubmit']))
	{ //update
		$sql = "UPDATE tableequipments SET SerialNumber = ?, Type = ?,  Manufacturer = ?, YearModel = ?, Description = ?, Department = ?, Status = ?, Lastupdatedby = ? WHERE AssetNumber = ?";
		if($stmt = mysqli_prepare($link, $sql))
		{
			$numericYear = $_POST['txtYear'];
			mysqli_stmt_bind_param($stmt, "sssssssss", $_POST['txtSerialnumber'], $_POST['cmbUsertype'], $_POST['txtManufacturer'], $numericYear, $_POST['txtDescription'], $_POST['cmbDepartment'], $_POST['cmbStatus'],$_SESSION['username'], $_GET['username']);
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
						echo "equipment updated!";
						header("location:equipment-management.php");
						exit();
					}
					else
					{
						echo "Error on update statement";
					}
				}
			}
			else
			{
				echo "*Year should be numeric";
			}		
		}
	}
	else{ //loading current value of account
		if(isset($_GET['username']) && !empty(trim($_GET['username']))){
			$sql = "SELECT * FROM tableequipments WHERE AssetNumber = ?";
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
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <!---<title> Responsive Registration Form | CodingLab </title>--->
    <link rel="stylesheet" href="eme.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  	<div class="container">
    	<div class="title">Update Equipment</div>
    	<div class="content">
      		<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
        		<div class="user-details">
          			<div class="input-box">
            			<span class="details">Asset Number</span>
            			<input type="text" disabled placeholder="<?php echo $account['AssetNumber']; ?>">
          			</div>
		        	<div class="input-box">
		            	<span class="details">Serial Number</span>
		            	<input type = "text" name = "txtSerialnumber" value = "<?php echo $account['SerialNumber']; ?>" required>
		        	</div>
          			<div class="input-box">
			            <span class="details">Current Type:</span>
			            <input type="text" disabled placeholder="<?php echo $account['Type']; ?>">
			            <span class="details">Change to: </span>
			            <select name = "cmbUsertype" id = "cmbUsertype" class="box" required>
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
		          	<div class="input-box">
			            <span class="details">Manufacturer: </span>
			            <input type = "text" name = "txtManufacturer" value = "<?php echo $account['Manufacturer']; ?>" required>
		          	</div>
          			<div class="input-box">
			            <span class="details">Year: </span>
			            <input type = "text" name = "txtYear" value = "<?php echo $account['YearModel']; ?>" required>
          			</div>
		        	<div class="input-box">
			            <span class="details">Description: </span>
			            <textarea id="text" name="txtDescription" style="width: 100%" rows="4" cols="50" required>
						</textarea>
			        </div>
			        <div class="input-box">
			            <span class="details">Current Department:</span>
			            <input type="text" disabled placeholder="<?php echo $account['Department']; ?>">
			            <span class="details">Change to:</span>
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
			        <div class="input-box">
			            <span class="details">Current Status:</span>
			            <input type="text" disabled placeholder="<?php echo $account['Status']; ?>">
			            <span class="details">Change to:</span>
			            <select name = "cmbStatus" id = "cmbStatus" class="box" required>
							<option value = "">--Select Status--</option>
							<option value = "WORKING">WORKING</option>
							<option value = "REPAIR">REPAIR</option>
							<option value = "RETIRE">RETIRE</option>
						</select>
			        </div>
	        		<div class="btn">
			          	<div class="inner"></div>
			          	<button type="submit" name="btnSubmit" value="Submit">Yes</button>
	        		</div>
			        <div class="btn">
						<div class="inner"></div>
						<a href="equipment-management.php">
							<input type="button" name="No" value="No">
						</a>
					</div>
				</div>
      		</form>
  		</div>
	</div>
</body>
</html>
