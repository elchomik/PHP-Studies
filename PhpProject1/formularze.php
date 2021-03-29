<!DOCTYPE html>


        <?php
        include 'PHPFile.php';
           
            
            drukuj_form();
            if(filter_input(INPUT_GET,"submit")) {
                $akcja= filter_input(INPUT_GET,"submit");
                switch($akcja){
                    case "Dodaj":dodaj();break;
                    case "Pokaz":pokaz();break;
                    case "Wyczysc":wyczysc();break;
                    case "Java": pokaz_zamowienie("Java");break;
                    case "PHP": pokaz_zamowienie("PHP");break;
                    case "C++":pokaz_zamowienie("C++");break;
                    case "Statystyki":statystyka();break;
                }
            }
            
            echo "<br/>";
            echo "<br/>";
            echo "INFORMACJE SERWERA<br/><br/>";
            echo "<br>".var_dump($_SERVER)."<br/>";
            //ServerInfo();
        ?>

