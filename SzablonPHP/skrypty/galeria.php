<?php

$tytul="Galeria";



function getImages(){
 
    $zawartosc1="<img src='miniaturki/obraz1.JPG' alt='obraz1.jpg'/>";
    $nazwa=2;
    
    for($i=0;$i<9;$i++){
        $zawartosc1.="<img src='miniaturki/obraz$nazwa.JPG' alt='obraz$nazwa.jpg'/>";
         $nazwa++;
    }
  
    return $zawartosc1;
}

$zawartosc=getImages();


