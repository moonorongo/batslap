<?php 
    require_once("config.php");
    header('Content-Type: application/json');
   
    $files = scandir($docRoot ."/img/gen", 1);
    
    $out = Array();
    
    for($i=0; $i<5; $i++) {
        $out[] = $files[$i];
    }
    
    echo json_encode($out);
?>