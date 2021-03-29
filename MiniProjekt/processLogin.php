<?php

include_once 'klasy/Baza.php';
include_once 'klasy/User.php';
include_once 'klasy/UserManager.php';

$db=new Baza("localhost","root","M!m?1999","klienci");
$um=new UserManager();

if(filter_input(INPUT_GET, "akcja")=="wyloguj"){
    $um->logout($db);
}

//kliknięto przycisk submit z name=zaloguj

if(filter_input(INPUT_POST,"zaloguj")){
    $userId=$um->login($db); //sprawdź parametry logowania
  
    if($userId>0){
      header("location:zalogowani.php");
               
    }
    else{
        echo "<p>Błędna nazwa użytkownika lub hasło</p>";
        $um->loginForm(); //pokaż formularz logowania
    }
    
}
else {
    $um->loginForm();
   

}
