<?php
   session_start();
   $_SESSION['username'] = "Renzelle";
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
                <a href="index(admin).php">
                    <i class='bx bxs-dashboard' ></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="account-management.php">
                    <i class='bx bxs-user' ></i>
                    <span class="text">Account</span>
                </a>
            </li>
            <li>
                <a href="equipment-management.php">
                    <i class='bx bxs-folder' ></i>
                    <span class="text">Equipment</span>
                </a>
            </li>
            <li>
                <a href="ticket-management(admin).php">
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
            <!-- APPROVE -->
            <?php
                require_once "config.php";
                if(isset($_POST['btnApproveYes']))
                {
                    $sql = "SELECT * FROM tabletickets WHERE TicketNumber = ? AND Status = ?";
                    if($stmt = mysqli_prepare($link, $sql))
                    {
                        $Status = "WAITING FOR APPROVAL";
                        mysqli_stmt_bind_param($stmt,"ss",$_POST['txtUsername'], $Status);
                        if(mysqli_stmt_execute($stmt))
                        {
                            $result = mysqli_stmt_get_result($stmt);
                            if(mysqli_num_rows($result) > 0)
                            {
                                $sql = "UPDATE tabletickets SET Status = 'CLOSED', dateClosed = ?, ApprovedBy = ? WHERE TicketNumber = ?";
                                if($stmt = mysqli_prepare($link, $sql))
                                {
                                    $Date = date('Y-m-d');
                                    mysqli_stmt_bind_param($stmt, "sss", $Date, $_SESSION['username'], $_POST['txtUsername']);
                                    if(mysqli_stmt_execute($stmt))
                                    {
                                        if($stmt = mysqli_prepare($link, $sql))
                                        {
                                            echo "<script>
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Success...',
                                                    text: 'Ticket Approved!',
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
                            }
                            else
                            {
                                echo "<script>
                                        Swal.fire({
                                        icon: 'error',
                                        title: 'Error...',
                                        text: 'Status is not yet WAITING FOR APPROVAL!',
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
            <form action="<?php $_SERVER["PHP_SELF"]; ?>" method = "POST">
                <div class="container-xl">
                    <div class="table-responsive">
                        <div class="table-wrapper">
                            <div class="table-title">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <h2>Ticket <b>Management</b></h2>
                                    </div>
                                    <div class="col-sm-7">
                                        <a href="#addTicketModal" class="btn btn-success" title="Add" data-toggle="modal"><i class="material-icons" >&#xE147;</i> <span>Add New Account</span></a>
                                        <div class="search-container">
                                            <input type="text" placeholder="Search.." name="txtSearch">
                                            <button type="submit" name="btnSearch"><i class="fa fa-search"></i></button>  
                                        </div>                                          
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
                                                echo "<th>Action</th>";
                                            echo "</tr>";    
                                            echo "<br>";
                                        while($row = mysqli_fetch_array($result))
                                        {
                                            $asset_num = $row['Accession'];
                                            echo "<tr>";
                                                ?>

                                                <td><span id="firstname<?php echo $row['asset_num']; ?>"><?php echo $row['Accession']; ?></span></td>
                                                <td><span id="secondname<?php echo $row['asset_num']; ?>"><?php echo $row['Title']; ?></span></td>
                                                <td><span id="thirdname<?php echo $row['asset_num']; ?>"><?php echo $row['Author']; ?></span></td>
                                                <td><span id="fourthname<?php echo $row['asset_num']; ?>"><?php echo $row['Department']; ?></span></td>
                                                <td><span id="fifthname<?php echo $row['asset_num']; ?>"><?php echo $row['Language']; ?></span></td>

                                                <?php

                                                echo "<td>";

                                                    echo "<a data-toggle='modal' class='delete' color: #ffffff; margin-left: 10px;' href='#Delete$asset_num'><i class='material-icons' data-toggle='tooltip' title='Delete' deletebtn>&#xE872;</i> </a>";

                                                    echo "<a data-toggle='modal' style = 'color:green' href='#Approve$asset_num'><i class='material-icons' data-toggle='tooltip' title='Approve' deletebtn>approval</i> </a>";

                                                    echo "<a href = 'assign-ticket.php?username=" . $row['TicketNumber'] . "'><i class='material-icons' data-toggle='tooltip' title='Assign' style = 'color:blue'>assignment</a></i>";

                                                    echo "<a href = 'update-ticket(assign).php?username=" . $row['TicketNumber'] . "'><i class='material-icons' data-toggle='tooltip' title='Update' style = 'color:orange'>airplay</a></i>";
                                                ?>

                                                    <button type="button" class="btn btn-success edit" value="<?php echo $row['TicketNumber']; ?>"><span class="glyphicon glyphicon-edit"></span>Details</button>

                                                <?php
                                                    

                                                echo "</td>"; 
                                                ?>
                                                <span style="visibility: hidden;" id ="sixthname<?php echo $row['TicketNumber']; ?>"><?php echo $row['CreatedBy']; ?></span>
                                                <span style="visibility: hidden;" id ="seventhname<?php echo $row['TicketNumber']; ?>"><?php echo $row['Details']; ?></span>
                                                <span style="visibility: hidden;" id ="eightname<?php echo $row['TicketNumber']; ?>"><?php echo $row['AssignedTo']; ?></span>
                                                <span style="visibility: hidden;" id ="ninthname<?php echo $row['TicketNumber']; ?>"><?php echo $row['ApprovedBy']; ?></span>
                                                <span style="visibility: hidden;" id ="tenthname<?php echo $row['TicketNumber']; ?>"><?php echo $row['dateAssigned']; ?></span>
                                                <span style="visibility: hidden;" id ="eleventhname<?php echo $row['TicketNumber']; ?>"><?php echo $row['dateCompleted']; ?></span>
                                                <span style="visibility: hidden;" id ="twelfthname<?php echo $row['TicketNumber']; ?>"><?php echo $row['dateClosed']; ?></span>

                                                <?php

                                            echo "</tr>";
                                            ?>
                                            <!--DELETE-->
                                            <div id="Delete<?php echo $asset_num;?>" class="modal fade">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "POST">
                                                            <div class="modal-header">                      
                                                                <h4 class="modal-title">Delete Ticket</h4>
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
                                            <!--APPROVE-->
                                            <div id="Approve<?php echo $asset_num;?>" class="modal fade">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "POST">
                                                            <div class="modal-header">                      
                                                                <h4 class="modal-title">Approve Ticket</h4>
                                                                <input type="hidden" name="txtUsername" value="<?php echo $asset_num; ?>">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            </div>
                                                            <div class="modal-body">                    
                                                                <p>Are you sure you want to Approve these Records?</p>
                                                                <p class="text-warning"><small>This action cannot be undone.</small></p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                                                <input type="submit" name="btnApproveYes" class="btn btn-success" value="Approve">
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
                                // SEARCH //
                                require_once "config.php";
                                    // TABLE DISPLAY FROM DATABASE //
                                    $sql = "SELECT * FROM tblbooksinformation WHERE Accession <> ? ORDER BY Accession";
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
            <!-- Php Add Ticket -->  
            <?php
                require_once "config.php";
                $Ticket = date('Ymdhis');
                date_default_timezone_set('Asia/Manila');
                if(isset($_POST['btnSubmit']))
                {
                    $sql = "SELECT * FROM tabletickets WHERE TicketNumber = ?";
                    if($stmt = mysqli_prepare($link, $sql))
                    {
                        mysqli_stmt_bind_param($stmt, "s", $Ticket);
                        if(mysqli_stmt_execute($stmt))
                        {
                            $result = mysqli_stmt_get_result($stmt);
                            if(mysqli_num_rows($result) != 1)
                            {
                                $sql = "INSERT INTO tabletickets (TicketNumber, Problem, Details, Status, Dates, Timing, CreatedBy) VALUES(?, ?, ?, ?, ?, ?, ?)";
                                if($stmt = mysqli_prepare($link, $sql))
                                {
                                    $Status = 'PENDING';
                                    $Date = date('Y-m-d');
                                    $Time = date('h:i:s');
                                    date_default_timezone_set('Asia/Manila');
                                    mysqli_stmt_bind_param($stmt, "sssssss", $Ticket, $_POST['cmbProblem'], $_POST['txtDetails'], $Status, $Date, $Time, $_SESSION['username']);
                                    if(mysqli_stmt_execute($stmt))
                                    {
                                        echo "<script>
                                                Swal.fire({
                                                icon: 'success',
                                                title: 'Success...',
                                                text: 'Ticket Added!',
                                                })
                                            </script>";
                                    }
                                    else
                                    {
                                        echo "<script>
                                                Swal.fire({
                                                icon: 'error',
                                                title: 'Error...',
                                                text: 'Error On Insert Statement!',
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
                                        text: 'Ticket Number is already existing!',
                                        })
                                    </script>";
                            }
                        }
                        else
                        {
                            echo "<script>
                                        Swal.fire({
                                        icon: 'error',
                                        title: 'Error...',
                                        text: 'Error On Select Statement!',
                                        })
                                    </script>";
                        }
                    }
                }
            ?>
            <!-- Modal Add Ticket -->  
            <div id="addTicketModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method= "POST">
                            <div class="modal-header">                
                                <h4 class="modal-title">Add Ticket</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">               
                                <div class="form-group">
                                    <label>Ticket Number</label>
                                    <input type = "text" value="<?php echo $Ticket; ?>" class="form-control" disabled>     
                                </div>
                                <div class ="form-group">
                                    <label>Problem</label>
                                    <select name = "cmbProblem" id = "cmbProblem" class = "box" required>
                                        <option value = "">--Select Problem--</option>
                                        <option value = "HARDWARE">Hardware</option>
                                        <option value = "SOFTWARE">Software</option>
                                        <option value = "CONNECTION">Connection</option>
                                    </select>
                                </div>   
                                <div class="form-group">
                                    <label>Detail Problem</label>
                                    <textarea id="text" name="txtDetails" style="width: 100%" rows="4" cols="50" required>
                                    </textarea>
                                </div>            
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="submit" class="btn btn-success" name = "btnSubmit" value="Add">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal Details Ticket -->
            <div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">                      
                                <h4 class="modal-title">Ticket Details</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">                    
                                <div class="form-group">
                                    <label>Ticket Number</label>
                                    <input type="text" class="form-control" id="efirstname" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Problem</label>
                                    <input type="text" class="form-control" id="esecondname" disabled>
                                </div>               
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="text" class="form-control" id="ethirdname" disabled>
                                </div>  
                                <div class="form-group">
                                    <label>Time</label>
                                    <input type="text" class="form-control" id="efourthname" disabled>
                                </div>                                  
                                <div class="form-group">
                                    <label>Status</label>
                                    <input type="text" class="form-control" id="efifthname" disabled>
                                </div>  
                                <div class="form-group">
                                    <label>Created By</label>
                                    <input type="text" class="form-control" id="esixthname" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Details</label>
                                    <textarea class="form-control" id="eseventhname" disabled></textarea>
                                </div> 
                                <div class="form-group">
                                    <label>Assigned To</label>
                                    <input type="text" class="form-control" id="eeightname" disabled>
                                </div>  
                                <div class="form-group">
                                    <label>Approved By</label>
                                    <input type="text" class="form-control" id="eninthname" disabled>
                                </div>   
                                <div class="form-group">
                                    <label>Date Assigned</label>
                                    <input type="text" class="form-control" id="etenthname" disabled>
                                </div>   
                                <div class="form-group">
                                    <label>Date Completed</label>
                                    <input type="text" class="form-control" id="eeleventhname" disabled>
                                </div>   
                                <div class="form-group">
                                    <label>Date Closed</label>
                                    <input type="text" class="form-control" id="etwelfthname" disabled>
                                </div>              
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="submit" class="btn btn-info" data-dismiss="modal" value="Okay">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
</body>
</html>
<script>

    $(document).ready(function()
    {

        $(document).on('click', '.edit', function(){
        var id=$(this).val();
        var first=$('#firstname'+id).text();
        var second=$('#secondname'+id).text();
        var third=$('#thirdname'+id).text();
        var fourth=$('#fourthname'+id).text();
        var fifth=$('#fifthname'+id).text();
        var sixth=$('#sixthname'+id).text();     
        var seventh=$('#seventhname'+id).text();
        var eigth=$('#eightname'+id).text();
        var ninth=$('#ninthname'+id).text();
        var tenth=$('#tenthname'+id).text();
        var eleventh=$('#eleventhname'+id).text();
        var twelfth=$('#twelfthname'+id).text();
 
        $('#edit').modal('show');
        $('#efirstname').val(first);
        $('#esecondname').val(second);
        $('#ethirdname').val(third);
        $('#efourthname').val(fourth);
        $('#efifthname').val(fifth);
        $('#esixthname').val(sixth);
        $('#eseventhname').val(seventh);
        $('#eeightname').val(eigth);
        $('#eninthname').val(ninth);
        $('#etenthname').val(tenth);
        $('#eeleventhname').val(eleventh);
        $('#etwelfthname').val(twelfth);

        });

    });

</script>