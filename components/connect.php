<!-- FOR PRODUCTION -->

<?php

/*

try{
    $conn = new PDO("mysql:host=localhost;dbname=software_clinicas;port=3307","root","");
    
} catch(PDOException $err){
    $error_message = $err->getMessage();
    echo $error_message;
    
}
*/
?>



<!-- FOR DEPLOYMENT -->
<?php

try{
    $conn = new PDO("mysql:host=localhost;dbname=u268124124_alpha_clinicas;port=3307","u268124124_ac_user","Crystalcave31!");
    
} catch(PDOException $err){
    $error_message = $err->getMessage();
    echo $error_message;
    
}

?>



