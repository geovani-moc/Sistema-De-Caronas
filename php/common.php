<?php

require_once("rb.php");
require_once("sessao.php");
session_start();

$burl = "http://localhost/";

function base_url($data){
    global $burl;
    $path = "";
    if(is_array($data)){
        foreach($data as $d){
            $path .= $d . '/';
        }
    }else{
        $path = $data;
    }

    return ($burl . $path);
}

function start_rb(){
    R::setup('mysql:host=localhost;dbname=caronaki', 'root', '');
    //R::freeze();
}

function redirect($url){
    header("location: $url");
    exit();
}

function redirect_user($user){
    if($user->tipo == 1){
        redirect(base_url('gerenciar.php'));
    }else{
        redirect(base_url('carona.php'));
    }
}

function valida($valida, $campos){
    foreach($campos as $campo){
        if(!isset($valida[$campo])){
            echo $campo . ' não enviado';
            return false;
        }
        if(empty($valida[$campo])){
            echo $campo . ' vazio';
            return false;
        }
    }
    return true;
}

function formatar_data($data, $formato = 'm/d h:i'){
    return explode(' ', (new DateTime($data))->format($formato));
}

function load_cidades(&$caronas){
    $caronas->from = R::load('cidades', $caronas->from);
    $caronas->to = R::load('cidades', $caronas->to);
}
?>