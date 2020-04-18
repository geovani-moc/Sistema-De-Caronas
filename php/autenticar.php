<?php

require_once('common.php');

if(Session::is_set()){
    redirect_user($_SESSION['user']);
}

if(valida($_POST, ['usuario', 'senha']) == false){
    redirect(base_url('index.php') . '?error=Dados Inválidos');
}else{

    //tenta autenticar

    start_rb();
    $user = R::find('usuarios', 'user = ? and senha = ?', array($_POST['usuario'], md5($_POST['senha'])));
    if(empty($user)){
        redirect(base_url('index.php') . '?error=Dados Inválidos');
    }else{
        $user = reset($user);
        Session::create($user);
        redirect($user);
    }
}