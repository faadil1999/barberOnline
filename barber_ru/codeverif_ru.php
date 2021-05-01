<?php
session_start();

require 'database.php';

$_code=0;
$_codeError="";


if(empty($_SESSION['emailCode']))
{
    die("ERROOORR");
}

if(empty($_SESSION['_code']))
{
    die("ERROOORR");
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $_code = verifyInput($_POST['_code']);
    $isSuccess = true;
    if(empty($_code))
    {
        $_codeError = "Поместите код";
        $isSuccess = false;
        
    }
    if($_code != $_SESSION['_code'])
    {
          $_codeError = "Неверный код";
        $isSuccess = false;
    }
    
    if($isSuccess == true)
    {
       
        header('Location:changepsw_ba_ru.php');
    }
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


    <div class = "container-fluid"> 
        
       <div class="row" id="cu_profil">
             <div class="col-md-12">
                 <div class="title">
                     <h1 id="title"><img src="images/title1.png"> Barberonline <img src="images/title1.png"></h1> 
                 </div>
             </div>
         <div id="bar_pass_conf">    
            <form class="form" role="form"  method="post" action="codeverif_ru.php">
                 <div class="form-group">
                        <label for="email">Код :</label>
                        <input type="text"  class="form-control" name="_code"  id="email" >
                        <p  class="comments" ><?php echo $_codeError;?></p>
                </div>
                <button type="submit" class="btn btn-success">Ok</button>
           </form>
        
        </div>
    </div>
            
    </div>