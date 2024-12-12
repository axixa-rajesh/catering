<?php 
function redirect($path){
    $path=ROOT.$path;
    header("Location:$path");
}
function mustlogin(){
    if(!Session::get('logindtl')){
        redirect('users');
        exit;
    }
}
?>