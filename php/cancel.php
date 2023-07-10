<?php
  require('connection.php');
  $cancel_id=$_GET['b_id'];

   
    if($_SESSION['IS_LOGIN']=='no'){
      header('location:../index.php');
      die();
  }

  if(isset($_POST['cancel'])){
      $res=mysqli_query($con,"delete from booking where B_id='$cancel_id'");
      if($res){
            $_SESSION['canceled']=1;
            header("location:bookings.php"); 
            die();     
      }
      else{
          echo "<script>alert('Could not delete!!')</script>";
      }
  }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
 
</head>
<body>
   
     <!-- navbar -->
  <nav class="navbar navbar-expand-md bg-light  navbar-light fixed">
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
              <a href="main.php" class="nav-link btn btn-secondary ms-2 text-white">Book Now</a>
            </li>
            <li class="nav-item">
              <a href="main.php" class="nav-link d-md-none">Book now</a>
            </li>
           </ul>
      </div>
    </div>
  </nav>

  <section id="bookings">
    <div class="container-md  align-items-center mt-5 p-3 justify-content-center">
        <div class="display-6 mt-4 text-muted">
            <h2 class="display-5">Are you sure to cancel?:</h2>
        </div>
        
        <form  method="POST">
        <table class="table">
            <tr>
                <th>B_id</th>
                <th>Seat_no</th>
                <th>Date</th>
                <th>Train_id</th>
                <th>P_id</th>
                <th></th>
            </tr>

            <?php
            $res=mysqli_query($con,"select * from booking where B_id='$cancel_id'");
            $i=1;
                while($row=mysqli_fetch_assoc($res)){ ?>
                <tr>
                <!-- <td><?php echo $i?></td> -->
                    <td><?php echo $row['B_id']?></td>
                    <td><?php echo $row['Seat_No']?></td>
                    <td><?php echo $row['Date']?></td>
                    <td><?php echo $row['Train_id']?></td>
                    <td><?php echo $row['P_id']?></td>
                    <td><input type="submit" name="cancel" class="btn btn-sm btn-outline-primary" value="Cancel"><td>
                  </tr>
                    <?php
                $i++; } ?>
        </table> 
        </form>
    </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>