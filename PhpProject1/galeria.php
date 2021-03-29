<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
      /*  $nazwa='obraz1';
        print("<img src='miniaturki/$nazwa.JPG' alt='$nazwa' />");
        */
        function getImages($rows,$cols){
            $nazwa=1;
            for($i=0;$i<$rows;$i++){
                for($j=0;$j<$cols;$j++){
                 print("<img src='miniaturki/obraz$nazwa.JPG' alt='obraz.$nazwa' />");
                 if($j==$cols-1)
                         echo "</br>";
              $nazwa++;
            }     
            }
        }
        getImages(3,2);
        ?>
    </body>
</html>
