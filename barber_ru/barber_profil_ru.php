<?php
session_start();

require 'database.php';
//
//if(isset($_SESSION['log_email_ba']))
//{
//     if(!empty($_SESSION['sig_email_ba']))
//{
//
//        $sig_email = checkInput($_SESSION['sig_email_ba']);
//}
//    else{
//        $_SESSION['sig_email_ba'] = $_SESSION['log_email_ba'];
//    
//    $sig_email = checkInput($_SESSION['sig_email_ba']);
//    }
//    
//    
//}



if(empty($_SESSION['sig_email_ba']))
{
   $_SESSION['sig_email_ba'] = $_SESSION['log_email_ba'];
    
    $sig_email = checkInput($_SESSION['sig_email_ba']);
}


else if(!empty($_SESSION['sig_email_ba']))
{

        $sig_email = checkInput($_SESSION['sig_email_ba']);
}

else if(!empty ($_SESSION['log_email_ba']))
 {
    $sig_email = checkInput($_SESSION['log_email_ba']);
    $_SESSION['sig_email_ba'] = checkInput($_SESSION['log_email_ba']);
}
else
{
    die("ERROOROROROROOROR session");
}




$db = Database::connect();
    $statment = $db->prepare('SELECT barbers.name_ba , barbers.first_name_ba , barbers.picture_ba , barbers.price , barbers.account_blocked , pays_ville.pays AS pays , pays_ville.ville AS ville FROM barbers LEFT JOIN pays_ville ON barbers.ville_id_ba = pays_ville.id_ville WHERE barbers.email_ba=?');
    
    $statment ->execute(array($sig_email));
    $profil = $statment ->fetch();
    Database::disconnect();

$db2 = Database::connect();
$statment = $db2->prepare('SELECT picture_1 , picture_2 , picture_3 , picture_4 , picture_5 , picture_6 FROM pic_portofolio WHERE email_ba = ? ');
    
$statment ->execute(array($sig_email));
$portofolio = $statment ->fetch();
$image_1 = $portofolio['picture_1'];
$image_2 = $portofolio['picture_2'];
$image_3 = $portofolio['picture_3'];
$image_4 = $portofolio['picture_4'];
$image_5 = $portofolio['picture_5'];
$image_6 = $portofolio['picture_6'];
Database::disconnect();

$db = Database::connect();
    $statment = $db->prepare('SELECT COUNT(*) AS numberOfRequest FROM request_notification WHERE email_ba = ? AND not_request = 3');
    
    $statment ->execute(array( $sig_email));
    $var = $statment ->fetch();
    Database::disconnect();

$db = Database::connect();
$statment = $db->prepare('SELECT COUNT(*) AS numberDue FROM theDue WHERE email_ba = ? AND status_payment = 0');
$statment->execute(array($sig_email));
$dueNum = $statment->fetch();
Database::disconnect();



 function checkInput($data)
    {
        $data = trim ($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        
    }

?>


<?php
include "principal.php";
?>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #260e04;" >
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
      <strong id="notification_request"><?php 
          
          if($var['numberOfRequest'] !=0 || $dueNum['numberDue'] != 0 ){
          echo ' !' ;    
          }
          else
          {
              echo '';
          }
          ?></strong>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="barber_profil_ru.php">Профиль<span class="sr-only">(current)</span></a>
      </li>
     
      <li class="nav-item">
        <a class="nav-link" href="list_request_ba_ru.php">Уведомление<strong id="notification_request"><?php 
          
          if($var['numberOfRequest'] !=0){
          echo ' '.$var['numberOfRequest'] ;    
          }
          else
          {
              echo '';
          }
          ?></strong></a>
      </li>
       <?php
        
        /*** For the common version ***/
      /*<li class="nav-item">
        <a class="nav-link" href="box_payment.php">Box<strong id="notification_request"><?php 
          
         if($dueNum['numberDue'] != 0){
          echo ' !';    
          }
          
          ?></strong></a>
      </li> */  ?>         
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Запрос
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
      
          <a class="dropdown-item" href="historique_request_ru.php">Исторические исследования</a>
<!--          <a class="dropdown-item" href="#">Notation</a>-->
                
        </div>
      </li>
       <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">  
                Язык
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

              <a class="dropdown-item" href="../barber_profil.php">English</a>
        <?php     // <a class="dropdown-item" href="#">Notation</a>
              ?>      
            </div>
      </li>            
      <li class="nav-item">
        <a class="nav-link" href="help_ba_ru.php">Помощь</a>
      </li>
    </ul>
  </div>
</nav>
<br>
<br>
<br>

        <div class="container"> 
            
            <div class="row cu_profil">
                <?php
//                    if($dueNum['numberDue'] != 0){
//                    
//                        echo " <div style='color:red'>
//                                     <p>!!Go to your personal box to check your due.If you pay your due and your account is still locked , report the problem with contact us!!</p>
//                               </div>
//                        ";
//                    }
                ?>
                
                  
                
                <div class="col-md-6">
                    <img src="../images/<?php echo $profil['picture_ba'] ;?>" class="img-fluid pic_porto" alt="Responsive image">
                </div>
                <div class="col-md-6 description">
                    <label for="name">Имя :<span class="label"><?php echo $profil['name_ba'] ;?></span> </label>
                    <br>
                    <label>Фамилия : <span class="label"><?php echo $profil['first_name_ba'] ;?></span> </label>
                    <br>
                    <label>Страна : <span class="label"><?php echo $profil['pays'] ;?></span></label>
                    <br>
                    <label>Город : <span class="label"><?php echo $profil['ville'];?></span> </label>
                    <br>
                    <label>Цена (RUB) :<span class="label"><?php echo $profil['price'];?></span> </label>
                    <br>
                    <a class="btn btn-primary" href="portofolio_edit_ru.php">Редактировать</a>
                     <a class="btn btn-danger" href="logout_ru.php">Выйти</a>
                </div>
                
                
                <a href="portofolio_edit_ru.php" class="col-sm-4">
                    <img src="../images/<?php echo $image_1; ?>" class="img-thumbnail pic_porto" alt="Responsive image">
                     
                </a >
                <a href="portofolio_edit_ru.php" class="col-sm-4">
                    <img src="../images/<?php echo $image_2 ; ?>" class="img-thumbnail pic_porto" alt="Responsive image">
                    
                </a >
                <a href="portofolio_edit_ru.php" class="col-sm-4">
                    <img src="../images/<?php echo $image_3 ; ?>" class="img-thumbnail pic_porto" alt="Responsive image">
                    
                </a >
                <a href="portofolio_edit_ru.php" class="col-sm-4">
                    <img src="../images/<?php echo $image_4 ; ?>" class="img-thumbnail pic_porto" alt="Responsive image">
                    
                </a >
                <a href="portofolio_edit_ru.php" class="col-sm-4">
                     <img src="../images/<?php echo $image_5 ; ?>" class="img-thumbnail pic_porto" alt="Responsive image"> 
                    
                </a >
                <a href="portofolio_edit_ru.php" class="col-sm-4">
                    <img src="../images/<?php echo $image_6 ; ?>" class="img-thumbnail pic_porto" alt="Responsive image">
                    
                </a >
<!--                <a class="btn btn-primary" href="portofolio_edit.php">Edit Portofolio</a>-->
                
                
                    
             
            </div>

        </div>


</body>