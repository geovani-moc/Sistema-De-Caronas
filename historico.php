<?php
require_once('php/common.php');
if(!Session::is_set()){
    redirect('index.php');
}

start_rb();
$usuario = R::load('usuarios', $_SESSION['user']->id);
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <link rel="stylesheet" href="<?php echo base_url('material_design/material.min.css')?>">
        <script defer src="<?php echo base_url('material_design/material.min.js')?>"></script>
        <title>Avaliar</title>
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

            <!-- Inicio do card de status-->
            <?php foreach($usuario->ownCaronasUsuariosList as &$pedido):?>
            <?php
                load_cidades($pedido->caronas);
                list($dia, $hora) = formatar_data($pedido->caronas->data);

                if($pedido->caronas->status == 0) continue;
            ?>
            <div class="demo-card-square mdl-card mdl-shadow--2dp item-centralizado card-padding">
                <div class="item-centralizado">
                    <h5>Status da carona</h5>
                    <span class="mdl-chip">
                        <span class="mdl-chip__text"><?php echo $pedido->caronas->from->nome; ?></span>
                    </span>
                    <span class="mdl-chip">
                        <span class="mdl-chip__text"><?php echo $pedido->caronas->to->nome; ?></span>
                    </span>
                    <span class="mdl-chip">
                        <span class="mdl-chip__text"><?php echo $dia . " as " . $hora?></span>
                    </span>
                </div>
                <div class="mdl-card__actions mdl-card--border titulo-centralizado">
                    <span class="mdl-chip mdl-chip--contact card-contato-area-texto">
                        <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white card-contato-tamanho-img">A</span>
                        <span class="mdl-chip__text"><?php echo $pedido->caronas->usuarios->nome; ?></span>
                    </span>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <span>Status da carona: </span>
                    <?php if($pedido->status == 0):?>
                    <span>Em avaliação <i class="material-icons">mood</i></span>
                    <?php elseif($pedido->status == 1):?>
                    <span>Aceita <i class="material-icons green-icon">check</i></span>
                    <?php elseif($pedido->status == 2):?>
                    <span>Negada <i class="material-icons red-icon">cancel</i></span>
                    <?php endif;?>
                </div>
            </div>
            <?php endforeach; ?>
            <!-- Fim do card de status-->

            
             <!-- Inicio do card de avaliaçao-->
            <?php foreach($usuario->ownCaronasUsuariosList as &$pedido):?>
            <?php
                list($dia, $hora) = formatar_data($pedido->caronas->data);

                //mostrar pedidos de caronas ativas
                if($pedido->caronas->status == 1) continue;
            ?>
            <div class="demo-card-square mdl-card mdl-shadow--2dp item-centralizado card-padding">
                <div class="item-centralizado">
                    <h5>Avaliar carona</h5>
                    <span class="mdl-chip">
                        <span class="mdl-chip__text"><?php echo $pedido->caronas->from->nome; ?></span>
                    </span>
                    <span class="mdl-chip">
                        <span class="mdl-chip__text"><?php  echo $pedido->caronas->to->nome; ?></span>
                    </span>
                    <span class="mdl-chip">
                        <span class="mdl-chip__text"><?php echo $dia . " as " . $hora; ?></span>
                    </span>
                </div>
                <div class="mdl-card__actions mdl-card--border titulo-centralizado">
                    <span class="mdl-chip mdl-chip--contact card-contato-area-texto">
                        <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white card-contato-tamanho-img">A</span>
                        <span class="mdl-chip__text"><?php echo $pedido->caronas->usuarios->nome; ?></span>
                    </span>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                <?php if($pedido->avaliada == 0):?>
                <form method="post" action="<?php echo base_url('php/avaliar.php');?>">
                    <button type="submit" name="nota" value="1" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
                        <span class="mdl-button "><i class="material-icons green-icon">thumb_up</i> Gostei </span>
                    </button>
                    <button type="submit" name="nota" value = "0" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
                        <span class="mdl-button "><i class="material-icons red-icon">thumb_down</i> Ruim</span>
                    </button>
                    <input type="hidden" name="carona" value="<?php echo $pedido->caronas->id; ?>">
                    <input type="hidden" name="usuario" value="<?php echo $pedido->usuarios->id; ?>">
                </form>
                <?php elseif($pedido->avaliada == 1):?>
                    <span class="mdl-button "><i class="material-icons green-icon">thumb_up</i> Gostei </span>
                <?php else:?>
                    <span class="mdl-button "><i class="material-icons red-icon">thumb_down</i> Ruim </span>
                <?php endif;?>
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