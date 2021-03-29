
<?php
        
function walidacja(){
    
    //tablica zawierająca filtry pól formularza
    $args=array(
      'tech'=>['filter'=>FILTER_SANITIZE_FULL_SPECIAL_CHARS,'flags'=>FILTER_REQUIRE_ARRAY],
        
    );
    
    //filtracja danych z GET lub POST
    $dane= filter_input_array(INPUT_GET, $args);
    
    //sprawdzamy poprawność danych
    $errors="";
    foreach($dane as $key=>$val){
        if($val===false or $val===NULL)
            $errors.=$key." ";
    }
    if($errors===NULL){
        save("ankieta.txt",$dane);
    }
    else echo "<br>Niepoprawne dane: ".$errors."</br>";
}

function dodaj(){
    echo "Dodawanie do pliku ...<br/>";
    walidacja();
}

function save($fileName,$danepliku){
    echo "<br>Oddałeś głos na :<br/>";
    foreach ($danepliku as $lang){
        saveChanges($fileName,$danepliku);
        echo $danepliku."   <br/>";
    }
}


function saveChanges($fileName,$langFromFile){
    if(filter_input(INPUT_SERVER,"DOCUMENT_ROOT")){
        $d_root= filter_input(INPUT_SERVER,"DOCUMENT_ROOT");
        
        $myfile=fopen("$d_root/../MojaAnkieta/dane.txt","r+");
        if(!$myfile){
            echo "<p>Błąd otwarcia pliku</p>";exit;
        }
        $dataFromFile=file("$d_root/../MojaAnkieta/dane.txt");
       // flock($myfile,LOCK_EX);
        
        $dataToFile="";
        $pom=false;
        
        foreach($dataFromFile as $row){
            if(preg_match('/'.$langFromFile.'/', $row)){
                
                $additionalArr=explode("-",$row);
                $num=((int)$additionalArr[1]);
                $additionalArr[1]=(string)$num;
                $row= implode("-", $additionalArr)."\n";
                $pom=true;
            }
            $dataToFile.=$row;
        }
        // jeżeli nie występuje dopisz język do końca pliku
        
        if($pom===false)$dataFromFile.="<br>".$langFromFile."-1\n";
        
        //zapisywanie do pliku $dataToFile
        fwrite($handle, $dataToFile);
       // flock($handle, LOCK_UN);
        fclose($handle);
    }
    else echo "Błąd SERVER ROOT";
}

function pokaz(){
      $d_root= filter_input(INPUT_SERVER,"DOCUMENT_ROOT");
       $plik=fopen("$d_root/../MojaAnkieta/dane.txt","r");
       if(!$plik) echo "<p>Błąd otwarcia pliku</p>";
       
       $dataFromFile= file("$d_root/../MojaAnkieta/dane.txt");
       //flock($plik,LOCK_EX);
       
       //zamiana tablic na tablice asocjacyjne
       foreach($dataFromFile as $row){
           $additionalArr= explode("-", $row);
           $asTable[$additionalArr[0]]=$additionalArr[1];
       }
       
       //posortuj malejąco
       arsort($asTable);
       echo "<br>Wyniki Głosowania</br>";
      foreach($asTable as $key=>$value){
          echo " ".$key." - $value<br/>";
      }
     // flock($plik,LOCK_UN);
      fclose($plik);
      
}
?>

