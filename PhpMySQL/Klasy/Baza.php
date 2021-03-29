<?php

class Baza{
  
    private $mysqli; //uchwyt do Bazy danych
    
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
          echo "Rekord usunięty";
          return true;
      }
      else{
          echo "Rekord nie został usunięty";
          return false;
      }
    }
}

?>
