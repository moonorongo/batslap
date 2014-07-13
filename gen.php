<?php 
    require_once("config.php");
    require($docRoot .'/Box.php');
    
    $font = $docRoot ."/ttf/Laffayette_Comic_Pro.ttf"; 
    $textRobin = (isset($_GET["r"]))? $_GET["r"] : "Batman...";
    $textBatman =(isset($_GET["b"]))?  $_GET["b"] : "Callate!";
    $textRobin2 = (isset($_GET["r2"]))? $_GET["r2"] : "Pero...";
    $textBatman2 =(isset($_GET["b2"]))?  $_GET["b2"] : "Que te calles!!!";
    $t = (isset($_GET["t"]))?  $_GET["t"] : "1";
    $c = (isset($_GET["c"]))?  $_GET["c"] : "0";

    switch($t) {
        case "1" : $backgroundFile = "/img/master.png";
                   break;
        case "2" : $backgroundFile = "/img/master2.png";
                   break;
    }
    
    // background plantilla
    $im = imagecreatefrompng($docRoot . $backgroundFile);

    if($t == "1") {
        // texto 1
        $box = new Box($im);
        $box->setFontFace($font);
        $box->setFontSize(18);
        $box->setLeading(1);
        $box->setBox(3, 3, 290, 120);
        $box->setTextAlign('center', 'center');
        $box->draw($textRobin);    

        
        // texto2 
        $box = new Box($im);
        $box->setFontFace($font);
        $box->setFontSize(18);
        $box->setLeading(1);
        $box->setBox(337, 3, 306, 120);
        $box->setTextAlign('center', 'center');
        $box->draw($textBatman);    
    } else if($t == "2") {
        // texto Robin 1
        $box = new Box($im);
        $box->setFontFace($font);
        $box->setFontSize(16);
        $box->setLeading(1);
        $box->setBox(62, 3, 264, 101);
        $box->setTextAlign('center', 'center');
        $box->draw($textRobin);    

        
        // texto Batman 1
        $box = new Box($im);
        $box->setFontFace($font);
        $box->setFontSize(16);
        $box->setLeading(1);
        $box->setBox(334, 45, 295, 101);
        $box->setTextAlign('center', 'center');
        $box->draw($textBatman);    
    
        // texto Robin 2
        $box = new Box($im);
        $box->setFontFace($font);
        $box->setFontSize(16);
        $box->setLeading(1);
        $box->setBox(35, 128, 277, 128);
        $box->setTextAlign('center', 'center');
        $box->draw($textRobin2);    

        
        // texto Batman 2
        $box = new Box($im);
        $box->setFontFace($font);
        $box->setFontSize(16);
        $box->setLeading(1);
        $box->setBox(331, 170, 291, 137);
        $box->setTextAlign('center', 'center');
        $box->draw($textBatman2);    
    
    } // textos

    
    // texto3
    $box = new Box($im);
    $box->setFontFace($docRoot ."/ttf/arial.ttf");
    $box->setFontSize(10);
    $box->setLeading(1);
    $box->setBox(3, 617, 620, 30);
    $box->setTextAlign('right', 'top');
    $box->draw("generado con batSlapGenerator - www.whitecat.com.ar/demos/batslap");    

    $now = date("Ymdhis");
    

    if(isset($_GET["c"]) && !isset($_GET["d"])) { // si esta seteado Compartir 
        header('Content-Type: application/json');
        imagejpeg($im, $docRoot ."/img/gen/batslap_$now.jpg");
        echo('{"url" : "'. $urlRoot .'/img/gen/batslap_'. $now .'.jpg"}');
    } else if(isset($_GET["d"]) && !isset($_GET["c"])) { // si esta seteado descargar 
        header("Cache-control: private"); header('Pragma: private'); 
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");         
        header('Content-Disposition: attachment; filename="batslap_'. $now .'.jpg"');        
        imagejpeg($im, $docRoot ."/img/gen/batslap_$now.jpg");
        imagejpeg($im);
    } else { // si no esta seteado nada o es incompatible la combinacion : PREVIEW
        header('Content-Type: image/jpeg');
        imagejpeg($im);
    }
    
    imagedestroy($im);
?>






