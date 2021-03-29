<?php

class Strona{
protected $zawartosc;
protected $tytul="Moduł serwis PHP";
protected $slowa_kluczowe="narzedzia internetowe php, formularz, galeria";
protected $przyciski=array("Kontakt"=>"?strona=index",
    "Galeria"=>"?strona=galeria","Formularz"=>"?strona=formularz",
    "O nas"=>"?strona=onas");

//interfejs klasy- metody modyfikujące fragmenty strony

public function ustaw_zawartosc($nowa_zawartosc){
    $this->zawartosc=$nowa_zawartosc;
}

function ustaw_tytul($nowy_tytul){
    $this->tytul=$nowy_tytul;
}

function ustaw_slowa_kluczowe($nowe_slowa){
    $this->slowa_kluczowe=$nowe_slowa;
}

function ustaw_przyciski($nowe_przyciski){
    $this->przyciski=$nowe_przyciski;
}

public function ustaw_style($url){
    echo '<link rel="stylesheet" href="'.$url.'"type="text/css" />';
    
}


// interfejs klasy - funkcja wyświetlające stronę

public function wyswietl()
{
    $this->wyswietl_naglowek();
    $this->wyswietl_zawartosc();
    $this->wyswietl_stopke();
}

public function wyswietl_tytul(){
    echo "<title>$this->tytul</title>";
}

public function wyswietl_slowa_kluczowe(){
    echo "<meta name=\"keywords\" contents=\"$this->slowa_kluczowe\">";
    
}

public function wyswietl_menu(){
    echo "<div id='nav'>";
    while(list($nazwa,$url)=each($this->przyciski)){
        echo '<a href="'.$url.'">'.$nazwa.'</a>';
    }
    echo "</div>";
}

public function wyswietl_naglowek(){
    ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
            $this->ustaw_style('css/style.css');
            echo "<title>".$this->tytul."</title></head><body>";
    
}

public function wyswietl_zawartosc(){
    echo "<div id='tresc'>";
    echo "<div id='nag'>";
    echo "<img src='zdjecia/foto.JPG' alt='foto' /></div>";
    echo "<div id='menu'>";
    $this->wyswietl_menu();
    echo "</div>";
    echo "<h1>".$this->tytul."</h1>";
    echo $this->zawartosc."</div>";
    
}

public function wyswietl_stopke(){
    echo '<div id="stopka">&copy;MM</div>';
    echo '</body></html>';
}

}
