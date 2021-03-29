<?php

    session_start();
$_SESSION['userName'] = 'kubus';
$_SESSION['fullName'] = 'Kubus Puchatek';
$_SESSION['email'] = 'kubus@stumilowylas.pl';
$_SESSION['status'] = 'ADMIN';


echo "Session_ID: ".session_id()."<br/><br/>";
echo "Zmienne sesji: <br/><br/>";
echo "username".$_SESSION['userName']."<br/>";
echo "fullname".$_SESSION['fullName']."<br/>";
echo "email".$_SESSION['email']."<br/>";
echo "Status".$_SESSION['status']."<br/><br/><br/>";

session_destroy();
echo '<a href="test1.php">Przejdź do strony test1 </a>';
    

?>