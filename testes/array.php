<?php
    $a = array("a", "b", "c", "d", "e");
    var_dump($a);
    echo "<br>Qtd = ".sizeof($a);

    $the_one = 0;
    unset($a[$the_one]);
    array_splice($a, $the_one, 0);

    echo "<br><br>T_o = $the_one<br><br>";

    var_dump($a);
    echo "<br>Qtd = ".sizeof($a);
?>