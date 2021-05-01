<?php

$array = array("firstname"=>  "" ,"name"=> "" , "email"=> "" , "phone"=> "" , "message"=> "" , "firstnameError"=> "" , "nameError"=> "" , "emailError"=> "" , "phoneError"=> "" , "messageError"=> "" ,"isSuccess"=> false);

$emailTo = "ftorou2@gmail.com";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $array["firstname"] = verifyInput($_POST["firstname"]);
    $array["name"]  = verifyInput($_POST["name"]);
    $array["email"]  = verifyInput($_POST["email"]);
    $array["phone"]  = verifyInput($_POST["phone"]);
   $array["message"]  = verifyInput($_POST["message"]);
    $array["isSuccess"]  = true;
    $emailText = "";
    
    
    if(empty($array["firstname"] ))
    {
        $array["firstnameError"]  = "I want to know your first name !";
       $array["isSuccess"]  = false ;
    }
    else 
    {
        $emailText .= "FirstName: ".$array["firstname"]."  <br>";
    }
    if(empty($array["name"] ))
    {
        $array["nameError"]  = "I want to know name !";
        $array["isSuccess"]  = false ;
    }
     else 
    {
        $emailText .= "Name: ".$array["name"]."<br>";
    }
    if(!isEmail($array["email"] ))
    {
        $array["emailError"]  = "Give a real email dude !";
        $array["isSuccess"]  = false ;
    }
     else 
    {
        $emailText .= "Email: " .$array["email"]." <br>";
    }

    if(!isPhone($array["phone"] ))
    {
        $array["phoneError"]  ="Only numbers and letters please !";
        $array["isSuccess"]  = false ;
    }
     else 
    {
        $emailText .= "Phone:".$array["phone"]."<br>";
    }
     if(empty($array["message"] ))
    {
        $array["messageError"]  = "Champion tu veux dire quoi?";
         $array["isSuccess"] = false ;
    }
     else 
    {
        $emailText .= "Message:".$array["message"]." <br>";
    }
    
    if($array["isSuccess"])   
    {   
        $array["messageError"]="message sent";
        $headers = "Content-type: text/html; charset=UTF-8";
        $headers .="From : {$array["firstname"] } {$array["name"] } <{$array["email"]}> \r\n Reply-To :{$array["email"]}";
        mail($emailTo , "A message from your site" , $emailText, $headers);
            
    }
    
       
    
    echo json_encode($array);
    
}

function isEmail($var)
{
    return filter_var($var , FILTER_VALIDATE_EMAIL);//cest une fonction boolenne qui nous permet de voir si nous avons un vrai email
}

function isPhone($var)
{
    return preg_match("/^[0-9 ]*$/" , $var);
    
}
    
function verifyInput($var)
{
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}

?>

