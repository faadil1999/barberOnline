<?php
session_start();

require 'database.php';


if(!empty(checkInput($_GET['email_ba']))  && !empty(checkInput($_SESSION['sig_email'])))
{

        $sig_email = checkInput($_GET['email_ba']);
        
}

else
{
    die('Fatality');
    
}

if( check_user_exist(checkInput($_GET['email_ba'])) == 0)
{
    die('TU nes quun petit tricheur');
}

$_SESSION['barber_request'] = checkInput($_GET['email_ba']);



$db = Database::connect();
    $statment = $db->prepare('SELECT barbers.name_ba , barbers.first_name_ba , barbers.picture_ba , barbers.price , pays_ville.pays AS pays , pays_ville.ville AS ville FROM barbers LEFT JOIN pays_ville ON barbers.ville_id_ba = pays_ville.id_ville WHERE barbers.email_ba=?');
    
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
$images = array($image_1 , $image_2 , $image_3 , $image_4 , $image_5 , $image_6);

for($i = 0 ; $i<count($images) ; $i++)
{
    if($images[$i] == "add-image.png")
    {
        $images[$i] = "";
    }
}
Database::disconnect();

 function checkInput($data)
    {
        $data = trim ($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        
    }

function check_user_exist($email)
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
            
            <div class="row cu_profil">
                <div class="col-md-6">
                    <img src="images/<?php echo $profil['picture_ba'] ;?>" class="img-fluid" alt="Responsive image">
                </div>
                <div class="col-md-6 description">
                    <label for="name">Name :<span class="label"><?php echo $profil['name_ba'] ;?></span> </label>
                    <br>
                    <label>First name : <span class="label"><?php echo $profil['first_name_ba'] ;?></span> </label>
                    <br>
                    <label>Country : <span class="label"><?php echo $profil['pays'] ;?></span></label>
                    <br>
                    <label>City : <span class="label"><?php echo $profil['ville'];?></span> </label>
                    <br>
                    <label>Price (RUB) :<span class="label"><?php echo $profil['price'];?></span> </label>
                    <br>
                    
                </div>
                
                    
                <div class="col-sm-4">
                    <a href=""></a><img src="images/<?php  echo $images[0];?>" class="img-thumbnail pic_porto" alt="Empty">
                     
                </div>
                <div class="col-sm-4">
                    <img src="images/<?php  echo $images[1];?>"
                         class="img-thumbnail pic_porto" alt="Empty">
                    
                </div>
                <div class="col-sm-4">
                    <img src="images/<?php  echo $images[2];?>" class="img-thumbnail pic_porto" alt="Empty">
                    
                </div>
                <div class="col-sm-4">
                    <img src="images/<?php  echo $images[3];?>" class="img-thumbnail pic_porto" alt="Empty">
                    
                </div>
                <div class="col-sm-4">
                     <img src="images/<?php  echo $images[4];?>" class="img-thumbnail pic_porto" alt="Empty"> 
                    
                </div>
                <div class="col-sm-4">
                    <img src="images/<?php  echo $images[5];?>" class="img-thumbnail pic_porto" alt="Empty">
                </div>
                
                <div class="col-sm-6">
                    <a href="list_barber.php?page=filter_by_city" class="btn btn-danger barb_list">Retour</a>
                 
                </div>
                 <div class="col-sm-6">
                   <a href="request_form.php?email_ba=<?php echo $sig_email;?>" class="btn btn-primary barb_list" >Send Request</a>
                </div>
                       
                 
            </div>

        </div>


</body>