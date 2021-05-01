<?php



if(!empty($_SESSION['sig_email_ba']))
{

        $barber_email = checkInput($_SESSION['sig_email_ba']);
}

else
{
    die('ERROOORRR');
}

?>

<?php
    include 'principal.php';
?>

<?php
    foreach(get_request($barber_email) as $request)
    {
       echo $request->message ; 
    }
?>
            <div class="container">
                <div class="row one_barber">
                    <div class="col-7">
                        <strong></strong>
                    </div>
                </div>
            </div>
