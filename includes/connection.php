<?php
//open connection to DB
  $conn= new mysqli("localhost","root","","super_market");
    if(!$conn){
        die("cannot connect to server");
    }
   
?>