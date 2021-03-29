<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            include 'klasy/User.php';
            include_once('klasy/RegistrationForm.php');
            include 'klasy/Baza.php';
            $rf=new RegistrationForm(); //wyświetla formularz rejestracji
            $db=new Baza('localhost','root','M!m?1999','klienci');
            if(filter_input(INPUT_POST,"submit",FILTER_SANITIZE_FULL_SPECIAL_CHARS)){
                
                $user1=$rf->checkUser(); //sprawdza poprawność danych
        
                if($user1===NULL)
                    echo "<p>Niepoprawne dane </p>";
                else{
                $akcja= filter_input(INPUT_POST,"submit");
                switch($akcja){
                    case "Rejestruj":$user1->saveDB($db);break;
                    
                }
                User::getAllUserFromDB($db);
                }
            }
     
         
        ?>
    </body>
</html>
