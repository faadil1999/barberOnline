<?php
session_start();

require 'database.php';
if(!empty($_SESSION['sig_email']))
{

        $sig_email = checkInput($_SESSION['sig_email']);
}
else
{
    die("error");
}

if(!empty(checkInput($_SESSION['barber_request'])))
{

        $email_ba_request = checkInput($_SESSION['barber_request']);
}

else
{
    die("error");
}

$dateError = $timeError = $adresseError = $message = "";
$date = $time = $adresse = "";
$todayTime = date("H:i");
$todayDate = date("Y-m-d");
$date_time_now = date("Y-m-d H:i:s");

if(!empty($_POST))
{
    $date       = new DateTime (checkInput($_POST['date']));
    $time       = new DateTime (checkInput($_POST['time']));
     $start_date = new DateTime($date->format('Y-m-d') .' ' .$time->format('H:i:s'));//time of post
     $end_date = new DateTime($date_time_now);//current time 
    $adresse    = checkInput($_POST['adresse_cu']);
    $isSuccess = true;
    if($end_date->format('Y-m-d ') == $start_date->format('Y-m-d'))
    {
      $isSuccess = true;  
    }
    if(empty($date))
    {
        $dateError = "The date is empty";
        $isSuccess = false;
    }
    
    if(empty($time))
    {
        $timeError = "The time is empty";
        $isSuccess = false;
    }
  
    
    if(empty($adresse))
    {
        $adresseError = "The adress is empty";
        $isSuccess = false;
    }
    
                       
     if($end_date->format('Y-m-d') > $start_date->format('Y-m-d'))
     {
         
         $dateError = "Put correct date";
        $isSuccess = false;
     }
               
    if($end_date->format('H:i') >= $start_date->format('H:i')  && $end_date->format('H:i') >= $start_date->format('H:i'))
                {
                        $timeError = "Put correct time";
                        $isSuccess = false;
                 }                  
                    
      if($end_date->format('Y-m-d ') < $start_date->format('Y-m-d') && $end_date->format('H:i') > $start_date->format('H:i') )
    {
      $isSuccess = true;  
    }
    
    
    if($isSuccess)
    {
//        $db = Database::connect();
//    $statment = $db->prepare('SELECT customers.name_cu , customers.first_name_cu ,customers.ville_id_cu , customers.tel_cu, customers.picture_cu , pays_ville.pays AS pays , pays_ville.ville AS ville FROM customers LEFT JOIN pays_ville ON customers.ville_id_cu = pays_ville.id_ville WHERE customers.email_cu=?');
//    
//    @$statment ->execute(array($sig_email));
//    $profil = $statment ->fetch();
//    $name = $profil['name_cu'];
//    $firstname = $profil['first_name_cu'];
//    $ville = $profil['ville'];
//    $tel = $profil['tel_cu'];
//    $image = $profil['picture_cu'];
//    $id_ville = $profil['ville_id_cu'];
//    
//    Database::disconnect();
// $db = Database::connect();
//    $statment = $db->prepare('SELECT barbers.name_ba FROM barbers WHERE barbers.email_ba=?');
//    
//    @$statment ->execute(array($email_ba_request));
//    $profil = $statment ->fetch();
//    $name_ba = $profil['name_ba'];
//    Database::disconnect();    
//        
//     /** lenvoie du mail au barber debut**/
//        $emailTo =  $email_ba_request ;
//      
//
//        
//        $headers = "Content-type: text/html; charset=UTF-8";
//          $headers.= "From company of barber online for customer ".$name." ".$firstname." .";
//
//        
//        $subject= "Request";
//    /** fin **/
//        
//        $message = '
//                    You have received a request from <strong>'.$name.'</strong> by <strong>'.$date->format('Y-m-d').'</strong> at <strong>'.$time->format('H:i:s'). '</strong> at the adress : <strong>' .$adresse.'</strong> in <strong>'.$ville.'</strong>
//                 ';
//        
//        $messageForMail = '
//        <html>
//            <body>
//                <div>
//                    You have received a request from <strong>'.$name.'</strong> by <strong>'.$date->format('Y-m-d').'</strong> at <strong>'.$time->format('H:i:s'). '</strong> at the adress : <strong>' .$adresse.'</strong> in <strong>'.$ville.'</strong>
//                    <a href="barberrussie.000webhostapp.com/index.php">Click here to connect to Barber online.....</a>
//                </div> 
//             </body>
//        </html>"' ;  
//        
//       
//        mail($emailTo , $subject , $messageForMail , $headers );
//        $message_cu = 'You send a request to '.$name_ba.' for '.$date->format('Y-m-d').' at '.$time->format('H:i:s').' at the adress : <strong>'.$adresse.'</strong> in <strong>'.$ville.' </strong> (request sent at : '.$todayTime.' the '.$todayDate.' )'.date_default_timezone_get().'.';
//        
//        $db = Database::connect();
//        $sql = "INSERT INTO request_notification(email_cu, email_ba, date_request, time_request, adress , not_request , message_request , message_request_cu) VALUES ( ? , ? , ? , ? , ? , 3 , ? , ?)";
//        $statement = $db->prepare($sql);
//        $statement ->execute(array($sig_email , $email_ba_request , $date->format('Y-m-d') , $time->format('H:i:s') , $adresse , $message , $message_cu));
//        Database::disconnect();
//        
//        $db = Database::connect();
//        $statement = $db->prepare('UPDATE customers set request_statut = 1  WHERE email_cu = ?');
//        $statement ->execute(array($sig_email )) ; 
//         Database::disconnect();
//       header("Location:list_barber.php?page=filter_by_city");
        
        include 'send_request.php';
    }
}


function checkInput($data)
    {
        $data = trim ($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        
    }

$db = Database::connect();
    $statment = $db->prepare('SELECT customers.ville_id_cu FROM customers  WHERE customers.email_cu=?');
    
    @$statment ->execute(array($sig_email));
    $profil = $statment ->fetch();
    $id_ville = $profil['ville_id_cu'];
    
    Database::disconnect();
?>

<?php
include 'principal.php';
?>


 <div class="container"> 
            
            <div class="row cu_request ">
                <div class="col-sm-12 ">
                    <form  class="form" role="form"  method="post" action="request_form.php" enctype="multipart/form-data">
                     <div class="form-group">
                        <label for="date">Date :</label>
                        <input name="date" type="date" id="date" class="form-control" value = "<?php echo $todayDate; ?>">
                         <p class="error"><?php
                                 echo $dateError;
                           
                             ?>
                         </p>
                       </div>    

                       <div class="form-group">
                         <label for="time">Time :</label>
                         <input name ="time" type ="time" id = "time" class = "form-control" value = "<?php echo $todayTime; ?>" >   
                         <p class="error"><?php echo $timeError; ?></p>      
                       </div>
                       <div class="form-group">
                           <label for="country">Country :</label>
                           <select name="country" class="form-control"> 
                                <?php
                                        $db = Database :: connect();
                                        foreach($db->query('SELECT DISTINCT pays FROM pays_ville') as $row )
                                        {
                                            echo '<option value = "'. $row['pays'] . '">' . $row['pays'] . '</option>';

                                        }
                                        Database::disconnect();
                                    ?>
                           </select>
                             
                       </div> 

                       <div class="form-group">
                            <label for="city">City :</label>
                            <select name="city" id="city" class="form-control">
                                <?php
                                        $db = Database :: connect();
                                        foreach($db->query('SELECT * FROM pays_ville') as $row )
                                        {
                                            if($row['id_ville'] == $id_ville)
                                            {
                                                echo '<option selected = "selected" value = "'. $row['id_ville'] . '">' . $row['ville'] . '</option>';
                                            }

                                            else
                                            {
                                                echo '<option value = "'. $row['id_ville'] . '">' . $row['ville'] . '</option>';
                                            }

                                        }
                                        Database::disconnect();

                                    ?>
                                
                           </select>
                            <p></p>
                           
                       </div>
                       <div class="form-group">
                        <label>Adress :</label>
                           <input type="text" name="adresse_cu" id="adresse_cu" value="<?php echo $adresse ;?>" class="form-control">
                           <p class="error"><?php echo $adresseError; ?></p>
                       </div>
                        
                            
                      <p>(*If you launch a request you will not be able to make another one. You will have to cancel the current one*)</p>
                      
                       <button type="submit" class="btn btn-success">Send</button>
                       <a href="view_barber_profil.php?email_ba=<?php echo $_GET['email_ba'] ;?>" class="btn btn-danger barb_list">Retour</a>
                   </form>
        </div>
       </div>
     </div>