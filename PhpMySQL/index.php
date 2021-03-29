<!DOCTYPE html>


        <?php
        include 'Formularz.php';
        include 'Klasy/Baza.php';
            drukuj_form();
            
            // stowrzenie uchwytu do bazy danych
            $db=new Baza("localhost","root","M!m?1999","klienci");
            
            if(filter_input(INPUT_GET,"submit")) {
                $akcja= filter_input(INPUT_GET,"submit");
                switch($akcja){
                    case "Dodaj":dodajdoBD($db);break;
                    case "Pokaz":echo $db->select("select nazwisko,zamowienie FROM klienci",array("nazwisko","zamowienie"));break;
                    case "Usun":echo deleteDB($db);break;
                }
            }
            
           
          
        ?>

