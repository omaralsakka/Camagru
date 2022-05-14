<?php

    if (isset($_POST['filterNumber'])){
        $filter = '../media/filters/'.$_POST['filterNumber'];
        echo $filter;
    }

    if (isset($_POST['base64image'])){
        echo "<img src=".$_POST['base64image']."> <h1>".$_POST['filter']."</h1>";
    }
    if (isset($_POST['filter'])){
        echo "<h1>".$_POST['filter']."</h1>";
    }
        
?>