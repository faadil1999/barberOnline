<?php
session_start();

require 'database.php';

$sig_firstname = $sig_name = $sig_email = $sig_tel="";

$sig_firstnameError = $sig_nameError = $sig_emailError = $sig_emailError2  = $sig_telError ="";
$log_page = "";

if($_SERVER['REQUEST_METHOD'] == "POST")
{   /*sign in*/
   @$sig_firstname = verifyInput($_POST['sig_first_name_ba']);
   @$sig_name = verifyInput($_POST['sig_name_ba']);
    @$sig_tel = verifyInput($_POST['sig_tel_ba']);
    @$sig_email = verifyInput($_POST['sig_email_ba']);
    $isSucess = true;
    
    
    if(empty($sig_firstname))
    {
        $sig_firstnameError  = "champion дайте мне Фамилию ";
        $isSucess = false;
    }
    if(empty($sig_name))
    {
        $sig_nameError  = "Champion скажи свое имя ";
        $isSucess = false;
    }
    if(empty($sig_email))
    {
        $sig_emailError  = "champion дайте мне вашу электронную почту";
        $isSucess = false;
        $sig_emailError2  ="";
    }
    if(user_exist($sig_email) == 1)
    {
         $sig_emailError2  = "Этот адрес электронной почты уже используется, бро";
        $isSucess = false;
    }
    if(empty($sig_tel))
    {
        $sig_telError  = "Ваш телефонный звонок";
         $isSucess = false;
    }
    
    if(empty($sig_firstname) && empty($sig_name) && empty($sig_email) && empty($sig_tel) )    
    {  
        $log_page = $_SERVER['PHP_SELF'];
        $isSucess = false;
    }
    
    else if(empty($sig_firstname) || empty($sig_name) || empty($sig_email) || empty($sig_tel) || user_exist($sig_email) == 1 )    
    {    
        $log_page = $_SERVER['PHP_SELF'];
        $isSucess = false;
    }
    
    else
    {
          
      $db = Database::connect();  
    
      $sql = "INSERT INTO barbers(name_ba,first_name_ba,email_ba,tel_ba,password_ba ,picture_ba ,ville_id_ba ,price ) VALUES( ? , ? , ? , ? , ? , ? , ? , ? )";
      $statement = $db->prepare($sql);
      $statement ->execute(array( $sig_name , $sig_firstname , $sig_email , $sig_tel , '11' , 'a.jpg' , '1' , '150') );
         $_SESSION['sig_email_ba'] = verifyInput($_POST['sig_email_ba']);
      Database::disconnect();
     
        $db = Database::connect();  
    
      $sql = "INSERT INTO pic_portofolio(email_ba,picture_1,picture_2,picture_3,picture_4,picture_5,picture_6) VALUES( ? , ? , ? , ? , ? , ? , ? )";
      $statement = $db->prepare($sql);
      $statement ->execute(array($sig_email  ,'add-image.png','add-image.png','add-image.png','add-image.png','add-image.png','add-image.png'));
      Database::disconnect();
        header("Location: barber_page_ru.php");     
    }
    
 }  
    
    function verifyInput($var)
    {
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
        
        return $var ;
    }


function user_exist($email)
    {
        $db  = Database::connect();
        $sql = "SELECT * FROM barbers WHERE email_ba = ?";
        $req =$db->prepare($sql);
        $req->execute(array($email));
          $exist = $req->rowCount();
        return $exist;
         Database::disconnect();
    }

?>
<?php
 include "principal.php";    
?>
     <div class="container">
            <div class="row">
                  <div class="col-md-12">
                <a href="index_ru.php"> <div class="title">
                     <h1 id="title"><img src="images/title1.png"> Barberonline <img src="images/title1.png"></h1> 
                    </div></a>
             </div>
                
                <div class="col-sm-12 ">
                   
                    <div id="sign_in_barber">
                        <h1 class="sous_titre">Регистр</h1>
                        <form action="barber_sign_ru.php" method="post">
                            <div class="form-group">
                                <label for="name">Имя :</label>
                                <input type="text" class="form-control"  name="sig_name_ba" id="name" value="<?php echo $sig_name?>">
                               <p  class="comments" ><?php echo $sig_nameError; ?></p>
                            </div>
                            <div class="form-group">
                                <label for="first_name">Фамилия :</label>
                                <input type="text" class="form-control" name="sig_first_name_ba"  id="sig_first_name" value="<?php echo $sig_firstname ;?>">
                               <p  class="comments" ><?php echo $sig_firstnameError; ?></p>
                            </div>
                            <div class="form-group">
                                <label for="email">Эл. адрес :</label>
                                <input type="email" class="form-control" name="sig_email_ba"  id="sig_email" value="<?php echo $sig_email?>">
                               <p  class="comments" ><?php echo $sig_emailError;?></p>
                               <p  class="comments" ><?php echo $sig_emailError2;?></p>
                            </div>
                            <div class="form-group">
                                <label for="tel">Номер Тел :</label>
                                <input type="tel" class="form-control"  name="sig_tel_ba" id="sig_tel" value="<?php echo $sig_tel ;?>">
                            </div>
                            
                            <button class="btn btn-primary" type="submit"> Go</button>
                        </form>
                    </div>
                    
                </div>
            
            </div>
        
    </div>
    
</body>