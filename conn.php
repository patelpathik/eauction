<?php

    $s="localhost";
    $u="root";
    $p="root";
    $db="eauction";

    $conn= new mysqli($s,$u,$p,$db);
    
    if($conn->connect_errno != 0){
        echo "<h2>!!Databse Error!!<br>Error No.:".$conn->connect_errno.": ".$conn->connect_error."</h2>";
        die();
    }
?>