<?php 
session_start();
include('includes/config.php');
include('includes/header.php');

error_reporting(0);

//login
if(isset($_POST['login']))
{
$email=$_POST['email'];
$password=md5($_POST['password']);
$sql ="SELECT Email,Password FROM creators WHERE Email=:mail and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':mail', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);


$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
echo "Entered Password: " . $password . "<br>";
echo "Stored Password: " . $results[0]->Password . "<br>";
if($query->rowCount() > 0)
{
$_SESSION['login']=$_POST['email'];

echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
} else{
  
  echo "<script>alert('Invalid Details');</script>";

}

}
?>


    <body class="">
        

        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
              

                <div class="row justify-content-center">
                    <div class="col-xl-5 col-sm-8">
                        <div class="">
                            <div class="p-4">
                                <div class="p-2">
                                   
                                    <form class="form-horizontal" method="POST">

                                        <div class="row">
                                            <div class="col-md-12">
                                                 <h5 style="text-align:center;font-weight:800;font-family:arial;">Creator Login</h5>
                                                <div class="form-group form-group-custom mb-4">
                                                    <input type="email" class="form-control" name="email" placeholder="email" required>                                                   
                                                </div>

                                                <div class="form-group form-group-custom mb-4">
                                                    <input type="password" class="form-control" id="myInput" name="password" placeholder="password" required>                                                   
                                                    
                                                </div>
                                                <input type="checkbox" onclick="myFunction()">Show Password

                                                <div class="row">
                                                   
                                                    <div class="col-md-6">
                                                        <div class="text-md-right mt-3 mt-md-0">
                                                            <a href="pass/sms.php" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <button class="btn btn-success btn-block waves-effect waves-light" type="submit" name="login">Log In</button>
                                                </div>
                                                <div class="mt-4 text-center">
                                                    <a href="signup.php" class="text-muted"><i class="mdi mdi-account-circle mr-1"></i> Create an account</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- end Account pages -->

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        
        <script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

        <script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>

        <script src="assets/js/app.js"></script>

    </body>
</html>