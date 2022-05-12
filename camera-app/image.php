<?php
if (isset($_POST['base64image'])){
        echo "<img src=".$_POST['base64image'].">";
    }
?>