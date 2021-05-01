<?php

    if(!empty(verifyInput($_SESSION['ville_customer'])))
    {
        $city = $_SESSION['ville_customer']; 
    }
    
    else
    {   session_destroy();
        header("Location:index.php");
    }

function verifyInput($var)
    {
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
        
        return $var ;
    }
       
//
//get_barbers_by_city($city);

  
        foreach(get_barbers_by_city($city) as $barber){
        

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
                        <span><?php echo $barber->ville ." "; ?></span>
                            <br/>
                           
                            <a class="select" href="view_barber_profil.php?email_ba=<?php 
                                echo $barber->email_ba;
                            ?>">
                            <i class="fas fa-cut"></i>
                            </a>
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
    
    echo "NOOOOOTTT FOOUUNNNDDD";
          
 }
?>
