<?php

require_once('common.php');

if(!Session::is_set()){
    redirect(base_url('index.php'));
}

if(!isset($_POST['usuario'], $_POST['carona'], $_POST['nota'])){
    redirect(base_url('historico.php'));
}

start_rb();
$carona = R::find('caronas_usuarios', 'usuarios_id = ? and caronas_id = ?', [$_POST['usuario'], $_POST['carona']]);

if(!empty($carona)){
    $carona = reset($carona);
    if($_POST['nota'] == 1){
        $carona->caronas->usuarios->avaliacao_pos++;
        $carona->avaliada = 1;
    }else if($_POST['nota'] == 0){
        $carona->caronas->usuarios->avaliacao_neg++;
        $carona->avaliada = 2;
    }

    R::store($carona);
}

redirect(base_url('historico.php'));

?>