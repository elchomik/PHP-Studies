<?php

include_once 'klasy/Baza.php';
class UserManager{
    
    function loginForm(){
        ?>
<h3>Formularz logowania</h3><p>
<form action="processLogin.php" method="post">
    
    <table>
        <tr>
            <td>Login:</td>
            <td><input name="login"/></td>
        </tr>
        <tr>
            <td>Hasło:</td>
            <td><input type="password" name="passwd"/></td>
        </tr>
        
    </table>
  
<input type="submit" value="Zaloguj" name="zaloguj"/>
</form></p> <?php

    }
    
    function login($db){
        //funkcja sprawdzająca poprawność logowania
        
        $args=[
                'login'=>FILTER_SANITIZE_MAGIC_QUOTES,
                'passwd'=>FILTER_SANITIZE_MAGIC_QUOTES
        ];
        
        //przefiltruj dane zgodnie z ustawionymi w $args filtrami
        $dane= filter_input_array(INPUT_POST,$args);
        
        $login=$dane["login"];
        $passwd=$dane["passwd"];
        $userId=$db->selectUser($login,$passwd,"users");
        if($userId>=0){
            session_start(); //rozpoczynamy sesje
            $_SESSION['login']=$login; //atrybutowi sesji login przypisujemy wartość login
            $_SESSION['passwd']=$passwd; //atrybutowi sesji login przypisujemy wartość passwd
            $lastUpdate=(new DateTime)->format("Y-m-d H:i:s"); //ustawiamy date
            $sessionId=session_id(); //ustawiamy Id sesji
            $sql="INSERT INTO logged_in_users VALUES('$sessionId','$userId','$lastUpdate')";
            $db->insert($sql);
          
            
        }
        
        return $userId;
    }
    
    function logout($db){
        session_start();
        $sessionId= session_id();
         $_SESSION=array();
        if(isset($_COOKIE[session_name()])){
            setcookie (session_name (),'',time()-42000,'/');
        session_destroy();
        }
        $sql="DELETE FROM logged_in_users WHERE sessionId='$sessionId'";
        $db->delete($sql);
        
    }
    
    public function getLoggedInUser($db,$sessionId){
        
       
        $userId=-1;
        $sql="SELECT * FROM logged_in_users WHERE sessionId='$sessionId'";
       if($result=$db->getMysqli()->query($sql)){
           $ile=$result->num_rows;
           if($ile==1){
               $row=$result->fetch_object();
               $userId=$row->userId;
           }
       }
       
     
       return $userId;
}
}