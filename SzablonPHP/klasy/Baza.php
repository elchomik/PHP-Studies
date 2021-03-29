<?php

class Baza{
  
    private $mysqli; //uchwyt do Bazy danych
    function getMysqli() {
        return $this->mysqli;
    }

    function setMysqli($mysqli): void {
        $this->mysqli = $mysqli;
    }

        public function __construct($serwer,$user,$pass,$baza) {
        $this->mysqli=new mysqli($serwer,$user,$pass,$baza);
        
        //sprawdzamy połączenie z bazą
        
        if($this->mysqli->connect_errno){
            printf("Nie udało się połączenie z serwerem: %s\n", $this->mysqli->connect_errno);
            exit();
   
        }
        //zmieniamy kodowanie UTF-8
        if($this->mysqli->set_charset("utf8")){
            //udało się zmienić kodowanie
        }
        
    }
    
    function __destruct() {
        $this->mysqli->close();
    }
    
    public function select($sql,$pola){
        //parametr $sql-łańcuch zapytania select
        //parametr $pola -tablica z nazwami pól w bazie
        //Wynik funkcji- kod HTML tabeli z rekordami (String)
        
        $tresc= "";
        if($result= $this->mysqli->query($sql)){
            $ilepol=count($pola); //ile pól
            $ile=$result->num_rows; //ile wierszy
            
            //pętla po wyniku zapytania $results
            $tresc.="<table><tbody>";
            while ($row=$result->fetch_object()){
                $tresc.="<tr>";
                for($i=0;$i<$ilepol;$i++){
                    $p=$pola[$i];
                    $tresc.="<td>".$row->$p."</td>";
                }
                $tresc.="</tr>";
            }
            $tresc.="</table></tbody>";
            $result->close(); //zwalniamy pamięć
        }
        return $tresc;
    }
    
    public function insert($sql) {
        
        if($this->mysqli->query($sql)===TRUE){
            echo "Dodany nowy rekord";
            return TRUE;
        }
        else echo "Nie udało się dodać nowego rekordu ".$sql;
        return false;
        
    }
    
    public function delete($sql){
        
      if($this->mysqli->query($sql)===TRUE){
          echo "Rekord usunięty<br/>";
          return true;
      }
      else{
          echo "Rekord nie został usunięty<br/>";
          return false;
      }
    }
    
    public function selectUser($login,$passwd,$tabela){
        
        $id=-1;
        $sql="SELECT * FROM $tabela WHERE userName='$login'";
        if($result= $this->mysqli->query($sql)){
            $ile=$result->num_rows;
            
            if($ile==1){
                $row=$result->fetch_object(); //pobieramy rekord  użytkownikiem
                $hash=$row->passwd; //pobieramy zahaszowane hasło użytkownika
                
                //sprawdzamy czy hasło pasuje do tego samego hasła z tabeli bazy danych
                
                if(password_verify($passwd, $hash))
                        $id=$row->id; //jeśli hasła się zgadzają- pobieramy id użytkownika
            }
        }
        return $id;
    }
}

?>
