<?php

require_once('common.php');

if(!Session::is_set()){
    redirect(base_url('index.php'));
}

if(valida($_POST, ['partida', 'destino', 'vagas', 'hora']) == false){
    redirect(base_url('criar.php') . '?error=Dados Inválidos');
}else{
    //avaliar restrições...

    start_rb();
    $carona = R::dispense('caronas');

    $carona->usuarios = $_SESSION['user'];
    $carona->from = $_POST['partida'];
    $carona->to = $_POST['destino'];
    $carona->data = str_replace('T', ' ', $_POST['hora']);
    $carona->vagas = $_POST['vagas'];
    $carona->status = 1;

    R::store($carona);
    redirect(base_url('gerenciar.php'));
}

?>