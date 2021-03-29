<?php

// pomocnicza funkcja generująca formularz

function drukuj_form(){
    $form='<h3>Formularz zamówienia:</h3>'.
            '<form method="post" action="?strona=formularz">'.
            '<label for="nazwisko">Nazwisko:</label>'.
            '<input type="text" name="nazwisko"/><br/>'.
            '<label for="wiek">Wiek:</label>'.
            '<input type="text" name="wiek"/><br/>'.
            '<label for="panstwo">Panstwo:</label>'.
            '<select name="panstwo">'.
            '<option>Polska</option>'.
            '<option>Wielka Brytania</option>'.
            '<option>Niemcy</option>'.
            '</select><br>'.
            '<label for="email">Email:</label>'.
            '<input type="text" name="email"/><br>'.
            '<h2>Zamawiam tutorial z języka</h2><br>'.
            '<input type="checkbox" name="tech" value="PHP"/>PHP<br/>'.
            '<input type="checkbox" name="tech" value="Java"/>Java<br/>'.
            '<input type="checkbox" name="tech" value="CPP"/>C++<br/>'.
            '<h2>Sposób zapłaty</h2>'.
            '<input type="radio" name="karta" value="eurocard"/>eurocard<br/>'.
            '<input type="radio" name="karta" value="visa"/>visa<br/>'.
            '<input type="radio" name="karta" value="przelew"/>przelew<br/>'.
            '<input type="submit" name="Dodaj" value="Dodaj"/>'.
            '<input type="submit" name="Pokaz" value="Pokaz"/>'.
            '<input type="submit" name="Java" value="Java"/>'.
            '<input type="submit" value="PHP"/>'.
            '<input type="submit" value="C++"/>'.
            '</form>';
    
       return $form; 
            
    
}



include_once "klasy/Baza.php";
$db=new Baza("localhost","root","M!m?1999","klienci");
$tytul="Formularz";
$zawartosc=drukuj_form();

//$zawartosc.=$db->select("select nazwisko,zamowienie FROM klienci",array("nazwisko","zamowienie"));


if(filter_input(INPUT_POST,"Pokaz")){
  
    $zawartosc.=$db->select("select Nazwisko,Zamowienie from klienci",array("Nazwisko","Zamowienie"));
}
else
    if(filter_input(INPUT_POST,'Java')){
        $zawartosc.=$db->select("select Nazwisko,Zamowienie from klienci where Zamowienie regexp 'Java'",array("Nazwisko","Zamowienie"));
    }
  
else if(filter_input(INPUT_POST,'Dodaj')){
     $nazwisko= filter_input(INPUT_POST,'nazwisko',FILTER_SANITIZE_STRING);
        $wiek= filter_input(INPUT_POST,'wiek',FILTER_SANITIZE_NUMBER_INT);
        $panstwo= filter_input(INPUT_POST,'panstwo',FILTER_SANITIZE_MAGIC_QUOTES);
        $email= filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
        $karta= filter_input(INPUT_POST,'karta',FILTER_SANITIZE_MAGIC_QUOTES);
        $zamowienie= filter_input(INPUT_POST,'tech',FILTER_SANITIZE_MAGIC_QUOTES);
      
        
        
       
   if(!($nazwisko && $wiek && $panstwo && $email && $karta && $zamowienie)){
       echo "Nazwisko ".$nazwisko." ".$wiek." ".$panstwo." ".$email." ".$karta." ".$zamowienie;
   }
              
                   else {
                             
                       $sql="INSERT INTO klienci VALUES(NULL,'$nazwisko','$wiek','$panstwo','$email','$zamowienie','$karta')";
                       if($db->insert($sql)) echo "Rekord został dodany</br>";
                       else echo "Rekord nie został dodany</br>";
                   }                         
}