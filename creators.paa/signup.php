<?php 
session_start();
include('includes/functions.php');
include('includes/config.php');
include('includes/header.php');
error_reporting(0);
 

//register
if(isset($_POST['register']))
{
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$password=md5($_POST['password']);
$email=$_POST['email'];



$sql ="SELECT Email FROM creators WHERE Email=:mail";
$query= $dbh -> prepare($sql);
$query-> bindParam(':mail', $email, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
$msg="Vehicle Posted Successfully";   
}
else{


$sql="INSERT INTO creators(Fname,Lname,Password,Email) VALUES(:fname,:lname,:password,:mail)";

$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':lname',$lname,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':mail',$email,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
   
                    
                    
echo "<script>alert('Registration successfull. Now you can login');</script>";
echo "<script type='text/javascript'> document.location = 'login.php'; </script>";


                    
echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}
}
}


?>


    <body class="">
        <div class="home-btn d-none d-sm-block">
            <a href="https://rentershub.co.ke"><i class="mdi mdi-home-variant h2 text-white"></i></a>
        </div>

        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
               

                <div class="row justify-content-center">
                    <div class="col-xl-10 col-sm-8">
                        <div class="">
                            <div class="p-4 float-end">
                                <div class="p-2">
                                    <h5 class="mb-5" style="font-weight: 800;">Register as a Creator</h5>
                                    <form class="" method="post"  enctype="multipart/form-data">

                                        <div class="row">
                                       
                                                                                        
                                            
                                            <div class="row">
                                                <div class="col-lg-2 col-md-4">
                                                    <div class="form-group form-group-custom mb-4">
                                                        <input type="text" class="form-control" name="fname" placeholder="firstname" required>
                                                    
                                                    </div>
                                                </div> 
                                                <div class="col-lg-2 col-md-4">  
                                                    <div class="form-group form-group-custom mb-4">
                                                        <input type="text" class="form-control" name="lname" placeholder="lastname" required>
                                                    
                                                    </div>
                                                </div>  
                                            </div>                                                                                                                  

                                            <div class="col-lg-4 col-md-3">  
                                                <div class="form-group form-group-custom mb-4">
                                                    <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                                                    <!--<label for="email">Email</label> -->
                                                </div>
                                            </div>                                           
                                         

                                          
                                            

                                             <div class="row">
                                                <div class="col-lg-4 col-md-3">  
                                                    <div class="form-group form-group-custom mb-4">
                                                        <input type="password" class="form-control" id="useremail" name="password" placeholder="password" required>
                                                    
                                                    </div>
                                                </div>   
                                             </div> 
    
                                               
                                    
                                            
                                            <div class="col-md-6"> 
                                                <div class="mt-4">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="term-conditionCheck">
                                                        <label class="custom-control-label font-weight-normal" for="term-conditionCheck">I accept <a class="text-primary" data-toggle="modal" data-target=".bs-example-modal-xl">Terms and Conditions</a></label>
                                                    </div>
                                                </div>
                                            </div>    

                                            <div class="col-lg-4 col-md-6">     
                                                <div class="mt-4">
                                                    <button class="btn btn-success btn-block waves-effect waves-light" type="submit" name="register">Register</button>
                                                </div>
                                            </div>    

                                            <div class="col-md-6"> 
                                                <div class="mt-4 text-center">
                                                    <a href="login.php" class="text-muted"><i class="mdi mdi-account-circle mr-1"></i> Already have account?</a>
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
        
         <!--  Modal content for the above example -->
                                                            <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-xl">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">Terms and Conditions</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                         <p style="font-size:20px;font-weight:bold;">

1. This is a simple agreement between you and Renters Hub.<br>
2. Renters Hub will always advertise your property as long as your subscription is active.<br>

3. A subscription is active when Renters Hub receives payment of KSh. 3,000 per house type per property per year.<br>

4. Renters Hub does not accept any other mode of payment than MPESA to the Pay Bill number 4078389...the Account is the property ID shown while posting property.<br>

5. Renters Hub shall not accept responsibility for any money lost due to violating condition #4.<br>

6. Renters Hub will be committed to ensure everyone searching your property has seen it.<br>

7. You can post as many photos of your property on our website. Editing the house description is also possible at your convenient.<br>

8. Your subscription will be active for exactly one year after the date of subscription.<br>

9. Subscriptions are not transferable. <br>

10. For any communication with Renters Hub, use 0720902437 or 0731352350.  </p>   </div>
                                                                    </div><!-- /.modal-content -->
                                                                </div><!-- /.modal-dialog -->
                                                            </div><!-- /.modal -->

        <!-- JAVASCRIPT -->
        <script type="text/javascript">
let picturePreview = document.querySelector(".imagePreview");
let actionButton = document.querySelector(".action-button");
let fileInput = document.querySelector("input[name='fileInput']");
let fileReader = new FileReader();

const DEFAULT_IMAGE_SRC = "https://rentershub.co.ke/assets/img/user.png";

actionButton.addEventListener("click", () => {
  if ( picturePreview.src !== DEFAULT_IMAGE_SRC ) {
    resetImage();
  } else {
    fileInput.click();
  }
});

fileInput.addEventListener("change", () => {
  refreshImagePreview();
});

function resetImage() {
  setActionButtonMode("upload");
  picturePreview.src = DEFAULT_IMAGE_SRC;
  fileInput.value = "";
}

function setActionButtonMode(mode) {
  let modes = {
    "upload": function() {
      actionButton.innerText = "Upload photo";
      actionButton.classList.remove("mode-remove");
      actionButton.classList.add("mode-upload");
    },
    "remove": function() {
      actionButton.innerText = "Remove photo";
      actionButton.classList.remove("mode-upload");
      actionButton.classList.add("mode-remove");
    }
  }
  return (modes[mode]) ? modes[mode]() : console.error("unknown mode");
}

function refreshImagePreview() {
  if ( picturePreview.src !== DEFAULT_IMAGE_SRC ) {
    picturePreview.src = DEFAULT_IMAGE_SRC;
  } else {
    if ( fileInput.files && fileInput.files.length > 0 ){
      fileReader.readAsDataURL(fileInput.files[0]);
      fileReader.onload = (e) => {
        picturePreview.src = e.target.result;
        setActionButtonMode("remove");
      }
    }
  }
}

refreshImagePreview();

</script>
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>


        <script src="assets/js/app.js"></script>

    </body>
</html>
