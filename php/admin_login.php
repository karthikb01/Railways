<?php
    require("connection.php");
    
    $_SESSION['is_admin_login']="no";
    
    if(isset($_POST['submit'])){
        // $username=mysqli_real_escape_string($con,$_POST['username']);
        $password=mysqli_real_escape_string($con,$_POST['password']);
        unset($_POST['submit']);
        if($password=='root'){
            $_SESSION['is_admin_login']="yes";
            header('location:admin.php');
            die();
        }
        else{
            echo "<script>alert('Enter valid password')</script>";
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
            
           background-image: url("../assets/train.jpg");
           /* background-size: 100% auto; */
           background-height:100vh;
           background-repeat:no-repeat;

        }
    </style>
</head>
<body>
     
    <!-- navbar -->
    <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container-xxl">
            <a href="../index.php" class="navbar-brand">
                <span class="fw-bold text-warning ">
                    <h2 class="fw-bold "><i class="bi bi-signpost"></i>  Railways</h2>
                </span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav">
                <span class="navbar-toggler-icon fill-light"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end align-center" id="main-nav">
                <ul class="navbar-nav my-2">

                <li class="nav-item">
                    <a href="../index.php" class="nav-link d-md-none text-white ">Login</a>
                    <a href="../index.php" class="nav-link d-none d-md-block btn btn-warning text-white ">Login</a>
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
    <!-- body -->
    <div class="container align-items-center mt-5 ">
        <div class="row justify-content-start  ">
            <div class="col-md-1 d-none d-md-block"></div>     
            <div class="col-md-5 col-lg-5  align-items-center">
               
              <div class="card p-4 border-light border-2 bg-transparent">
                <!-- <div >
                    <h2 class="fw-bold text-warning"><small>Admin Login</small></h2>
                </div> -->
                <form  class="my-3" method="POST">
                    <!-- <label for="username" class="form-label">Username</label>
                    <input required type="text" id="username" name="username" class="form-control" placeholder="Enter your username"> -->
  
                    <!-- <label for="password" class="form-label mt-2">Password</label> -->
                    <input required type="password" name="password" id="password" class="form-control" placeholder="Enter admin password">
  
                   <input type="submit" name="submit" id="submit" value="Login" class="btn btn-warning mt-3 text-white">
                </form>
              </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>