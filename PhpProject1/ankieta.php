<!DOCTYPE html>

<?php include_once "ankietaFunkcje.php";?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>ANKIETA</title>
    </head>
    <body>
        <br>
        <?php
            function drukujForm(){?>
        
        <form method="get" action="#">
            <div>Wybierz technologie, które znasz:</div>
            <?php
            $technologie=["C","C++","Java","C#","HTML","CSS","XML","PHP","javaScript"];
            foreach($technologie as $element){
                echo "<input type='checkbox' name='tech[]' value=$element />".$element."<br>";
                
            }
            ?>
            <input type="submit" name="submit" value="Vote"/>
            <input type="submit" name="submit" value="Zobacz wyniki"/>
   
        </form>
        </body>
</html> 
            <?php }
            
drukujForm();
if(filter_input(INPUT_GET,"submit")){
    $akcja= filter_input(INPUT_GET,"submit");
    switch($akcja){
        case  "Vote" :dodaj();pokaz();break;
        case "Zobacz wyniki":pokaz();break;
    }
}
?>


