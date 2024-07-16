<?php
   session_start();
?>
<!DOCTYPE html>
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
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   <script>
   $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
   });
   </script>
   <title>Account Management-AU IT Ticket Management System</title>
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
        <a href="index.php" class="brand">
        <i class='bx bxs-smile'></i>
            <span class="text">ICT 127</span>
        </a>
        <div class="profile">
            <img src="prof.jpg">
            <h3>Renzelle Apolinario</h3>
            <p>Admin</p>
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
            <!-- DELETE -->
            <?php
                require_once"config.php";
                if (isset($_POST['btnDeleteYes']))                    
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
                                    $asset_num = trim($_POST['txtUsername']);
                                    mysqli_stmt_bind_param($stmt, "s", $asset_num);
                                    if(mysqli_stmt_execute($stmt))
                                    {
                                        $sql = "INSERT INTO tabledeletelogsticket (datelog, timelog, ID, performedBy, module) VALUES (?, ?, ?, ?, ?)";
                                        if($stmt = mysqli_prepare($link, $sql))
                                        {
                                            $module = "Ticket";
                                            $date = date("Y/m/d");
                                            $time = date("h:i:sa");
                                            mysqli_stmt_bind_param($stmt, "sssss", $date, $time, $_POST['txtUsername'], $_SESSION['username'], $module);
                                            if (mysqli_stmt_execute($stmt)) 
                                            {
                                                
                                                echo "<script>
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Success...',
                                                    text: 'Ticket Deleted!',
                                                })
                                                </script>";
                                            }
                                            else 
                                            {
                                                echo "<script>
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Error...',
                                                    text: 'Error on insert statement!',
                                                })
                                                </script>";
                                            }
                                        }
                                    }
                                    else
                                    {
                                        echo "<script>
                                            Swal.fire({
                                            icon: 'error',
                                            title: 'Error...',
                                            text: 'Error On Delete Statement!',
                                            })
                                        </script>";
                                    }
                                }
                            }
                            else
                            {
                                echo "<script>
                                        Swal.fire({
                                        icon: 'error',
                                        title: 'Error...',
                                        text: 'Status is not yet CLOSED!',
                                        })
                                    </script>";
                            }
                        }
                    }
                }
            ?>
            <div class="head-title">
                <div class="left">
                    <h1>Account</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="account-management.php">Account</a>
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
                                        <h2>Ticket <b>Management</b></h2>
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
                                                echo "<th>Ticket Number</th>";
                                                echo "<th>Problem</th>";
                                                echo "<th>Date</th>";
                                                echo "<th>Time</th>";
                                                echo "<th>Status</th>";
                                                echo "<th>Created by</th>";
                                                echo "<th>Action</th>";
                                            echo "</tr>";    
                                            echo "<br>";
                                        while($row = mysqli_fetch_array($result))
                                        {
                                            $asset_num = $row['TicketNumber'];
                                            echo "<tr>";
                                                ?>
                                                
                                                <td><span id="firstname<?php echo $row['TicketNumber']; ?>"><?php echo $row['TicketNumber']; ?></span></td>
                                                <td><span id="secondname<?php echo $row['TicketNumber']; ?>"><?php echo $row['Problem']; ?></span></td>
                                                <td><span id="thirdname<?php echo $row['TicketNumber']; ?>"><?php echo $row['Dates']; ?></span></td>
                                                <td><span id="fourthname<?php echo $row['TicketNumber']; ?>"><?php echo $row['Timing']; ?></span></td>
                                                <td><span id="fifthname<?php echo $row['TicketNumber']; ?>"><?php echo $row['Status']; ?></span></td>
                                                <td><span id="sixthname<?php echo $row['TicketNumber']; ?>"><?php echo $row['CreatedBy']; ?></span></td>
                                                <?php
                                                    echo "<td>";
                                                        echo "<a data-toggle='modal' class='delete' color: #ffffff; margin-left: 10px;' href='#Delete$asset_num'><i class='material-icons' data-toggle='tooltip' title='Delete' deletebtn>&#xE872;</i> </a>";
                                                    echo "</td>";
                                                ?>
                                                <?php

                                            echo "</tr>";
                                            ?>
                                            <!--DELETE-->
                                            <div id="Delete<?php echo $asset_num;?>" class="modal fade">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "POST">
                                                            <div class="modal-header">                      
                                                                <h4 class="modal-title">Delete Employee</h4>
                                                                <input type="hidden" name="txtUsername" value="<?php echo $asset_num; ?>">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            </div>
                                                            <div class="modal-body">                    
                                                                <p>Are you sure you want to delete these Records?</p>
                                                                <p class="text-warning"><small>This action cannot be undone.</small></p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                                                <input type="submit" name="btnDeleteYes" class="btn btn-danger" value="Delete">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        echo "</table>";
                                    }
                                    else
                                    {
                                        echo "No data found";
                                    }
                                }
                                // TABLE DISPLAY FROM PHPMYADMIN //
                                require_once "config.php";
                                    $sql = "SELECT * FROM tabletickets WHERE TicketNumber <> ? AND AssignedTo = 'renzelle' ORDER BY TicketNumber";
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