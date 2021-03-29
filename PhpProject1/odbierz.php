<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
       
        <?php
            echo '<h2>Dane odebrane z formularza:</h2>';
            if(isset($_REQUEST['nazwisko'])&&($_REQUEST['nazwisko']!="")){
                $nazwisko= htmlspecialchars(trim($_REQUEST['nazwisko']));
                echo 'Nazwisko:'.$nazwisko.'<br/>';
            }
            else echo 'Nie wpisano nazwiska<br/>';
            
            if(isset($_REQUEST['wiek'])&&($_REQUEST['wiek']!="")){
                $wiek= htmlspecialchars(trim($_REQUEST['wiek']));
                echo 'Wiek: '.$wiek.'<br/>';
            }
            else echo 'Nie wpisano wieku<br/>';
            
            $tech=["PHP","Java","C++"];
           
            foreach($array as $klucz){
                if(isset($_REQUEST['tech[]'])){
                    $technologia= htmlspecialchars($_REQUEST['tech[]']);
                    echo 'Wybrano technologie'.$technologia.'<br/>';
                }
            }
            /*
            if(isset($_REQUEST['PHP'])){
                $technologia= htmlspecialchars($_REQUEST['PHP']);
            echo 'Technologia: '.$technologia.'<br/>';
            }
            else echo 'Brak technologii';
           
            if(isset($_REQUEST['JAVA'])){
                $technologia2= htmlspecialchars($_REQUEST['JAVA']);
            echo 'Technologia: '.$technologia2.'<br/>';
            }
            
            if(isset($_REQUEST['C++'])){
                $technologia3= htmlspecialchars($_REQUEST['C++']);
            echo 'Technologia: '.$technologia3.'<br/>';
            }
            else echo 'Brak technologii';
  */
        ?>
    </body>
</html>
