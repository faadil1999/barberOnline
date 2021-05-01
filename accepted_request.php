<?php

  session_start();

require 'database.php';

if(!empty($_SESSION['sig_email_ba']))
{

        $email_barber = checkInput($_SESSION['sig_email_ba']);
}

else
{
    die('ERROOORRR');
}
if(!empty($_SESSION['email_customer']))
{

        $email_customer = checkInput($_SESSION['email_customer']);
}

else
{
    die('ERROOORRR');
}

$db = Database::connect();
    $statment = $db->prepare('SELECT customers.name_cu , customers.first_name_cu ,customers.ville_id_cu , customers.tel_cu, customers.picture_cu , pays_ville.pays AS pays , pays_ville.ville AS ville FROM customers LEFT JOIN pays_ville ON customers.ville_id_cu = pays_ville.id_ville WHERE customers.email_cu=?');
    
    @$statment ->execute(array($email_customer));
    $profil = $statment ->fetch();
    $name = $profil['name_cu'];
    $firstname = $profil['first_name_cu'];
    $ville = $profil['ville'];
    $tel = $profil['tel_cu'];
    $image = $profil['picture_cu'];
    $id_ville = $profil['ville_id_cu'];
    
    Database::disconnect();


$db   = Database::connect();

$sql = "UPDATE request_notification set not_request = 1 WHERE email_ba = ? AND email_cu = ? AND not_request = 3";

$statment = $db->prepare($sql);
$statment->execute(array($email_barber , $email_customer));
Database::disconnect();

 $db = Database::connect();
    $statment = $db->prepare('SELECT barbers.name_ba , request_notification.date_request AS date , request_notification.adress , request_notification.time_request AS time FROM barbers LEFT JOIN request_notification ON barbers.email_ba = request_notification.email_ba WHERE request_notification.email_ba=? AND request_notification.email_cu=? AND request_notification.not_request = 1 ');
    
    @$statment ->execute(array($email_barber , $email_customer));
    $profil = $statment ->fetch();
    $name_ba = $profil['name_ba'];
    $date = $profil['date'];
    $time = $profil['time'];
    $adresse = $profil['adress'];
    Database::disconnect();   


$emailTo =  $email_customer ;
       
        $headers = "Content-type: text/html; charset=UTF-8";
         

         $messageForMail  = 'Your request to the Barber '.$name_ba.' for '.$date.' at '.$time.' at the adress : <strong>'.$adresse.'</strong> in <strong>'.$ville.' </strong> is <strong>ACCECPTED</strong>.';
        
        $subject= "Request";

 mail($emailTo , $subject , $messageForMail , $headers );


$db   = Database::connect();

$sql = "UPDATE customers set request_statut = 3 WHERE email_cu = ?";

$statment = $db->prepare($sql);
$statment->execute(array($email_customer));
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
    include 'principal.php';
?>
<script>
    alert('The telephone number of customer is <?php echo $tel ;?>.Go to the historique ..');
</script>
<a class="text-success" href="list_request_ba.php">Accepted Click here ...</a>

