<?php

session_start();

$_SESSION['userName']='kubus';
$_SESSION['fullName']='Kubus Puchatek';
$_SESSION['email']='kubus@stumilowylas.pl';
$_SESSION['status']='ADMIN';

$_COOKIE['name']="Cookie";
echo "Session ID: ".session_id()."<br/><br/>";
echo "Zmienne sesji: <br/><br/>";
echo "username  ".$_SESSION['userName']."<br/>";
echo "fullname  ".$_SESSION['fullName']."<br/>";
echo "email ".$_SESSION['email']."<br/>";
echo "status    ".$_SESSION['status']."<br/><br/><br/>";

echo "Ciasteczka <br/>";
echo "Nazwa     ".$_COOKIE['name']."<br/><br/>";
setcookie('Sesja', session_id());
echo "PHPSESSID:    ".$_COOKIE['PHPSESSID']."<br/><br/>";


echo '<a href="test2.php">Przejdź do strony test2';

?>