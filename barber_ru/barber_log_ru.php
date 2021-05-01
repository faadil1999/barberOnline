<?php
session_start();

require 'database.php';
$errorConnexion = $log_email = $log_password = $hashpass ="";

$log_emailError = $log_passwordError ="";
$log_page = $_SERVER['PHP_SELF'];

if($_SERVER['REQUEST_METHOD'] == "POST")
{  
    /*Log in*/
    @$log_email = verifyInput($_POST['log_email_ba']);
    @$log_password = verifyInput($_POST['log_password_ba']);
    $hashpass = sha1(htmlspecialchars(trim($_POST['log_password_ba'])))  ;
    if(empty($log_email))
    {
        $log_emailError  = "Как вы хотите войти без электронной почты??";
    }
    if(empty($log_password))
    {
        $log_passwordError  = "ПАРОЛЬ, пожалуйста";
    }
    
    
    if(empty($log_email) && empty($log_password))
    {
        $log_page = $_SERVER['PHP_SELF'];
    }
    else if(empty($log_email) || empty($log_password))
    {
        $log_page = $_SERVER['PHP_SELF'];
    }
    else
    {
        $db = Database::connect();
      
        if(user_exist($log_email,$hashpass) == 0)
        {
          $errorConnexion = "Ваш пароль или адрес электронной почты неверны";
        }
        else
        {
            $_SESSION['log_email_ba'] = $log_email;
            header('Location:barber_profil_ru.php');
        }
        //dirige profil du coiffeur
    }
   
 }  
    
    function verifyInput($var)
    {
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
        
        return $var ;
    }

function user_exist($email,$password)
    {
        $db  = Database::connect();
        $sql = "SELECT * FROM barbers WHERE email_ba = ? AND password_ba = ?";
        $req =$db->prepare($sql);
        $req->execute(array($email,$password));
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
                 <a href="index_ru.php"><div class="title">
                     <h1 id="title"><img src="images/title1.png"> Barberonline <img src="images/title1.png"></h1> 
                     </div></a>
             </div>
                
                
                <div class="col-sm-12 ">
                    <div id="log_in_barber">
                        <h1 class="sous_titre">Подключиться</h1>
                         <form action="barber_log_ru.php" method="post">
                                <div class="form-group">
                                    <label for="email">Эл. адрес :</label>
                                    <input type="email"  class="form-control" name="log_email_ba"  id="email" value="<?php echo $log_email ;?>">
                                   <p  class="comments" ><?php echo $log_emailError;?></p>
                                </div>
                                <div class="form-group">
                                    <label for="password">Пароль :</label>
                                    <input type="password" class="form-control"  name="log_password_ba" id="log_password" value="<?php echo $log_password; ?>">
                                   <p  class="comments" ><?php echo $log_passwordError;?></p>
                                   <p  class="comments" ><?php echo $errorConnexion;?></p>
                                    
                                </div>
                            
                            <button class="btn btn-primary" type="submit"> Go</button>
                            <a href="forgotenPsw_ru.php">Забыли Ваш пароль?</a>
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