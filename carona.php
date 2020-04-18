<?php
    require_once('php/common.php');
    if(!Session::is_set()){
        redirect('index.php');
    }

    start_rb();

    $cidades = R::findAll('cidades');

    $caronas = array();
    if(isset($_POST['busca'])){
        $caronas = R::find(
            'caronas', 
            'status = 1 and vagas > 0 and `from` = ? and `to` = ? order by data desc',
            [$_POST['partida'], $_POST['destino']]);
    }

?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <link rel="stylesheet" href="<?php echo base_url('material_design/material.min.css')?>">
        <script defer src="<?php echo base_url('material_design/material.min.js')?>"></script>
        <title>Caronas</title>
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

        <!-- inicio busca de caronas -->
        <div class="card-busca">
            <form method="post" action="<?php echo base_url('carona.php')?>">
                <select name="partida" class="mdl-button mdl-button--raised card-busca--item">
                    <?php foreach($cidades as &$cidade):?>
                    <option 
                        <?php if(isset($_POST['partida']) && $_POST['partida'] == $cidade->id) echo "selected";?>
                        value="<?php echo $cidade->id?>">
                            <?php echo $cidade->nome;?>
                    </option>
                    <?php endforeach;?>
                </select> 
                
                <select name="destino" class="mdl-button mdl-button--raised card-busca--item">
                    <?php foreach($cidades as &$cidade):?>
                    <option 
                            <?php if(isset($_POST['destino']) && $_POST['destino'] == $cidade->id) echo "selected";?>
                            value="<?php echo $cidade->id?>">
                                <?php echo $cidade->nome;?>
                    </option>
                    <?php endforeach;?>
                </select> 
                <button type="submit" name="busca" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect card-busca--item"><i class="material-icons">search</i>Buscar</button> 
            </form>
        </div>
        <!-- fim busca de caronas -->

        <?php foreach($caronas as &$carona):?>
        <?php
            list($dia, $hora) = explode(' ', (new DateTime($carona->data))->format('m/d h:i'));
        ?>
        <!-- Inicio do card-->
        <div class="card-carona mdl-card mdl-shadow--2dp mdl-cell">
            <div class="mdl-card__title mdl-card--expand">
                <h2 class="mdl-card__title-text"><i class="material-icons"> event_note</i><?php echo $dia . " as " . $hora?><i class="material-icons"> access_time</i></h2>
            </div>
            <div class="mdl-card__supporting-text">
                <span class="mdl-chip mdl-chip--contact card-contato-area-texto">
                    <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white card-contato-tamanho-img">A</span>
                    <span class="mdl-chip__text"><?php echo $carona->usuarios->nome; ?></span>
                    <br><br>
                    <span class="mdl-button "><?php echo $carona->usuarios->avaliacao_pos; ?> <i class="material-icons green-icon">thumb_up</i></span>
                    <span class="mdl-button "><?php echo $carona->usuarios->avaliacao_neg; ?> <i class="material-icons red-icon">thumb_down</i></span>
                </span>
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <form method="post" action="<?php echo base_url('php/pedir_carona.php')?>" >
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Pedir carona <i class="material-icons green-icon">person_pin_circle</i></button>
                    <input type="hidden" name="carona" value="<?php echo $carona->id; ?>">
                </form>
            </div>
        </div>
        <!-- Fim do card-->
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