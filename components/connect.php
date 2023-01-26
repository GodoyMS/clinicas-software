<?php


try{
    $conn = new PDO("mysql:host=localhost;dbname=software_clinicas;port=3307","root","");
    
} catch(PDOException $err){
    $error_message = $err->getMessage();
    echo $error_message;
    
}
?>


