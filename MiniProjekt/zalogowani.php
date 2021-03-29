<?php

include_once 'klasy/Baza.php';
include_once 'klasy/UserManager.php';
include_once 'klasy/User.php';

$db=new Baza("localhost","root","M!m?1999","klienci");
$um=new UserManager();
session_start();
$session= session_id();
$userId=$um->getLoggedInUser($db, $session);

if($userId!=-1){
    
    echo "<a href='processLogin.php?akcja=wyloguj'>Wyloguj</a></p>";
    $sql="SELECT * FROM users WHERE id='$userId'";
    echo "<h4>Dane zalogowanego użytkownika</h4>";
    $user=$db->select($sql,array("id","userName","fullName","email"));
    echo $user;
    
}
else    header ("location:processLogin.php");
    




        ?>

