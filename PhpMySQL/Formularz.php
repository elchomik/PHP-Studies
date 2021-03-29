<!DOCTYPE html>


        <?php
           function drukuj_form(){ ?>
        <html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="get" action="">
            <label for="nazwisko">Nazwisko:</label>
            <input type="text" name="nazwisko" /><br/>
            <label for="wiek">Wiek:</label>
            <input type="text" name="wiek" /><br/>
            <label for="panstwo">Państwo:</label>
            <select name="select">
                <option>Polska</option>
                <option>Wielka Brytania</option>
                <option>Niemcy</option>
            </select>
            <br>
            <label for="email">Email</label>
            <input type="text" name="email" /><br>
           
            <h2>Zamawiam tutorial z języka</h2><br>
            <input type="checkbox" name="tech[]" value="PHP"/>PHP<br/>
            <input type="checkbox" name="tech[]" value="Java"/>JAVA<br/>
            <input type="checkbox" name="tech[]" value="C++"/>C++<br/>
            
            <h2>Sposób zapłaty</h2>
            <input type="radio" name="karta" value="eurocard"/>eurocard<br/>
            <input type="radio" name="karta" value="visa"/>visa<br/>
            <input type="radio" name="karta" value="przelew"/>przelew<br/>
             
            <input type="submit" name="submit" value="Dodaj"/>
            <input type="submit" name="submit" value="Pokaz"/>
            <input type="submit" name="submit" value="Usun"/>
          
            
        </form>
    </body>
</html>  

           <?php }
           
           function dodajdoBD($db){
               
               if(filter_input(INPUT_GET, 'submit')){
                   include_once 'Klasy/Baza.php';
                   
                   $db=new Baza('localhost','root','M!m?1999','klienci');
                   $nazwisko= filter_input(INPUT_GET,'nazwisko',FILTER_SANITIZE_STRING);
                   $wiek= filter_input(INPUT_GET,'wiek',FILTER_SANITIZE_NUMBER_INT);
                   $panstwo= filter_input(INPUT_GET,'select',FILTER_SANITIZE_MAGIC_QUOTES);
                   $email= filter_input(INPUT_GET,'email',FILTER_SANITIZE_EMAIL);
                   $karta= filter_input(INPUT_GET,'karta',FILTER_SANITIZE_MAGIC_QUOTES);
                   $zamowienie= filter_input(INPUT_GET,'tech[]',FILTER_SANITIZE_MAGIC_QUOTES);
                   
                   if(!($nazwisko && $wiek && $panstwo && $email && $karta && $zamowienie)) echo "Nie wypełniono niektórych pól";
                   
                   else {
                       $sql="INSERT INTO klienci VALUES(NULL,'$nazwisko','$wiek','$panstwo','$email','$zamowienie','$karta')";
                       if($db->insert($sql)) echo "Rekord został dodany</br>";
                       else echo "Rekord nie został dodany</br>";
                       
                   }
               }
           }
                   
                function deleteDB($db){
                    
                    if(filter_input(INPUT_GET,'submit')){
                        include_once 'Klasy/Baza.php';
                        
                    $db=new Baza('localhost','root','M!m?1999','klienci');
                   
                     
                         $sql="DELETE FROM klienci where zamowienie='Java'";
                         if($db->delete($sql)) echo "Rekord został usunięty</br>";
                         else echo "Rekord nie został usunięty";
                     
                     
                    }
                }
                    
                   
                    
                  
               
               
           
         
           
           
           
            
        
             
        ?>
 
