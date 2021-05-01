<?php
$sig_firstname = $sig_name = $sig_email = $sig_tel = $log_email = $log_password ="";

$sig_firstnameError = $sig_nameError = $sig_emailError = $sig_telError = $log_emailError = $log_passwordError ="";
$log_page = $_SERVER['PHP_SELF'];

if($_SERVER['REQUEST_METHOD'] == "POST")
{   /*sign in*/
   @$sig_firstname = verifyInput($_POST['sig_firstname']);
   @$sig_name = verifyInput($_POST['sig_name']);
    @$sig_tel = verifyInput($_POST['sig_tel']);
    @$sig_email = verifyInput($_POST['sig_email']);
    /*Log in*/
    @$log_email = verifyInput($_POST['log_email']);
    @$log_password = verifyInput($_POST['log_password']);
    
    
    if(empty($sig_firstname))
    {
        $sig_firstnameError  = "champion give me your firs name";
    }
    if(empty($sig_name))
    {
        $sig_nameError  = "Champion give me your name ";
    }
    if(empty($sig_email))
    {
        $sig_emailError  = "champion give me your email";
    }
    if(empty($sig_tel))
    {
        $sig_telError  = "Yoour tel pleaaaase";
    }
    if(empty($log_email))
    {
        $log_emailError  = "How do you want to enter without your email??";
    }
    if(empty($log_password))
    {
        $log_passwordError  = "PASSWOOOOOORD please";
    }
    $log_page = "barber_page.php";
 }  
    
    function verifyInput($var)
    {
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
        
        return $var ;
    }


?>
<?php
 include "principal.php";    
?>
     <div class="container">
            <div class="row">
                <div class="col-sm-12 title">
                    <h1><img src="images/title1.png"> Hair's style <img src="images/title1.png"></h1>
                </div>
                
                <div class="col-sm-6 ">
                   
                    <div id="sign_in_barber">
                        <h1 class="sous_titre">Sign in</h1>
                        <form action="pages/<?php echo $log_page;?>" method="post">
                            <div class="form-group">
                                <label for="name">Name :</label>
                                <input type="text" class="form-control"  name="sig_name" id="name">
                               <p  class="comments" ><?php echo $sig_nameError; ?></p>
                            </div>
                            <div class="form-group">
                                <label for="first_name">First Name :</label>
                                <input type="text" class="form-control" name="sig_first_name"  id="sig_first_name">
                               <p  class="comments" ><?php echo $sig_firstnameError;?></p>
                            </div>
                            <div class="form-group">
                                <label for="email">Email :</label>
                                <input type="email" class="form-control" name="sig_email"  id="sig_email">
                               <p  class="comments" ><?php echo $sig_emailError?></p>
                            </div>
                            <div class="form-group">
                                <label for="tel">Tel :</label>
                                <input type="tel" class="form-control"  name="sig_tel" id="sig_tel">
                            </div>
                            
                            <button class="btn btn-primary" type="submit"> Go</button>
                        </form>
                    </div>
                    
                </div>
                
                <div class="col-sm-6 ">
                    <div id="log_in_barber">
                        <h1 class="sous_titre">Log in</h1>
                        <form>
                                <div class="form-group">
                                    <label for="email">Email :</label>
                                    <input type="email"  class="form-control" name="log_email"  id="email">
                                   <p  class="comments" ><?php echo $log_emailError;?></p>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password :</label>
                                    <input type="password" class="form-control"  name="log_password" id="log_password">
                                   <p  class="comments" ><?php echo $log_passwordError;?></p>
                                </div>
                            
                            <button class="btn btn-primary" type="submit"> Go</button>
                            <p>Forgot your password?</p>
                        </form>
                    </div>
                    
                </div>
                
            </div>
        
        </div>
        
<!--
       <form class="formulaire">
           <h1>Barber</h1>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name">
            </div>
           <div class="form-group">
                <label for="first_name">First name</label>
                <input type="text" class="form-control" id="first_name">
            </div> 
           <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email">
            </div> 
        
       </form>
-->
             
      
    </div>
    
</body>