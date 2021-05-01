<!DOCTYPE html>
<html>
    <head>
        <title>Связаться с нами</title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <script src="https://unpkg.com/popper.js"></script>"
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>   
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://kit.fontawesome.com/04ae5226bd.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="CSS/style2.css"/> 
        <meta charset="utf-8">
        <script src="Js/scriptContactUs.js"></script>
    </head>



    <body>
        <div class="container">
            <a href="<?php echo $_SERVER["HTTP_REFERER"];?>"><i class="fas fa-long-arrow-alt-left"></i> Вернитесь назад</a>
            <div class="divider"></div>
            <div class="heading">
                <h2>Связаться с нами</h2>
            </div>
            
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <form id="contact-form" method="post" action="" role="form">
                        <div class="row">
                            
                            <div class="col-md-6">
                                <label for="firstname">Имя <span class="blue"> *</span></label>
                                <input type="text" id="firstname"  name="firstname" class="form-control" placeholder="Ваше имя" 
                                       value = ""/>
                                <p class="comments"></p>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="name">Фамилия<span class="blue"> *</span></label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Ваше фамилия" value = ""/>
                                <p class="comments"></p>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="email">Эл. адрес<span class="blue"> *</span></label>
                                <input type="text"  id="email" name="email" class="form-control" placeholder="Эл. адрес" value = ""/>
                                <p class="comments"></p>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="phone">Телефон</label>
                                <input type="tel" id="phone" name="phone" class="form-control" placeholder="Телефон" value = ""/>
                                <p class="comments"></p>
                            </div>
                            
                            <div class="col-md-12">
                                <label for="message">Сообщение<span class="blue"> *</span></label>
                                <textarea id="message" name="message" class="form-control" placeholder="Ваше сообщение" rows="4" value = ""></textarea>
                                <p class="commentS"></p>
                               
                                
                            </div>
                            
                            <div class="col-md-12">
                                <p class="blue"><strong>*Эта информация обязательна</strong></p>
                            </div>  
                            <div class="col-md-12" >
                                <input type="submit" class="button1" value="Послать">
                            </div>  
                        </div>
                        

                
                    </form>
                </div>
            </div>
            <!--le "offset-1" cest pour laisser un espace entre le formulaire et le background-->
        </div>
        
        
    </body>

</html>