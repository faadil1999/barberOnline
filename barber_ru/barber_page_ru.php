<?php
session_start();
$passwordError=" ";
$log_page = $password = $c_password = "";
require 'database.php';

if(!empty($_SESSION['sig_email_ba'])){

    @$sig_email = verifyInput($_SESSION['sig_email_ba']);

}
else
{
    echo "AAAAALllllleeerrrrttttttttt";
}
if($_SERVER['REQUEST_METHOD'] == "POST")
{ 
// if(isset($_POST['envoie']))
//        extract($_POST);//cest pour ne pas se mettre a reecrire $_POST['']
    
 @ $password = verifyInput(trim($_POST['password']));
      
  
@$c_password = verifyInput(trim($_POST['c_password']));
    
        if(!empty($password) && !empty($c_password))
            {
            if($password == $c_password)
                {
                    $passwordError = "Хорошо";

                  $hashpass = sha1(htmlspecialchars( $password ));
                  $db = Database::connect();
                  $sql = "UPDATE barbers SET password_ba = ? WHERE email_ba = ?";
                 $statement = $db->prepare($sql);
                  $statement -> execute(array($hashpass , $sig_email));
                Database::disconnect();
               header("Location:pays_ville_adres_ba_ru.php");
                                   
            }
                            
            else 
                {
                    $passwordError = "не хорошо";
                    $log_page = $_SERVER['PHP_SELF'];
                }

               
                                   
                }
    
                else if(empty($password) && empty($c_password))
                {
                    $passwordError = "Вы должны заполнить поля";
                    $log_page = $_SERVER['PHP_SELF'];
                }
     
 }

                                 

function verifyInput($var)
    {
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
        
        return $var ;
    }

 include "principal.php"; 

?>


<div class="container">
         <div class="row">
                  <div class="col-md-12">
                 <div class="title">
                     <h1 id="title"><img src="images/title1.png"> Barberonline <img src="images/title1.png"></h1> 
                 </div>
             </div>
                
           <div class="col-sm-12 ">
                    <div id="bar_pass_conf">
                        <h1 class="sous_titre">Регистр</h1>
                        <form action="barber_page_ru.php" method="post">
                                <div class="form-group">
                                    <label for="password">Пароль :</label>
                                    <input type="password"  class="form-control" name="password"  id="password" value="<?php echo $password;?>">
                                </div>
                                <div class="form-group">
                                    
                                    <label for="c_password">Подтверждение пароля:</label>
                                    <input type="password" class="form-control"  name="c_password" id="c_password" value="<?php echo $c_password;?>">
                                </div>
                         
                            <button class="btn btn-primary" type="submit" name="envoie"> Go</button>
                              <p><?php echo $passwordError ;?></p>
                        </form>
                      
                    </div>
            
                </div>
            
        </div>
    </div>
    
</body>