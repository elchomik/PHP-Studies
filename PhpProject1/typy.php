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
            $integer=134;
            $double=67.67;
            $integer2=1;
            $integer3=0;
            $boolean=true;
            $string="0";
            $string_2="Typy w PHP";
            $array=[1,2,3,4];
            $count1=count($array);
            $array2=[];
            $count2=count($array2);
            $array3=["zielony","czerwony","niebieski"];
            $count3=count($array3);
            $today=new DateTime();
            echo "integer = $integer <br/>";
            echo "double = $double<br/>";
            echo "integer2 = $integer2<br/>";
            echo "integer3 = $integer3<br/>";
            echo "boolean = $boolean<br/>";
            echo "string = $string<br/>";
            echo "string_2 =$string_2<br/>";
            for($i=0;$i<$count1;$i++){
                echo "element[$i] =$array[$i]<br/>";
            }
            for($i=0;$i<$count2;$i++){
                echo "element[$i] =$array2[$i]<br/>";
            }
            for($i=0;$i<$count3;$i++){
                echo "array[$i] = $array3[$i]<br/>";
            }
           echo is_int($integer)."<br/>";
           echo is_bool($boolean)."<br/>";
           echo "czy podana wartość jest double".is_double($double)."<br/>";
           echo is_numeric($string)."<br/>";
           echo is_string($string_2)."<br/>";
           echo is_object($today)."<br/>";
           echo is_array($array3)."<br/>";
           echo "działanie var_dump". var_dump($array)."<br/>";
           echo "działanie var_dump na pustej tablicy".var_dump($array2)."<br/>";
           echo "działanie var_dump na tablicy string ".var_dump($array3)."<br/>";
           echo "print_r".print_r($array)."<br/>";
           echo "print_r_2".print_r($array2)."<br/>";
           echo "print_r_3".print_r($array3)."<br/>";
            echo "Today is $today<br/>";
        ?>
    </body>
</html>
