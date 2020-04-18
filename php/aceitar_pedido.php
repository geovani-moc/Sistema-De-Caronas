<?php

require_once('common.php');

if(!Session::is_set()){
    redirect(base_url('index.php'));
}

if($_SESSION['user']->tipo == 0){
    redirect_user($_SESSION['user']);
}

if(!isset($_POST['pedido'], $_POST['status'])){
    redirect_user($_SESSION['user']);
}

start_rb();
$pedido = R::load('caronas_usuarios', $_POST['pedido']);

if(!empty($pedido)){
    if($_POST['status'] == 1){
        $pedido->status = 1;
    }else{
        $pedido->status = 2;
    }
    R::store($pedido);
}

redirect(base_url('gerenciar.php'));

?>