<?php 
function redirect($path){
    $path=ROOT.$path;
    header("Location:$path");
}
?>