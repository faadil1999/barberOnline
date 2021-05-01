<?php

    if(!empty(verifyInput($_SESSION['ville_customer'])))
    {
        $city = $_SESSION['ville_customer']; 
    }
    
    else
    {   session_destroy();
        header("Location:index.php");
    }


if(!empty(verifyInput($_SESSION['sig_email'])))
{
    $customer_email = verifyInput($_SESSION['sig_email']);   
    
}
else
{
    session_destroy();
        header("Location:index.php");
}

   
function verifyInput($var)
    {
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
        
        return $var ;
    }
 
$db = Database::connect();
    $statment = $db->prepare('SELECT request_statut FROM customers WHERE email_cu = ?');
    
    $statment ->execute(array($customer_email));
    $customer = $statment ->fetch();
    Database::disconnect();


//
//get_barbers_by_city($city);

  
        foreach(get_barbers_by_city($city) as $barber){
        

                    ?>
               
            <div class="container">
                    <div class="row one_barber">
                    <div class="col-7">
                            <strong><?php echo $barber->name_ba ; ?></strong>
                            <br/>
                        
                            <span><?php echo $barber->first_name_ba ; ?></span>
                            <br/>
                            <span><?php echo $barber->price ." "; ?>(RUB)</span>
                            <br/>
                        <span><?php echo $barber->ville ." "; ?>
                        
                        </span>
                            <br/>
                        
                        <?php
                        if($customer['request_statut'] == 0)
                        {
                            
                      
                        ?>
                            <a class="select" href="view_barber_profil.php?email_ba=<?php 
                                echo $barber->email_ba;
                            ?>">
                            <i class="fas fa-cut"></i>
                            </a>
                    
                       <?php
                        
                        }
                    else if($customer['request_statut'] == 1){
            
                        ?>
                        <p class="request_encour">(* You have already a request *) </p>
                    <?php
                    }
                else if($customer['request_statut'] == 3){
            
                        ?><script>
                              function verificationComplet()
                                {
                                if( confirm("Did you get your hair done ? ") )
                                    {
                                    alert("Good!!");
                                      document.location.href="list_barber.php?page=completed_request";
                                      
                                    }
                                    else{

                                       window.location.reload();
                                    }
                                }
                            </script>
                        <p class="request_acceptation" >(* Your request is accepted.*)Press <a class="btn btn-success complet" onclick="verificationComplet();">Complete</a> if the barber finish </p>
                    <?php
                    }
                        ?>
                        
                    </div>
                    <div class="col-5">
                        <img src="images/<?php echo $barber->picture_ba ;?>" class="img-fluid picture_ba" alt="Responsive image">
                    </div>
                    
                </div>
                    <br>
            </div>
                
                    <?php


        }
if(empty($barber->name_ba) && empty($barber->first_name_ba) && empty($barber->price) && empty($barber->picture_ba)  )
    {
        foreach(get_barbers() as $barber){
        

//         $_SESSION['sig_email_ba_2'] = $_SESSION['sig_email_ba'];  
//       @ $_SESSION['sig_email_ba'] = $barber->email_ba;
                    ?>
               
            <div class="container">
                    <div class="row one_barber">
                     <div class="col-7">
                            <strong><?php echo $barber->name_ba ; ?></strong>
                            <br/>
                        
                            <span><?php echo $barber->first_name_ba ; ?></span>
                            <br/>
                            <span><?php echo $barber->price ." "; ?>(RUB)</span>
                            <br/>
                        <span><?php echo $barber->ville ." "; ?>
                        
                        </span>
                            <br/>
                        
                        <?php
                        if($customer['request_statut'] == 0)
                        {
                            
                      
                        ?>
                            <a class="select" href="view_barber_profil.php?email_ba=<?php 
                                echo $barber->email_ba;
                            ?>">
                            <i class="fas fa-cut"></i>
                            </a>
                    
                       <?php
                        
                        }
                    else if($customer['request_statut'] == 1){
            
                        ?>
                        <p class="request_encour">(* You have already a request *) </p>
                    <?php
                    }
                else if($customer['request_statut'] == 3){
            
                        ?>
                         <script>
                              function verificationComplet()
                                {
                                if( confirm("Did you get your hair done ? ") )
                                    {
                                    alert("Good!!");
                                      document.location.href="list_barber.php?page=completed_request";
                                      
                                    }
                                    else{

                                       window.location.reload();
                                    }
                                }
                            </script>
                        <p class="request_acceptation" >(* Your request is accepted.*)Press <a class="btn btn-success complet" href="list_barber.php?page=completed_request">complete</a> if the barber finish </p>
                    <?php
                    }
                        ?>
                        
                    </div>
                    <div class="col-5">
                        <img src="images/<?php echo $barber->picture_ba ;?>" class="img-fluid picture_ba" alt="Responsive image">
                    </div>
                    
                </div>
                    <br>
            </div>
                
                    <?php


        }
 }

else
{
    foreach(get_barbers_another_city($city) as $barber){
        

//         $_SESSION['sig_email_ba_2'] = $_SESSION['sig_email_ba'];  
//       @ $_SESSION['sig_email_ba'] = $barber->email_ba;
                    ?>
               
            <div class="container">
                    <div class="row one_barber">
                     <div class="col-7">
                            <strong><?php echo $barber->name_ba ; ?></strong>
                            <br/>
                        
                            <span><?php echo $barber->first_name_ba ; ?></span>
                            <br/>
                            <span><?php echo $barber->price ." "; ?>(RUB)</span>
                            <br/>
                        <span><?php echo $barber->ville ." "; ?>
                        
                        </span>
                            <br/>
                        
                        <?php
                        if($customer['request_statut'] == 0)
                        {
                            
                      
                        ?>
                            <a class="select" href="view_barber_profil.php?email_ba=<?php 
                                echo $barber->email_ba;
                            ?>">
                            <i class="fas fa-cut"></i>
                            </a>
                    
                       <?php
                        
                        }
                    else if($customer['request_statut'] == 1){
            
                        ?>
                        <p class="request_encour">(* You have already a request *) </p>
                    <?php
                    }
                else if($customer['request_statut'] == 3){
            
                        ?>
                         <script>
                              function verificationComplet()
                                {
                                if( confirm("Did you get your hair done ? ") )
                                    {
                                    alert("Good!!");
                                      document.location.href="list_barber.php?page=completed_request";
                                      
                                    }
                                    else{

                                       window.location.reload();
                                    }
                                }
                            </script>
                        <p class="request_acceptation" >(* Your request is accepted.*)Press <a class="btn btn-success complet" href="list_barber.php?page=completed_request">complete</a> if the barber finish </p>
                    <?php
                    }
                        ?>
                        
                    </div>
                    <div class="col-5">
                        <img src="images/<?php echo $barber->picture_ba ;?>" class="img-fluid picture_ba" alt="Responsive image">
                    </div>
                    
                </div>
                    <br>
            </div>
                
                    <?php


        }
     
    
}
?>

   
   








 