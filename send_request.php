<?php


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


$db = Database::connect();
    $statment = $db->prepare('SELECT customers.name_cu , customers.first_name_cu ,customers.ville_id_cu , customers.tel_cu, customers.picture_cu , pays_ville.pays AS pays , pays_ville.ville AS ville FROM customers LEFT JOIN pays_ville ON customers.ville_id_cu = pays_ville.id_ville WHERE customers.email_cu=?');
    
    @$statment ->execute(array($sig_email));
    $profil = $statment ->fetch();
    $name = $profil['name_cu'];
    $firstname = $profil['first_name_cu'];
    $ville = $profil['ville'];
    $tel = $profil['tel_cu'];
    $image = $profil['picture_cu'];
    $id_ville = $profil['ville_id_cu'];
    
    Database::disconnect();
 $db = Database::connect();
    $statment = $db->prepare('SELECT barbers.name_ba FROM barbers WHERE barbers.email_ba=?');
    
    @$statment ->execute(array($email_ba_request));
    $profil = $statment ->fetch();
    $name_ba = $profil['name_ba'];
    Database::disconnect();    
        
     /** lenvoie du mail au barber debut**/
        $emailTo =  $email_ba_request ;
      

        
        $headers = "Content-type: text/html; charset=UTF-8";
      

        
        $subject= "Request";
    /** fin **/
        
        $message = '
                    You have received a request from <strong>'.$name.'</strong> by <strong>'.$date->format('Y-m-d').'</strong> at <strong>'.$time->format('H:i:s'). '</strong> at the adress : <strong>' .$adresse.'</strong> in <strong>'.$ville.'</strong>
                 ';
        
        $messageForMail = '
        <html>
            <body>
                <div>
                    You have received a request from <strong>'.$name.'</strong> by <strong>'.$date->format('Y-m-d').'</strong> at <strong>'.$time->format('H:i:s'). '</strong> at the adress : <strong>' .$adresse.'</strong> in <strong>'.$ville.'</strong>
                    <a href="barberonline.site/index.php">Click here to connect to Barber online.....</a>
                </div> 
             </body>
        </html>"' ;  
        
       
        mail($emailTo , $subject , $messageForMail , $headers );
        $message_cu = 'You send a request to '.$name_ba.' for '.$date->format('Y-m-d').' at '.$time->format('H:i:s').' at the adress : <strong>'.$adresse.'</strong> in <strong>'.$ville.' </strong> (request sent at : '.$todayTime.' the '.$todayDate.' )'.date_default_timezone_get().'.';
        
        $db = Database::connect();
        $sql = "INSERT INTO request_notification(email_cu, email_ba, date_request, time_request, adress , not_request , message_request , message_request_cu) VALUES ( ? , ? , ? , ? , ? , 3 , ? , ?)";
        $statement = $db->prepare($sql);
        $statement ->execute(array($sig_email , $email_ba_request , $date->format('Y-m-d') , $time->format('H:i:s') , $adresse , $message , $message_cu));
        Database::disconnect();
        
        $db = Database::connect();
        $statement = $db->prepare('UPDATE customers set request_statut = 1  WHERE email_cu = ?');
        $statement ->execute(array($sig_email )) ; 
         Database::disconnect();
       header("Location:list_barber.php?page=filter_by_city");



?>



