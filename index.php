<?php
    require("php/connection.php");
    
    $_SESSION['IS_LOGIN']="no";
    if(isset($_SESSION['user_added'])){
        if($_SESSION['user_added']==1){
            echo "<script>alert('User added')</script>";
            unset($_SESSION['user_added']);
        }
    }

    
    
    
    if(isset($_POST['submit'])){
        $username=mysqli_real_escape_string($con,$_POST['username']);
        $password=mysqli_real_escape_string($con,$_POST['password']);

        
        $res=mysqli_query($con,"select P_id from login where username='$username'");
        $row=mysqli_fetch_assoc($res);
        $_SESSION['P_id']=$row['P_id'];
   
        

        $res=mysqli_query($con,"select * from login where username='$username' and password='$password'");

        if(mysqli_num_rows($res)>0){
            $_SESSION['IS_LOGIN']="yes";
            header('location:php/main.php');
            die();
        }
        else{
            echo "<script>alert('Enter valid details')</script>";
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <style>
        body{
            
           background-image: url("assets/train.jpg");
           /* background-size: 100% 100vh; */
           background-height:100vh;
           background-repeat:no-repeat;
           

        }
        
    </style>
</head>
<body >
     

    <!-- navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed">
        <div class="container-xxl">
            <a href="#" class="navbar-brand">
                <span class="fw-bold text-warning ">
                    <h2 class="fw-bold "><i class="bi bi-signpost"></i>  Railways</h2>
                </span>
            </a>

            <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#main-nav">
                <span class="navbar-toggler-icon fill-light"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end align-center" id="main-nav">
           <ul class="navbar-nav my-2">

             <li class="nav-item">
              <a href="php/admin_login.php" class="nav-link text-white ">Admin Login</a>
            </li>
            
            <li class="nav-item">
            <a  href="php/signup.php" class="d-none d-md-block ms-2 btn btn-warning btn-outlined-white text-white">Sign Up</a>
            </li>

            <li class="nav-item">
            <a  href="php/signup.php" class="d-md-none text-white  nav-link">Sign Up</a>
            </li>

           </ul>
      </div>
        </div>
    </nav>
    <!-- body -->
    <div class="container  align-items-center mt-5 " >
        <div class="row justify-content-start  ">
           <div class="col-md-1 d-none d-md-block"></div> 
           <div class="col-md-5 col-lg-5  align-items-center ">
               
              <div class="card p-4   border-1 border-light  text-white bg-transparent ">
                <!-- <div class="text-center">
                    <h2 class="display-7 fw-bold text-white">Login</h2>
                </div> -->
                <form  class="my-3" method="POST">
                    <label for="username" class="form-label text-warning">Username</label>
                    <input required type="text" id="username" name="username" class="form-control bg-light " placeholder="Enter your username:">
  
                    <label for="password" class="form-label mt-2 text-warning">Password</label>
                    <input required type="password" name="password" id="password" class="form-control bg-light" placeholder="Enter your password:">
  
                   <input type="submit" name="submit" id="submit" value="Login" class="btn btn-warning text-white my-3">
                </form>
              </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>