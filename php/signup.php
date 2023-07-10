<?php
    require('connection.php');
    // include('database.php');
    // $obj=new query();

    if(isset($_POST['submit'])){
            $name=mysqli_real_escape_string($con,$_POST['name']);
            $username=mysqli_real_escape_string($con,$_POST['username']);
            $password=mysqli_real_escape_string($con,$_POST['password']);
            $gender=mysqli_real_escape_string($con,$_POST['gender']);
            $phone=mysqli_real_escape_string($con,$_POST['phone']);
            $age=mysqli_real_escape_string($con,$_POST['age']);
            $id_proof=mysqli_real_escape_string($con,$_POST['id_proof']);
            // echo '<pre>';
            // print_r($_POST);

         $res=mysqli_query($con,"select * from login where username='$username'");
         if(mysqli_num_rows($res)>0){
             echo '<script>alert("Username taken!")</script>';
         }
         else{
                $res=mysqli_query($con,'select max(P_id) from login;');
                $row=mysqli_fetch_assoc($res);
                $id=(int)$row['max(P_id)'];
                $id=$id+1;
                // echo $id;
                $res=mysqli_query($con,"INSERT INTO `login` (`P_id`,`username`, `password`) VALUES ('$id','$username','$password');");
                $res=mysqli_query($con,"INSERT INTO `passenger` (`P_id`, `Id_Proof`, `Name`, `Gender`, `Age`,`Phone`) VALUES ('$id', '$id_proof', '$name', '$gender', '$age','$phone');");  
                echo "<script>alert('User added')</script>";
                $_SESSION['user_added']=1;
                header("location:../index.php");
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
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <script src="../js/sign_up.js"></script>
    <style>
        body{
            
           background-image: url("../assets/train.jpg");
           /* background-size: 100% auto; */
           background-height:100vh;
           background-repeat:no-repeat;

        }
    </style>
</head>
<body >
     
    <!-- navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top">
        <div class="container-xxl ">
            <a href="../index.php" class="navbar-brand">
                <span class="fw-bold text-secondary">
                    <h2 class="fw-bold text-warning"><i class="bi bi-signpost"></i>  Railways</h2>
                </span>
            </a>

            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav">
                <span class="navbar-toggler-icon fill-light"></span>
            </button>

                <div class="collapse navbar-collapse justify-content-end align-center" id="main-nav">
                <ul class="navbar-nav my-2">

                <li class="nav-item">
                     <a href="../index.php" class="nav-link text-white d-md-none ">Login</a>
                     <a href="../index.php" class="nav-link d-none d-md-block btn  btn-warning text-white ">Login</a>
                </li>   
                
                <!-- <li class="nav-item">
                <a  href="signup.php" class="d-none d-md-block ms-2 btn btn-outline-primary btn-outlined-white text-white">Sign Up</a>
                </li> -->

                <!-- <li class="nav-item">
                <a  href="signup.php" class="d-md-none text-white  nav-link">Sign Up</a>
                </li> -->

            </ul>
         </div>
           
        </div>
    </nav>

   <div class="container-md">
       <div class="row justify-content-center mt-5  align-items-center">
           <div class="col-md-7 mt-5 col-lg-7">
            <div class="card bg-black border-light text-light p-4">
                <div class="text-center">
                    <h2 class="display-6 text-warning fw-bold"><small>Sign Up</small></h2>
                </div>   
                <form method="POST" name="form" onsubmit="return validate()">
                       
                       <label for="name" class="form-label">Name</label>
                       <input required type="text" id="name" name="name" placeholder="Enter your full name:" class="form-control">
                     
                       <label  for="username" class="form-label">Username</label>
                       <input  required type="text" id="username" name="username" placeholder="Create a username:" class="form-control">
    
                       <label  for="gender" class="form-label">Gender</label> 
                       <select required name="gender" id="gender" class="form-control" >
                            <option value="" class="text-muted" selected disabled hidden>Select your gender:</option>    
                            <option value="M" name="M">Male</option>
                           <option value="F" name="F">Female</option>
                           <option value="O" name="O">Others</option>
                       </select>

                       <label for="age" class="form-label">Age</label>
                       <input required type="number" class="form-control" id="age" name="age" placeholder="Enter your age">

                       <!-- <small><b id="age_err" class="my-2 text-warning" ></b></small><br> -->
                       
                       <label for="phone" class="form-label">Phone number</label>
                       <input required type="number" class="form-control" id="phone" name="phone" placeholder="Enter your phone number">
                       
                       <!-- <small><b id="ph_err" class="my-2 text-warning" ></b></small><br> -->

                       <label for="id_proof" class="form-label">Id Proof Number</label>
                       <input required type="text"name="id_proof" class="form-control" placeholder="Enter a valid id number:">

                       <label for="password" class="form-label mt-2">Password</label>
                       <input  required type="password" id="password" name="password" placeholder="Enter a password:" class="form-control">

                        <div class="mt-2 text-warning">
                            <small><p>Password must conatin minimum of 8 charecters <br>
                                At least one upper case charecter <br>
                                At least a digit <br>
                                At least one special charecter <br>
                                </p>
                            </small>
                        </div>

                       <label for="re-password" class="form-label mt-2"></label>
                       <input required type="password" id="re-password" name="re-password" placeholder="Re-enter the password:" class="form-control">

                        <b id="err" class="text-danger  fw-bold"></b><br>
                

                       <input type="submit" class="btn btn-warning my-3 " value="Sign Up"   name="submit">
                   </form>
            </div>
           </div>
       </div>
   </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>