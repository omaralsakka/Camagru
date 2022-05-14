<?php

    // selecting filter
    // if (isset($_POST['filterNumber'])){
    //     $filter = '../media/filters/'.$_POST['filterNumber'];

    // }

    if (isset($_POST['image']) && isset($_POST['filterNumber'])){
        $filter = imagecreatefrompng('../media/filters/'.$_POST['filterNumber']);
        $filter2 = imagecreatefrompng('../media/filters/f2.png');
        $img = $_POST['image'];
        imagecopymerge($filter2, $filter, 10, 10, 0, 0, 350, 120, 60);
        header("Content-Type: image/png");
        $result = null;
        imagepng($filter2, $result);
        echo $result;
        // echo "<img src=".$img.">";

                // those alone can display png image on screen
        // header("Content-Type: image/png");
        // $filter = imagecreatefrompng('../media/filters/f1.png');
        // imagepng($filter);
    }
        
?>