<?php

class User{
    
    protected $userName;
    protected $passwd;
    protected $fullName;
    protected $email;
    protected $date;
    protected $status;
    const STATUS_USER=1;
    const STATUS_ADMIN=2;
    
 
    
    function __construct($userName,$fullName,$email,$passwd) {
        $this->status=User::STATUS_USER;
        $this->userName=$userName;
        $this->passwd=password_hash($passwd,PASSWORD_DEFAULT);
        $this->fullName=$fullName;
        $this->email=$email;
        $this->date=(new DateTime)->format('Y-m-d');
        
    
        
    }
    
  

    function saveDB($db){
        
     
        echo "Udało się ";
        
      $sql='INSERT INTO users VALUES(NULL,"'.$this->getUserName().'","'.$this->getFullName().'","'.$this->getEmail().'","'.$this->getPasswd().'",'.$this->getStatus().',"'.$this->getDate().'")';
        
        if($db->insert($sql))
        echo "Utworzono nowy rekord";
        else echo "Nie udało się";
       
       
    }

    public static function getAllUserFromDB($db){
        echo $db->select("select userName,fullName from users",array("userName","fullName"));
        
    }
    

    function show(){
        echo "Imie i Nazwisko : ".$this->fullName."<br/>";
        echo "Nazwa użytkownika : ".$this->userName."<br/>";
        echo "Adres email : ".$this->email."<br/>";
        echo "Hasło : ".$this->passwd."<br/>";
        echo "Status : ".$this->status."<br/>";
        echo "Data utworzenia : ".$this->date."<br/>";
    }
    
    public static function getAllUsers($plik){
        $tab= json_decode(file_get_contents($plik));
        foreach($tab as $val){
            echo "<p>".$val->userName." ".$val->fullName." ".$val->date ."</p>";
            
        }
        
    }
    
    function toArray(){
        $arr=[
            "userName"=>$this->userName,
            "fullName"=>$this->fullName,
            "passwd"=>$this->passwd,
            "email"=>$this->passwd,
            "date"=>$this->date,
            "status"=>$this->status
        
        ];
        return $arr;
    }
    
    function save($plik){
        $tab= json_decode(file_get_contents($plik),true);
        array_push($tab, $this->toArray());
        file_put_contents($plik, json_encode($tab));
    }
    
    function getPasswd() {
        return $this->passwd;
    }

    function getFullName() {
        return $this->fullName;
    }

    function getEmail() {
        return $this->email;
    }

    function getDate() {
        return $this->date;
    }

    function getStatus() {
        return $this->status;
    }

    function setPasswd($passwd): void {
        $this->passwd = $passwd;
    }

    function setFullName($fullName): void {
        $this->fullName = $fullName;
    }

    function setEmail($email): void {
        $this->email = $email;
    }

    function setDate($date): void {
        $this->date = $date;
    }

    function setStatus($status): void {
        $this->status = $status;
    }

    function getUserName() {
        return $this->userName;
    }

    function setUserName($userName): void {
        $this->userName = $userName;
    }


}



