<?php
    require('connection.php');

    
    
    $id=mysqli_real_escape_string($con,$_GET['id']);

    $res=mysqli_query($con,"select * from staff where Staff_id='$id'");
    $row=mysqli_fetch_assoc($res);

    if(isset($_POST['delete'])){
        $res=mysqli_query($con,"delete from staff where Staff_id='$id'");
        if($res){
            echo "<script>confirm('Deleted');</script>";
            $_SESSION['deleted']=1;
            header('location:admin.php');
            die();
        }
        else{
            echo "<script>alert('Train could not be deleted');</script>";
        }
        
    }
    
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Staff</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
   

</head>
<body >
   
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
            <li><a class="dropdown-item" href="#">Cancel Booking</a></li>
            <!-- <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#"></a></li> -->
          </ul>
         </li>

            <li class="nav-item">
               <a href="logout.php" class="nav-link">Logout</a>
             </li>
            <li class="nav-item d-none d-md-block">
              <a href="admin.php" class="nav-link btn btn-secondary ms-2 text-white">Admin Page</a>
            </li>
            <li class="nav-item">
              <a href="admin.php" class="nav-link d-md-none">Admin Page</a>
            </li>
           </ul>
      </div>
    </div>
  </nav>

  <div class=" container-md">
    <div class="my-4  p-4 bg-light ">
    <form  method="post">
        <table class="table">
        <tr>
                    <th>Staff_id</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Phone number</th> 
        </tr>
                    <td><?php echo $row['Staff_id']?></td>
                    <td><?php echo $row['Name']?></td>
                    <td><?php echo $row['Designation']?></td>
                    <td><?php echo $row['Phone_No']?></td>
        </tr>
                 
        </table>
        
        
        <input type="submit" class="btn btn-outline-primary" id="delete" name="delete" value="Delete">
    </form>

    </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>