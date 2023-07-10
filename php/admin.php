<?php
    require('connection.php');

    if($_SESSION['is_admin_login']=="no"){
            header('location:admin_login.php');
             die();
    }

    // $res=mysqli_query($con,'select * from login');
    if(isset($_POST['submit'])){
        

        $t_id=mysqli_real_escape_string($con,$_POST['t_id']);
        $t_name=mysqli_real_escape_string($con,$_POST['t_name']);
        $source=mysqli_real_escape_string($con,$_POST['source']);
        $dest=mysqli_real_escape_string($con,$_POST['dest']);
        $no_of_seats=mysqli_real_escape_string($con,$_POST['no_of_seats']);
        
        $res=mysqli_query($con,"INSERT INTO `train` (`Train_id`, `Train_name`, `Source`, `Destination`, `No_of_seats`, `Seat_booked`) VALUES ('$t_id', '$t_name', '$source', '$dest', '$no_of_seats', '0');");

        if($res){
            echo "<script>alert('Train added')</script>";  
        }
        else{
            echo "<script>alert('Train id exists')</script>";
        }
        unset($_POST['submit']);
    }

    if(isset($_SESSION['deleted'])){
        if($_SESSION['deleted']==1){
            echo "<script>confirm('Deleted');</script>";
            unset($_SESSION['deleted']);
        }
    }

    // if(isset($_POST['delete_train'])){
    //     // echo $_POST['del_train'];
    //     $Train_id=(int)$_POST['del_train'];
    //     $res=mysqli_query($con,"delete from Train where Train_id=$Train_id;");

    //     if($res){
    //         echo "<script>alert('Train removed')</script>";
    //         unset($res);
    //     }
    //     else{
    //         echo "<script>alert('Train could not be removed')</script>";
    //     }
    //  }

  if(isset($_POST['add_staff'])){
      $name=mysqli_real_escape_string($con,$_POST['staff_name']);
      $phone=mysqli_real_escape_string($con,$_POST['phone']);
      $designation=mysqli_real_escape_string($con,$_POST['designation']);
      $staff_id=mysqli_real_escape_string($con,$_POST['staff_id']);
      

      $res=mysqli_query($con,"INSERT INTO `staff` (`Staff_id`, `Name`, `Designation`, `Phone_No`) VALUES ('$staff_id', '$name', '$designation', '$phone');");
        if($res){
            echo "<script>alert('Staff added!')</script>";
        }
        else{
            echo "<script>alert('Staff could not be added!')</script>";
        }
        unset($_POST['add_staff']);
  }

    if(isset($_POST['assign_staff'])){
        $train_id=mysqli_real_escape_string($con,$_POST['staff']);
        $staff_id=mysqli_real_escape_string($con,$_POST['train']);
       

        $res=mysqli_query($con,"INSERT INTO `train_staff` (`Train_id`, `Staff_id`) VALUES ('$staff_id', '$train_id');");
        if($res){
            echo "<script>alert('Staff assigned!')</script>";
        }
        else{
            echo "<script>alert('Staff could not be assigned!')</script>";
        }
        unset($_POST['assign_staff']);
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <script src="../js/admin.js"></script>
</head>
<!-- <body onload="auth()"> -->
<body>
        
     
    <!-- navbar -->
    <nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
        <div class="container-xxl">
            <a href="#" class="navbar-brand">
                <span class="fw-bold text-secondary">
                    <h2 class="fw-bold"><i class="bi bi-signpost"></i>  Railways</h2>
                </span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end align-center" id="main-nav">
                <ul class="navbar-nav my-2">

                <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Services
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#insert_train">Insert Train</a></li>
                            <li><a class="dropdown-item" href="#trains">Delete Train</a></li>
                            <li><a class="dropdown-item" href="#trains">View Trains </a></li>
                            <li><a class="dropdown-item" href="#passengers">View Passengers</a></li>
                            <li><a class="dropdown-item" href="#staffs">View Staffs</a></li>

                            <!-- <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"></a></li> -->
                        </ul>
                </li>

                <li class="nav-item">
                <a  href="admin_login.php" class="d-none d-md-block ms-2 btn btn-secondary btn-outlined-white text-white">Logout</a>
                </li>

                <li class="nav-item">
                <a  href="admin_login.php" class="d-md-none nav-link">Logout</a>
                </li>

            </ul>
      </div>
        </div>
    </nav>



    <section id="Insert_train">
        <div class="container-md align-items-center mt-5 bg-light p-3 justify-content-center">
        <div class="display-6 mt-4 text-muted">
            <h2>Insert Train</h2>
        </div>    
        <form method="POST">
                <label for="t_id" class="form-label">Train ID:</label>
                <input type="text" class="form-control" name="t_id" id="t_id" required placeholder="Enter train id:">

                <label for="t_name" class="form-label">Train Name:</label>
                <input id="t_name" type="text" name="t_name" class="form-control" required placeholder="Enter train name:">

                <label for="source" class="form-label">Source:</label>
                <input type="text" class="form-control" name="source" id="source" required placeholder="Enter source:">

                <label for="dest" class="form-label">Destination:</label>
                <input type="text" class="form-control" name="dest" id="dest" required placeholder="Enter destination:">

                <label for="no_of_seats" class="form-label">Number of Seats:</label>
                <input type="text" class="form-control" name="no_of_seats" id="no_of_seats" required placeholder="Enter number of seats:">
                
                <input type="submit" value="Submit" name="submit" class="btn my-2 btn-outline-primary">
            </form>
        </div>
    </section>

    <section id="bookings">
    <div class="container-md  align-items-center mt-5 p-3 justify-content-center">
        <div class="display-6 text-muted">
            <h2>Bookings</h2>
        </div>
        
        <table class="table">
            <tr>
                <th>B_id</th>
                <th>Seat_no</th>
                <th>Date</th>
                <th>Train_id</th>
                <th>P_id</th>
            </tr>

            <?php
            $res=mysqli_query($con,'select * from booking');
            $i=1;
                while($row=mysqli_fetch_assoc($res)){ ?>
                <tr>
                <!-- <td><?php echo $i?></td> -->
                    <td><?php echo $row['B_id']?></td>
                    <td><?php echo $row['Seat_No']?></td>
                    <td><?php echo $row['Date']?></td>
                    <td><?php echo $row['Train_id']?></td>
                    <td><?php echo $row['P_id']?></td>
                </tr>
                    <?php
                $i++; } ?>
        </table> 
    </div>
    </section>

    <section id="passengers">
    <div class="container-md bg-light align-items-center my-3  p-3 justify-content-center">
        <div class="display-6 text-muted">
            <h2>Passengers</h2>
        </div> 
      
        <table class="table">
            <tr>
                <th>P_Id</th>
                <th>Name</th>
                <th>Id_Proof</th>
                <th>Gender</th>
                <th>Age</th>
            </tr>

            <?php
            $res=mysqli_query($con,'select * from passenger');
            $i=1;
                while($row=mysqli_fetch_assoc($res)){ ?>
                <tr>
                <!-- <td><?php echo $i?></td> -->
                    <td><?php echo $row['P_id']?></td>
                    <td><?php echo $row['Name']?></td>
                    <td><?php echo $row['Id_Proof']?></td>
                    <td><?php echo $row['Gender']?></td>
                    <td><?php echo $row['Age']?></td>
                </tr>
                    <?php
                $i++; } ?>
        </table> 

    </div>
    </section>


    <section id="trains">
    <div class="container-md my-3 align-items-center  p-3 justify-content-center">
        <div class="display-6 text-muted">
            <h2>Trains</h2>
        </div> 
      
        <table class="table">
            <tr>
                <th>Train_id</th>
                <th>Name</th>
                <th>Source</th>
                <th>Destination</th>
                <th>Seats</th>
                <th></th>
                <th></th>
                
            </tr>

            <?php
            $res=mysqli_query($con,'select * from train');
            $i=1;
                while($row=mysqli_fetch_assoc($res)){ ?>
                <tr>
                <!-- <td><?php echo $i?></td> -->
                    <td><?php echo $row['Train_id']?></td>
                    <td><?php echo $row['Train_name']?></td>
                    <td><?php echo $row['Source']?></td>
                    <td><?php echo $row['Destination']?></td>
                    <td><?php echo $row['No_of_seats']?></td>
                    <td>
                        <a class="btn btn-outline-secondary mx-2"  href="edit.php?id=<?php
                        echo $row['Train_id']?>">Edit</a>&nbsp&nbsp
                        <a class="btn btn-outline-secondary mx-2"  href="delete.php?id=<?php 
                        echo $row['Train_id'] ?>">Delete</a>
                     </td>
                </tr>
                    <?php
                $i++; } ?>
        </table> 

    </div>
    </section>


    <!-- <section id="delete_train">
    <div class="container-md my-3 align-items-center bg-light   p-3 justify-content-center">
        <div class="display-6 text-muted">
            <h2>Delete trains</h2>
        </div> 
        <form method="POST">
            <label for="del_train" class="form-label">Select train to delete:</label> 
            <select name="del_train" id="del_train" class="form-select">
                <?php
                    $res=mysqli_query($con,'select * from train');
                    $i=1;
                        while($row=mysqli_fetch_assoc($res)){ ?>
                        <option value='100'><?php echo $row['Train_name']?></option>
                        <?php
                    $i++; } ?>
            </select>

            <input type="submit" value="Delete train" name="delete_train" class="btn btn-outline-primary my-2">
        </form>
    </div>
    </section> -->

    <section id="staffs">
        <div class="container-md my-3 p-3 justify-content-center align-items-center bg-light">
            <div class="display-6 text-muted">
                <h2>Staffs</h2>
            </div>
            
            <!-- add staff -->
            <div>
                <form method="POST">
                    
                    <label for="staff_id" class="form-label">Staff id</label>
                    <input type="number" id="staff_id" name="staff_id" class="form-control" required >
                    
                    <label for="staff_name" class="form-lable">Staff name</label>
                    <input type="text" id="staff_name" name="staff_name" class="form-control" required placeholder="Enter name of new staff">

                    <label for="designation" class="form-label">Staff designation</label>
                    <input type="text" id="designation" name="designation" class="form-control" required placeholder="Desination">

                    <label for="phone" class="form-label">Phone number</label>
                    <input type="number" id="phone" name="phone" class="form-control" required>

                    <input type="submit" value="Add staff" name="add_staff" class="btn mt-2 btn-outline-secondary">
                </form>
            </div>
            <!-- add staff -->

            <table class="table">
                <tr class="fw-bold">
                    <td>Staff_id</td>
                    <td>Name</td>
                    <td>Designation</td>
                    <td>Phone number</td>
                    <td></td>
                    <td></td>
                </tr>
                 <?php
                    $res=mysqli_query($con,"select * from staff");
                    $i=1;
                    while($row=mysqli_fetch_assoc($res)){        
                ?>
                    <tr>
                        <td><?php echo $row['Staff_id']?></td>
                        <td><?php echo $row['Name']?></td>
                        <td><?php echo $row['Designation']?></td>
                        <td><?php echo $row['Phone_No']?></td>
                        <td><a href="staff_edit.php?id=<?php echo $row['Staff_id']?>" class="btn  btn-outline-secondary">Edit</a></td>
                        <td><a href="staff_delete.php?id=<?php echo $row['Staff_id']?>" class="btn  btn-outline-secondary">Delete</a></td>
                    </tr>
                <?php
                    $i++;
                    }
                ?>
            </table>

            <!-- assign staff -->
            <div>
                <form method="POST" class="form">
                    
                <!-- staff     -->
                <label for="staff" label="form-label">Select Staff</label>
                    <select name="staff" id="staff" class="form-control">
                        <option disabled selected hidden>Select a staff </option>
                        
                        <?php
                            $res1=mysqli_query($con,"select Staff_id,Name from staff;");
                            $i=1;
                            while($row1=mysqli_fetch_assoc($res1)){
                        ?>
                        
                        <option value="<?php echo $row1['Staff_id']?>" ><?php echo $row1['Name']?></option>
                      <?php $i++; } ?>

                    </select>

                    <!-- train -->
                    <label for="train">Train name</label>
                    <select name="train" id="train" class="form-control">
                    <option disabled selected hidden>Select a train</option>
                    <?php
                            $res2=mysqli_query($con,"select  Train_name,Train_id from Train;");
                            $i=1;
                            while($row2=mysqli_fetch_assoc($res2)){
                      ?>
                        
                        <option value="<?php echo $row2['Train_id']?>" ><?php echo $row2['Train_name']?></option>
                      <?php $i++; } ?>
                    </select>

                    <input type="submit" value="Assign staff" name="assign_staff" class="btn mt-2 btn-outline-secondary">
                </form>
            </div>
        <!-- assin staff -->
        
    </div>

        
    </section>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>