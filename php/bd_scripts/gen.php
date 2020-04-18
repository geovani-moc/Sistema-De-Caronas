<?php

require_once("../common.php");
start_rb();

$users = R::dispense('usuarios');
$caronas = R::dispense('caronas');
$rsenhas = R::dispense('rsenhas');

$users->nome = "abcdefghijabcdefghijabcdefghij";
$users->user = "abcdefghijabcdefghij";
$users->senha = "abcdefghijabcdefghijabcdefghijkl";
$users->telefone = "abdefgihjabcdefghij";
$users->email = "abcdefghijabcdefghijabcdefghij";
$users->tipo = 1;
$users->avaliacao_pos = 0;
$users->avaliacao_neg = 0;
$users->carro = "abcdefghijabcdefghijabcdefghij";

$caronas->from = 0;                     //id da cidade
$caronas->to = 0;                       //id da cidade
$caronas->data = '1995-12-05 19:00:00'; //data de partida
$caronas->vagas = 0;
$caronas->status = 0;                   //finalizado(0) ou aberta(1)

$rsenhas->usuario = 0;
$rsenhas->data = '1995-12-05 19:00:00';
$rsenhas->token = "abcdefghijabcdefghijabcdefghijkl";

$users->ownCaronasList[] = $caronas;
//$users->sharedCaronasList[] = $caronas;
//status -> 0 em espera, 1 aceito, 2 negado / avaliada -> 0 não avaliada, 1 up, 2 down
$users->link('caronas_usuarios', ['status' => 0, 'avaliada' => 0])->caronas = $caronas;

R::store($users);

$moc = R::dispense('cidades');
$moc->nome = "Montes Claros";
$bh = R::dispense('cidades');
$bh->nome = "Belo Horizonte";
$jan = R::dispense('cidades');
$jan->nome = "Januária";

R::store($moc);
R::store($bh);
R::store($jan);
//R::store($caronas);
//R::store($pedidos);
//R::store($rsenhas);

?>