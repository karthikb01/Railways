<?php
    require('connection.php');
    
    if($_SESSION['IS_LOGIN']=='no'){
        header('location:../index.php');
        die();
    }
    
    $id=mysqli_real_escape_string($con,$_GET['id']);


    $res=mysqli_query($con,"select * from passenger where P_id='$id'");
    // $res=mysqli_query($con,'CALL passengerDetails($id);');
    $row=mysqli_fetch_object($res);  

    // $Name=$row['Name'];
    $Name=$row->Name;
    // $Id_proof=$row['Id_Proof'];
    $Id_proof=$row->Id_Proof;
    // $Gender=$row['Gender'];
    $Gender=$row->Gender;
    // $Age=$row['Age'];
    $Age=$row->Age;
    
    // require('connection.php');  

    if(isset($_POST['edit'])){
      
      $name=$_POST['name'];
      $gender=$_POST['gender'];
      $id_proof=$_POST['id_proof'];
      $age=$_POST['age'];
      // $seat_booked=$_POST['Seat_booked'];

  

      $res=mysqli_query($con,"update passenger set Name='$name' , Id_Proof='$id_proof' ,Gender='$gender', Age='$age' where P_id='$id';");
      if($res){
        echo "<script>alert('Updated');</script>";
        
        $res=mysqli_query($con,"select * from passenger where P_id='$id'");
        $row=mysqli_fetch_assoc($res);

        $Name=$row['Name'];
        $Id_proof=$row['Id_Proof'];
        $Gender=$row['Gender'];
        $Age=$row['Age'];

        unset($_POST['edit']);

      }
      else{
        echo "<script>alert('Could not update');</script>";
      }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
 
</head>
<body>
   
     <!-- navbar -->
  <nav class="navbar navbar-expand-md bg-light  navbar-light">
    <div class="container-xxl">
      <!-- brand -->
      <a href="#info" class="navbar-brand">
        <h1 class="fw-bold text-secondary"><i class="bi bi-signpost"></i>  Railways</h1>
      </a>

      <!-- toggle button -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- nav links -->
      <div class="collapse navbar-collapse justify-content-end align-center" id="main-nav">
           <ul class="navbar-nav my-2">

      

          <li class="nav-item dropdown">
           <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           Services
           </a>
           <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="bookings.php">Your bookings</a></li>
            <li><a class="dropdown-item" href="bookings.php">Cancel Booking</a></li>
            <!-- <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#"></a></li> -->
          </ul>
         </li>

            <li class="nav-item">
               <a href="logout.php" class="nav-link">Logout</a>
             </li>
            <li class="nav-item d-none d-md-block">
              <a href="main.php" class="nav-link btn btn-secondary ms-2 text-white">Book now</a>
            </li>
            <li class="nav-item">
              <a href="main.php" class="nav-link d-md-none">Book now</a>
            </li>
           </ul>
      </div>
    </div>
  </nav>

  <div class=" container-md">
  <div class="display-6 mt-4 text-muted">
            <h2 class="display-5">User Update</h2>
        </div>
    <div class="my-4  p-4 bg-light ">
    <form method="POST" >
        
                      <label for="name" class="form-label">Name</label>
                      <input required type="text" value="<?php echo $Name?>" id="name" name="name"  class="form-control">
                    
                       <label  for="gender" class="form-label">Gender</label> 
                       <select required name="gender" id="gender"  class="form-control" placeholder="Select">
                            <!-- <option value="" hidden selected disabled >Select your gender:</option>     -->
                            <option value="M"  name="M"
                              <?php 
                                  if($Gender == "M") echo('selected')
                              ?>
                            >Male</option>
                           <option value="F" name="F"
                             <?php 
                                  if($Gender == "F") echo('selected')
                              ?>
                           >Female</option>
                           <option value="O" name="O"
                               <?php 
                                  if($Gender == "O") echo('selected')
                              ?>
                           >Others</option>
                       </select>

                       <label for="age" class="form-label">Age</label>
                       <input required type="number" class="form-control" value="<?php echo $Age?>" id="age" name="age" >
                       
                       <label for="id_proof" class="form-label">Id Proof Nmber</label>
                       <input required type="text"name="id_proof" value="<?php echo $Id_proof?>" class="form-control" >
            
            
                        <input class="btn btn-outline-primary my-3" type="Submit" value="Edit" name="edit">
     
    </form>
    </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>