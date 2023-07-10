<?php
    require('connection.php');
  
    
    if($_SESSION['IS_LOGIN']=='no'){
        header('location:../index.php');
        die();
    }
    
    if(isset($_SESSION['booked'])){
      if($_SESSION['booked']==1){
         echo "<script>alert('Ticket Booked!')</script>";
        unset($_SESSION['booked']);
          }  
    }

    if(isset($_POST['book_train'])){
      // // echo $_POST['seat'];
      // // $temp=$_POST['source'];
      // // echo "<script>alert($temp)</script>";
      // // echo "<script>alert('hello')</script>"
      
       $train=mysqli_real_escape_string($con,$_POST['train']);
       $seat=mysqli_real_escape_string($con,$_POST['seat']);
       $date=mysqli_real_escape_string($con,$_GET['date']);

      
       $res=mysqli_query($con,"select Train_id from train where Train_name='$train';");
       $row=mysqli_fetch_assoc($res);
       $train_id=$row['Train_id'];
            
       $P_id=$_SESSION['P_id']; 
       $sql="INSERT INTO `booking` (`B_id`, `Seat_No`, `Date`, `Train_id`, `P_id`) VALUES (NULL, '$seat', '$date', '$train_id', '$P_id');";     
       $res=mysqli_query($con,$sql);
       if($res){
         $_SESSION['booked']=1;
         unset($_POST['book_train']);

         $res1=mysqli_query($con,"select s.Phone_No from staff s,train_staff ts where  ts.Train_id='$train_id' and s.Staff_id=ts.Staff_id");
         $row1=mysqli_fetch_assoc($res1);
         $phone=$row1['Phone_No'];
        
         ob_end_clean();
                  
                  require('../fpdf/fpdf.php');
                    
                  // Instantiate and use the FPDF class 
                  $pdf = new FPDF();
                    
                  //Add a new page
                  $pdf->AddPage();
                    
                  // Set the font for the text
                  $pdf->SetFont('Arial', 'B', 18);
                    
                  // Prints a cell with given text 
                  $pdf->Cell(0,10,'Thank you for travelling with us',1,2,'C');
                  $pdf->Cell(0,10,'Your ticket has been booked succesfully!!',0,1,'C');
                  $pdf->Cell(0,10,"",0,1,'L');
                  $pdf->Cell(0,10,"Train name: ".$train,0,1,'L');
                  $pdf->Cell(0,10,"",0,1,'L');
                  $pdf->Cell(0,10,"Train id: ".$train_id,0,1,'L');
                  $pdf->Cell(0,10,"",0,1,'L');
                  $pdf->Cell(0,10,"Seat number: ".$seat,0,1,'L');
                  $pdf->Cell(0,10,"",0,1,'L');
                  $pdf->Cell(0,10,"Date: ".$date,0,1,'L');
                  $pdf->Cell(0,10,"",0,1,'L');
                  $pdf->Cell(0,10,"Emergency contact: ".$phone,0,1,'L');
                  // for($i = 1; $i <= 5; $i++)
                  //     $pdf->Cell(0, 10, 'line number ' 
                  //             . $i, 0, 1);
                    
                  // return the generated output
                  $pdf->Output();
         header('location:main.php');
         die();
       }
      }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Railways</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
</head>
<body>
   
    
  <!-- navbar -->
  <nav class="navbar navbar-expand-md bg-light navbar-light fixed-top">
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
            <li><a class="dropdown-item" href="bookings.php?id=<?php echo $_SESSION['P_id']?>">Your bookings</a></li>
            <li><a class="dropdown-item" href="bookings.php">Cancel Booking</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="update_user.php?id=<?php echo $_SESSION['P_id']?>">Update Profile</a></li>
          </ul>
         </li>

            <li class="nav-item">
               <a href="logout.php" class="nav-link">Logout</a>
             </li>
            <li class="nav-item d-none d-md-block">
              <a href="#Booking" class="nav-link btn btn-secondary ms-2 text-white">Book Now</a>
            </li>
            <li class="nav-item">
              <a href="#Booking" class="nav-link d-md-none">Book now</a>
            </li>
           </ul>
      </div>
    </div>
  </nav>

  <br><br><br><br>
  <!-- main intro and image -->
   <section id="intro">
    <div class="container-md">
      <div class="row align-items-center py-3">
      <!-- text -->
        <div class="col-md-6  text-center  text-md-start">
          <h1 class="display-4 ">Welcome to Indian railways!</h1>
          <p class="text-muted mt-3 ">Good to see you back.
              Enjoy your journey with us. Book your next ride now!
          </p>
          <!-- <a href="#Booking" class="btn btn-secondary ">Book Now</a> -->
        </div>
        <!-- image -->
        <div class="col-md-6  d-none justify-content-end d-md-block">
          <img class="image-fluid" src="../assets/logo.jfif" style="width=100px" alt="flight">
        </div>
      </div>
    </div>
   </section>

   <!-- <section id="info my-5">
     <div class="container  p-3 justify-content-center text-start">
       <p class="lead text-muted">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Esse assumenda doloribus qui accusamus aliquid sapiente omnis provident! Est placeat non quibusdam, sit sapiente corrupti vitae quaerat amet id tenetur doloribus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Non animi quia accusamus, a distinctio adipisci labore officiis? Voluptatem autem molestias suscipit laboriosam consectetur nemo minus aliquam! Delectus, quibusdam blanditiis. Nihil? Lorem ipsum, dolor sit amet consectetur adipisicing elit. Illum ullam voluptatibus dolore fugit earum eligendi totam! Tempore quae accusamus hic quam iste nemo cumque debitis, dolorum, facilis quis quidem totam.</p>
     </div>
   </section> -->

   <!-- <section id="pricing">
     <div class="container-xxl p-3 bg-light text-center align-items-center">
      
      <h2 class="display-5 text-secondary ">Pricing Plans</h2>
      <p class="text-muted">Select a plan to suit you</p>
        row
      <div class="row g-0 justify-content-center text-center my-3"> -->
         <!-- column1  -->
        <!-- <div class="col-8 col-md-4 col-lg-3 my-3">
            <div class="card">
              <div class="card-body">
                <h3 class="display-7 fw-bold card-title">Plan 1</h3>
                <p class="lead text-muted card-subtitle">Lorem ipsum dolor sit amet.</p>
                <p class="display-7 text-muted  card-text d-none d-md-block">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque id, quisquam delectus maxime error vitae voluptatem nesciunt illo fugiat. Minima eum repellendus animi provident ipsa sit eveniet a consequuntur expedita!</p>
                <a href="#Booking" class="btn my-4 btn-outline-primary btn-md">Buy Now</a>
              </div>
            </div>
          </div> -->

          <!-- column 2 -->
          <!-- <div class="col-8 col-md-5 col-lg-4 my-2">
            <div class="card border-primary border-2">
              <div class="card-header">
                <h2 class="text-primary fw-bold">Trending</h2>
              </div>
              <div class="card-body">
                <h3 class="display-7 fw-bold card-title">Plan 3</h3>
                <p class="lead  text-muted card-subtitle">Lorem ipsum dolor sit amet.</p>
                <p class="display-7 text-muted card-text d-none d-md-block">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque id, quisquam delectus maxime error vitae voluptatem nesciunt illo fugiat. Minima eum repellendus animi provident ipsa sit eveniet a consequuntur expedita!</p>
                <a href="#Booking" class="btn my-4 btn-outline-primary btn-lg">Buy Now</a>
              </div>
            </div>
          </div> -->

          <!-- column 3 -->
          <!-- <div class="col-8 col-md-4 col-lg-3 my-3">
            <div class="card">
              <div class="card-body">
                <h3 class="display-7 fw-bold card-title">Plan 1</h3>
                <p class="lead text-muted card-subtitle">Lorem ipsum dolor sit amet.</p>
                <p class="display-7 text-muted card-text d-none d-md-block">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque id, quisquam delectus maxime error vitae voluptatem nesciunt illo fugiat. Minima eum repellendus animi provident ipsa sit eveniet a consequuntur expedita!</p>
                <a href="#Booking" class="btn my-4 btn-outline-primary btn-md">Buy Now</a>
              </div>
            </div>
          </div>
        
        
        </div> -->
        <!-- end of row -->
     
        <!-- <a href="#Booking" class="btn btn-outline-secondary btn-sm">Other plans</a>
      </div>
   </section> -->
 
   <!-- ratings -->
   <!-- <section class="rating">
     <div class="container-lg align-items-center mt-4 ">
        <div class="text-center">
          <h2><i class="bi bi-stars"></i>Ratings</h2>
          <p class="lead">Lorem ipsum dolor sit amet.</p>
        </div>

        <div class="row justify-content-center my-4">
          <div class="col-lg-9">
            <div class="list-group ">
              <div class="list-group-item mt-2">
                <div class="pb-2">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                </div>   
                <h2>A Must try</h2>
                  <p class="text-muted">Lorem ipsum dolor sit amet.</p>
                  <small>Review by mario</small>
                </div>

              <div class="list-group-item my-2">
                <div class="pb-2">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                </div> 
                <h2>A Must try</h2>
                  <p class="text-muted">Lorem ipsum dolor sit amet.</p>
                  <small>Review by mario</small>
                </div>

              <div class="list-group-item my-2">
                <div class="pb-2">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                </div> 
                <h2>A Must try</h2>
                  <p class="text-muted">Lorem ipsum dolor sit amet.</p>
                  <small>Review by mario</small>
                </div>
            </div>
          </div>
        </div>
     </div>
   </section> -->

    <!-- booking -->
   
   
    <section id="Booking">
     <div class="container-lg bg-light p-3 my-3 justify-content-center align-items-center">
      <div class="text-muted mt-2">
        <h2>Book your journey here..</h2>
      </div> 
      <form class="form my-3"  method="GET">
          <!-- source -->
          <label for="source" class="form-label">Source</label>
                  <select name="source" class="form-select" id="source" required>
                        <option value="" selected disabled hidden></option>
                        <?php
                        $res=mysqli_query($con,"select distinct source from train");
                        $i=1;
                        while($row=mysqli_fetch_assoc($res)){
                      ?>
                        
                        <option value="<?php echo $row['source']?>" ><?php echo $row['source']?></option>
                      <?php $i++; } ?>
                  </select>

                  <!-- destination -->
                  <label for="dest" class="form-label">Destination</label>
                  <select name="dest" class="form-select" id="dest" required>
                    <option value="" selected disabled hidden></option>
                    
                        <?php
                        $res=mysqli_query($con,"select distinct destination from train");
                        $i=1;
                        while($row=mysqli_fetch_assoc($res)){
                      ?>
                        
                        <option value="<?php echo $row['destination']?>"><?php echo $row['destination']?></option>
                      <?php $i++; } ?>
                  </select>

                  <!-- date -->
                  <label for="date"class="form-label">Select date</label>
                  <input type="date" name="date" class="form-control">

                  <input type="submit" value="Search Trains" class="btn my-2 btn-outline-secondary" name="search">
      </form>


      <form method="POST">
         <!-- <label for="name" class="form-label">Name</label>
         <input type="text" class="form-control" id="name" placeholder="enter your name"> -->

         <!-- <label for="email" class="form-label">Email</label>
         <input type="email" class="form-control" id="email" placeholder="abc@gmail.com"> -->
       
                 
                   <?php
                    
                      if(isset($_GET['search'])){
                        $source=mysqli_real_escape_string($con,$_GET['source']);
                        $dest=mysqli_real_escape_string($con,$_GET['dest']);
                        $date=mysqli_real_escape_string($con,$_GET['date']);

                        $res=mysqli_query($con,"select Train_id,Train_name from train where Source='$source' AND Destination='$dest'");
                        if(!($row=mysqli_fetch_assoc($res))){
                           echo "<script>alert('No Trains found!')</script>";
                        }
                        // $row=mysqli_fetch_assoc($res);
                        $Train_id=$row['Train_id'];

                        $res1=mysqli_query($con,"select Seat_No from booking where date='$date' and Train_id='$Train_id'");
                        $seats=array();
                        while($row1=mysqli_fetch_assoc($res1)){
                          array_push($seats,$row1['Seat_No']);
                        }
                          $avail=array();
                     
                          for($i=1;$i<=100;$i++){
                            if((in_array($i,$seats))){
                              // array_push($avail,$i);
                            }
                            else{
                              array_push($avail,$i);
                            }
                          

                          // for ($i=1; $i < count($avail); $i++) { 
                          //   echo $avail[$i];
                          //   echo "\n";
                          // }
                        }
                      
                   ?>
                  <!-- train -->
                  <label for="train" class="form-label">Select Train</label>
                  <select name="train" class="form-select" id="train" required>
                    <option value="" selected disabled hidden>Select a train</option>
                    <?php
                        
                        $i=1;
                        // if(!($row=mysqli_fetch_assoc($res))){
                        //   echo "<script>alert('No Trains found!')</script>";
                        // }
                        while($row){
                         
                      ?>
                        
                        <option value="<?php echo $row['Train_name']?>"><?php echo $row['Train_name']?></option>
                      <?php 
                        $row=mysqli_fetch_assoc($res);
                        $i++; } 
                      ?>
                  </select> 

                  <!-- seat -->

                  <small><b id="seats"></b></small>
                  <label for="seat" class="Form-label">Select seat</label>
                  <!-- <input type="number" name="seat" required class="form-control"> -->
                  <select name="seat" id="seat" required class="form-control">
                          <option selected disabled hidden>Select a seat</option>
                          <?php
                                for ($i=1; $i < count($avail); $i++) { ?>
                                  <option value="<?php echo $avail[$i]?>"><?php echo $avail[$i]?></option>
                             <?php   }  ?>
                  </select>
                  
                  <!-- date
                  <label for="date"class="form-label">Select date</label>
                  <input type="date" name="date" class="form-control"> -->
              

                  <!-- submit button -->
                <input type="submit" name="book_train" class="btn btn-secondary my-3" value="Book Now">
                <?php }?>
        </form>
     </div>
   </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        var today = new Date().toISOString().split('T')[0];
        document.getElementsByName("date")[0].setAttribute('min', today);
    </script>
</body>
</html>