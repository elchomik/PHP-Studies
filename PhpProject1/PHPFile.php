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
                <option>Uganda</option>
                <option>Madagaskar</option>
                <option>Benin</option>
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
            <input type="submit" name="submit" value="Wyczysc"/>
            <input type="submit" name="submit" value="Pokaz"/>
            <input type="submit" name="submit" value="Java"/>
            <input type="submit" name="submit" value="PHP"/>
            <input type="submit" name="submit" value="C++"/>
            <input type="submit" name="submit" value="Statystyki"/>
            
        </form>
    </body>
</html>  
            <?php }
           /*
             function dodaj(){
                $dane="";
               
                if(isset($_REQUEST["nazwisko"])){
                    $dane.=htmlspecialchars($_REQUEST['nazwisko'])."   ";
                    
                }
                
                if(isset($_REQUEST["wiek"])){
                    $dane.= htmlspecialchars($_REQUEST['wiek'])."   ";
                    
                }
               
                
                if(isset($_REQUEST["select"])){
                    $dane.= htmlspecialchars($_REQUEST['select'])." ";
                }
                
                if(isset($_REQUEST["email"])){
                    $dane.= htmlspecialchars($_REQUEST['email'])."  ";
                }
                
                
                if(!empty($_POST["tech"])){
                    foreach ($_POST["tech"] as $value){
                        $dane.=$value." ";
                    }
                }
                
               if(!empty($_REQUEST["karta"])){
                   foreach($_REQUEST["karta"] as $platnosc){
                       $dane.=$platnosc."   ";
                   }
               }
                
               
               $root=$_SERVER['DOCUMENT_ROOT'];
                 echo $dane."<br/>";
                 $dane.="\n";
                 $myfile=fopen("$root/pliki/dane.txt","a");
                 fwrite($myfile, $dane);
                 fclose($myfile);
            }
            */ 
            
            function walidacja(){
                $args= array(
                  'nazwisko'=>['filter'=>FILTER_VALIDATE_REGEXP,'options'=>['regexp'=>'/^[A-Z]{1}[a-ząęłńśćźżó-]{1,25}$/']],
                  'wiek'=>['filter' => FILTER_VALIDATE_REGEXP,'options' => ['regexp' => '/^[0-9]{1,3}$/']], 
                  'select'=>FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                  'email'=>['filter' => FILTER_SANITIZE_EMAIL, 'flags' => FILTER_VALIDATE_EMAIL],
                  'tech'=>['filter'=>FILTER_SANITIZE_SPECIAL_CHARS,
                            'flags'=>FILTER_REQUIRE_ARRAY],
                 
                   'karta'=>FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                
                
                $dane= filter_input_array(INPUT_GET,$args);
                //pokaż tablicę po przefiltrowaniu - sprawdź wyniki filtrowania
                var_dump($dane);
                
                //Sprawdź czy dane w tablicy $dane nie zawierają błędów walidacji
                $errors="";
                
                foreach( $dane as $key => $val){
                    if($val===false or $val===NULL){
                        $errors.=$key." ";
                    }
                }
                if($errors===""){
                    dopliku("dane.txt",$dane);
                }
                else{
                    echo "<br>Nie poprawne dane : ".$errors;
                }
                }
                
                function dodaj(){
                    echo "<h3>Dodawanie do pliku:</h3>";
                    walidacja();
                }
                
                function dopliku($plik,$tablicadanych){
                    $dane="";
                    $pom=false; // zmienna pomocnicza żeby prawidłowo dopisać średnik
                    
                    //dodaj do zmiennej $dane(String) zmienną $tablicaDanych(tablica asocjacyjna)
                    
                    foreach($tablicadanych as $val){
                        if(is_array($val)){
                            foreach ($val as $element){
                             if($pom){
                                 $dane.=";";
                             }
                             $dane.=$element;
                             $pom=true;
                            }
                            $dane.=" ";
                        }
                        else{
                            $dane.=$val." ";
                        }
                    }
                    $dane.=PHP_EOL; // dodaj koniec linii za pomocą stałej PHP
                    
                    if(filter_input(INPUT_SERVER,"DOCUMENT_ROOT")){
                        $d_root=filter_input(INPUT_SERVER,"DOCUMENT_ROOT");
                        $myfile=fopen("$d_root/../pliki/dane.txt","a");
                        if(!$myfile){
                            echo "<p>Błąd otwarcia pliku</p>";
                        }
                        flock($myfile,LOCK_EX);
                        fwrite($myfile, $dane);
                        flock($myfile, LOCK_UN);
                        fclose($myfile);
                        echo "<p>Zapisano: <br/>$dane</p>";
                    }
                    else{
                        print("Błąd filter_input(INPUT_SERVER,'DOCUMENT_ROOT)");
                    }
                }
            function pokaz(){
                 $root=$_SERVER['DOCUMENT_ROOT'];
               $myfile=fopen("$root/../pliki/dane.txt","r");
               while(!feof($myfile)){
                   $odczyt_z_pliku=fgets($myfile,100);
                   echo $odczyt_z_pliku."<br/>";
               }
               fclose($myfile);
              
            }
            
            function wyczysc(){
                 $root=$_SERVER['DOCUMENT_ROOT'];
                $myfile= fopen("$root/../pliki/dane.txt","w+");
                $dane=" ";
                fwrite($myfile, $dane);
                fclose($myfile);
            }
            
            function pokaz_zamowienie($lang){
                 $root=$_SERVER['DOCUMENT_ROOT'];
                $myfile=fopen("$root/../pliki/dane.txt","r");
                while(!feof($myfile)){
                    $odczyt_z_pliku_2=fgets($myfile,100);
                    if(strstr($odczyt_z_pliku_2,$lang)){
                        echo $odczyt_z_pliku_2."<br/>";
                    }
                }
                fclose($myfile);
                
            }
           
           
            function statystyka(){
               $root=$_SERVER['DOCUMENT_ROOT'];
                $myfile=fopen("$root/../pliki/dane.txt","r");
                if(!$myfile){
                    echo '<p>Błąd otwarcia pliku </p>';
                }
                
                // pobierz dane z pliku dane.txt do tablicy(jeden wiersz=jedna linia) korzystamy z file
                
                $tablica=file("$root/../pliki/dane.txt");
                
                //zliczamy wiersze w tablicy
                $ilosc_zamowien=(count($tablica));
                echo "<p>Liczba zamówień = $ilosc_zamowien</p><br/>";
                
                $ponizej=0;
                $powyzej=0;
                $brak=0;
                
                foreach($tablica as $ele){
                    $new_tab= explode(" ",$ele);
                    
                    foreach($new_tab as $wartosc){
                    
                       
                        if(preg_match("/^[0-9]{1,3}$/",$wartosc)){
                            if($wartosc<18) $ponizej+=1;
                            else if($wartosc>50) $powyzej+=1;
                            else $brak+=1;
                        }
                    }
                }
                echo "<br>Liczba osób zamawiających poniżej 18 lat : $ponizej<br/>";
                echo "<br>Liczba osób zamawiających powyżej 50 lat : $powyzej<br/>";
                echo "<br>Liczba osób w innym przedziale wiekowym : $brak<br/>";
                
                   fclose($myfile);
            }
            
        
             
        ?>
 
