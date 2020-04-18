<?php
require_once('php/common.php');
if(!Session::is_set()){
    redirect('index.php');
}

if($_SESSION['user']->tipo == 0){
    redirect_user($_SESSION['user']);
}

start_rb();
$caronas = R::find('caronas', 'usuarios_id = ? and status = 1', [$_SESSION['user']->id]);

if(empty($caronas)){
    redirect(base_url('criar.php'));
}else{
    foreach($caronas as &$carona){
        if(count($carona->ownCaronasUsuariosList) > 0){
            $carona->from = R::load('cidades', $carona->from);
            $carona->to = R::load('cidades', $carona->to);
        }
    }

    $hasPedido = false;
    foreach($caronas as &$carona){
        //verifica se existem pedidos em espera
        foreach($carona->ownCaronasUsuariosList as &$pedidos){
            if($pedidos->status == 0){
                $hasPedido = true;
                break;
            }
        }
    }

    //redireciona caso não existam pedidos para serem aceitos/recusados
    if(!$hasPedido)
        redirect(base_url('criar.php'));
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <link rel="stylesheet" href="<?php echo base_url('material_design/material.min.css')?>">
        <script defer src="<?php echo base_url('material_design/material.min.js')?>"></script>
        <title>Gerenciar Caronas</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo base_url('css/style.css')?>" rel="stylesheet">  
    </head>
    <body>
    <!-- header do site -->
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header">
            <div class="mdl-layout__header-row item-centralizado">
                <span class="mdl-layout-title">CaronAki</span>
            </div>
        </header>

        <!--menu-->
        <?php require_once("menu.php");?>
        <!--menu-->

    <div class="mdl-layout__content">
    <!-- conteudo da pagina -->
    <main>
        <div class="content-grid mdl-grid">
            <?php foreach($caronas as &$carona)
                    foreach($carona->ownCaronasUsuariosList as &$pedido):?>
                    <?php if($pedido->status != 0) continue;?>
             <!-- Inicio do card de avaliaçao-->
            <div class="demo-card-square mdl-card mdl-shadow--2dp item-centralizado card-padding">
                <div class="item-centralizado">
                    <h5>Pedido de carona</h5>
                    <span class="mdl-chip">
                        <span class="mdl-chip__text"><?php echo $carona->from->nome; ?></span>
                    </span>
                    <span class="mdl-chip">
                        <span class="mdl-chip__text"><?php echo $carona->to->nome; ?></span>
                    </span>
                    <span class="mdl-chip">
                        <?php list($dia, $hora) = formatar_data($carona->data);?>
                        <span class="mdl-chip__text"><?php echo $dia . " as " . $hora; ?></span>
                    </span>
                </div>
                <div class="mdl-card__actions mdl-card--border titulo-centralizado">
                    <span class="mdl-chip mdl-chip--contact card-contato-area-texto">
                        <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white card-contato-tamanho-img">A</span>
                        <span class="mdl-chip__text"><?php echo $pedido->usuarios->nome; ?></span>
                    </span>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                <form method="post" action="<?php echo base_url('php/aceitar_pedido.php')?>">
                    <button type="submit" name="status" value="1" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
                        <span class="mdl-button "><i class="material-icons green-icon">check</i> Aceitar </span>
                    </button>
                    <button type="submit" name="status" value = "2" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
                        <span class="mdl-button "><i class="material-icons red-icon">cancel</i> Negar</span>
                    </button>
                    <input type="hidden" name="pedido" value="<?php echo $pedido->id; ?>">
                </form>
                </div>
            </div>
            <!-- Fim do card de avaliaçao-->  
            <?php endforeach;?>
        
        </div>

    </main>
    
    <!-- Rodape do site -->
        <?php require_once("footer.php");?> 
    <!-- Rodape do site -->
                
    </div>
    </div>
    </body>
</html>