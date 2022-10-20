<?php
    $servername="localhost";
    $username="";
    $password="";
    $dbname = "";
    $conn= new mysqli($servername,$username,$password,$dbname);
    if ($conn->connect_error): die("ERROR: Connection failed: " . $conn->connect_error); endif;
?>