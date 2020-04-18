<?php

require_once('common.php');

if(!Session::is_set()){
    redirect(base_url('index.php'));
}

if(!isset($_POST['carona'])){
    redirect_user($_SESSION['user']);
}

start_rb();
$carona = R::load('caronas', $_POST['carona']);

if($carona){
    $carona->link('caronas_usuarios', ['usuarios_id' => $_SESSION['user']->id,'status' => 0, 'avaliada' => 0]);
    R::store($carona);
    redirect(base_url('carona.php'));
}

redirect(base_url('carona.php'));


?>