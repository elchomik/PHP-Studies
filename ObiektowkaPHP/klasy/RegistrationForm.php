<?php

class RegistrationForm {
    
    protected User $user;
    
    function __construct() { ?>

<h3>Formularz rejestracji</h3><p>
<form action="index.php" method="post">
    Nazwa użytkownika: <br/><input name="userName"/><br/>
    Imię i nazwisko: <br/><input name="fullName"/><br/>
    Hasło:<br/><input name="passwd"/><br/>
    Email:<br/><input name="email"/><br/>
    <input type="submit" name="submit" value="Rejestruj"/>
    <input type="submit" name="submit" value="Anuluj"/>
    <input type="submit" name="submit" value="Pokaz"/>
    
</form>
</p>
       
    <?php
    }
    
    function checkUser(){
        $args=array(
             'userName'=>['filter'=>FILTER_VALIDATE_REGEXP,'options'=>['regexp'=>'/^[A-Z]{1}[a-ząęłńśćźżó-]{1,25}$/']],
                  'fullName'=>['filter'=>FILTER_VALIDATE_REGEXP,'options'=>['regexp'=>'/^[A-Z]{1}[a-ząęłńśćźżó]{1,14}$/']], 
                  'passwd'=>['filter'=>FILTER_VALIDATE_REGEXP,'options'=>['regexp'=>'/[a-z][0-9]{1,25}$/']],
                  'email'=>['filter' => FILTER_SANITIZE_EMAIL, 'flags' => FILTER_VALIDATE_EMAIL]);
                  
   
             
        
        $dane= filter_input_array(INPUT_POST,$args);
         // var_dump($dane);
          
          $errors="";
          foreach($dane as $key=>$val){
              if($val===false or $val===NULL){
                  $errors.=$key." ";
              }
          }
        //sprawdź czy są błędy
        if($errors === ""){
            
            $this->user=new User($dane['userName'],$dane['fullName'],
                    $dane['email'],$dane['passwd']);
        }
        else{
            echo "<p>Błędne dane:".$errors."</p>";
          //  $this->user=NULL;
        }
        return $this->user;
    }

}
