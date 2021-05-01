<?php




if(!empty($_SESSION['sig_email'] ))
{

        $email_customer = checkInput( $_SESSION['sig_email'] );
}

else
{
    die('ERROOORRR');
}


if(!empty(checkInput($_SESSION['barber_request'])))
{

        $email_ba_request = checkInput($_SESSION['barber_request']);
}

else
{
    $db   = Database::connect();

$sql = "SELECT request_notification.email_ba WHERE request_notification.email_cu = ? AND not_request = 1";

$statment = $db->prepare($sql);
$statment->execute(array($email_customer));
$barber = $statment ->fetch();
$email_ba_request =  $barber['email_ba'];   
Database::disconnect();

}

$db   = Database::connect();

$sql = "UPDATE customers set request_statut = 0 WHERE email_cu = ?";

$statment = $db->prepare($sql);
$statment->execute(array($email_customer));
Database::disconnect();

$db   = Database::connect();
 $statment = $db->prepare('SELECT name_cu , first_name_cu FROM customers WHERE email_cu = ? ');

$statment->execute(array($email_customer));
$customer =  $statment ->fetch();
Database::disconnect();

$db   = Database::connect();

$sql = "UPDATE request_notification set not_request = 2 WHERE email_ba = ? AND email_cu = ? AND not_request = 1";

$statment = $db->prepare($sql);
$statment->execute(array($email_ba_request , $email_customer));
Database::disconnect();

$message_description = "After styling the client ".$customer['name_cu']." ".$customer['first_name_cu']." you have to pay 2 RUB to our company by sberbank through this number 89116319487";
/*******************************************FOR THE COMMING VERSION OF BARBERONLINE*******************************************/
/*$db   = Database::connect();
$sql = "INSERT INTO theDue(email_ba,due,description_message) VALUES(?,?,?)";
$statment=$db->prepare($sql);
$statment->execute(array($email_ba_request,2,$message_description));
Database::disconnect();
*/

       
function checkInput($data)
    {
        $data = trim ($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        
    }

?><?php
include "principal.php";
?>
<a class="text-success" href="list_barber.php?page=filter_by_city">Completed Click here ...</a>