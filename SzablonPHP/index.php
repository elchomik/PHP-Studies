<?php

require_once("klasy/Strona.php");
$strona_akt=new Strona();

//Sprawdzamy co wybrał użytkownik
if(filter_input(INPUT_GET,'strona')){
    $strona= filter_input(INPUT_GET,'strona');
    switch($strona){
        case 'galeria':$strona='galeria';break;
        case 'formularz':$strona='formularz';break;
        case 'onas':$strona='onas';break;
        default:$strona='glowna';
    }
}else{
    $strona='glowna';
}

//dołacz wybrany plik z ustawioną zmieną $styl i $zawartosc
$plik="skrypty/".$strona.".php";
if(file_exists($plik)){
    require_once($plik);
    $strona_akt->ustaw_tytul($tytul);
    $strona_akt->ustaw_zawartosc($zawartosc);
    $strona_akt->wyswietl();
}