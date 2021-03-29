

&lt;form action="css.php" method="post"&gt;
&lt;textarea name="tekst"&gt;&lt;/textarea&gt;&lt;br/&gt;
&l&lt;input type="submit" name="wyslij" value="Wyslij"/&gt;
&lt;/form&gt;
&lt;div&gt;
<?php
    if(filter_input(INPUT_POST,'wyslij'))
            echo strip_tags ($_POST['tekst']);
            //echo htmlspecialchars($_POST['tekst']);

?>
&lt;/div&gt;

