<?php

session_start();

function autoloadClasses($className){
    $classFile = __DIR__ ."/../classes/$className.php";
    
    if(file_exists($classFile)){
        require_once  $classFile;
    }else{
        die("No se pudo cargar la clase: $classFile");
    }
}

spl_autoload_register('autoloadClasses');

?>