<?php
  require('connection.php');
    
    if($_SESSION['IS_LOGIN']=='no'){
      header('location:../index.php');
      die();
  }
  $id=$_SESSION['P_id'];
  if(isset($_SESSION['canceled'])){
    if($_SESSION['canceled']==1){
      echo "<script>alert('Deleted your booking!!')</script>";
      unset($_SESSION['canceled']);
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
  <nav class="navbar navbar-expand-md bg-light navbar-light fixed-top">
    <div class="container-xxl">
      <!-- brand -->
      <a href="#info" class="navbar-brand">
        <h1 class="fw-bold text-secondary"><i class="bi bi-signpost"></i> Railways</h1>
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
        <div class="display-6 mt-5 text-muted">
            <h2>Bookings</h2>
        </div>
        
        <table class="table">
            <tr>
                <th>Booking id</th>
                <th>Seat_no</th>
                <th>Date</th>
                <th>Train_id</th>
                <th>Train name</th>
                <th>Source</th>
                <th>Destination</th>
                <th>Emergency contact</th>
                <th>Booked Time</th>
            </tr>

            <?php
            $res=mysqli_query($con,"select b.B_id,b.Seat_No,b.Date,b.Train_id,t.Train_name,b.bookedTime from booking b,train t where P_id='$id' and b.Train_id=t.Train_id");
            
            // $res=mysqli_query($con,"select b.B_id,b.Seat_No,b.Date,b.Train_id,t.Train_name,s.Phone_No from booking b,train t,train_staff ts,staff s where b.P_id='$id' and b.Train_id=t.Train_id and b.Train_id=ts.Train_id and ts.Staff_id=s.Staff_id");
            $i=1;
                while($row=mysqli_fetch_assoc($res)){ ?>
                <tr>
                <!-- <td><?php echo $i?></td> -->
                    <td><?php echo $row['B_id']?></td>
                    <td><?php echo $row['Seat_No']?></td>
                    <td><?php echo $row['Date']?></td>
                    <td><?php echo $row['Train_id']?></td>
                    <td><?php echo $row['Train_name']?></td>
                    
                    
                    <td><?php $train_id=$row['Train_id'];
                        $train_id=$row['Train_id'];
                        $res2=mysqli_query($con,"select Source from train where Train_id='$train_id'");
                        $row2=mysqli_fetch_assoc($res2);
                        echo $row2['Source'];
                    ?></td>

                    <td><?php $train_id=$row['Train_id'];
                        $train_id=$row['Train_id'];
                        $res3=mysqli_query($con,"select Destination from train where Train_id='$train_id'");
                        $row3=mysqli_fetch_assoc($res3);
                        echo $row3['Destination'];
                    ?></td>
                    
                    <td><?php 
                      $train_id=$row['Train_id'];
                      $res1=mysqli_query($con,"select s.Phone_No from staff s,train_staff ts where  ts.Train_id='$train_id' and s.Staff_id=ts.Staff_id");
                      $phone=mysqli_fetch_assoc($res1);
                      echo $phone['Phone_No']?></td>
                    
                    <td><?php echo $row['bookedTime']?></td>
                    
                    <td><a href="cancel.php?b_id=<?php echo $row['B_id'];?>"  class="btn btn-sm btn-outline-primary">Cancel</a></td>
                    
                  </tr>
                    <?php
                $i++; } ?>
        </table> 
    </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>