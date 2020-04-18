<?php

require_once('common.php');

if(Session::is_set()){
    redirect_user($_SESSION['user']);
}

if(valida($_POST, ['nome', 'user', 'email', 'senha', 'confirmasenha', 'telefone']) == false){
    redirect(base_url('cadastro.php') . '?error=Dados Inválidos');
}else{
    //verificar senhas e email...

    start_rb();

    $user = R::find('usuarios', 'user = ? or email = ?', [$_POST['user'], $_POST['email']]);

    if(empty($user)){
        $user = R::dispense('usuarios');
        $user->nome = $_POST['nome'];
        $user->user = $_POST['user'];
        $user->email = $_POST['email'];
        $user->senha = md5($_POST['senha']);
        $user->telefone = $_POST['telefone'];

        if(isset($_POST['carro']) && !empty($_POST['carro'])){
            $user->tipo = 1;
            $user->carro = $_POST['carro'];
        }else{
            $user->tipo = 0;
        }

        $user->avaliacao_pos = 0;
        $user->avaliacao_neg = 0;

        R::store($user);
        Session::create($user);
        redirect_user($user);
    }else{
        redirect(base_url('cadastro.php') . '?error=Usuário/email já cadastrados');
    }
}

?>