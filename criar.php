<?php
require_once('php/common.php');
if(!Session::is_set()){
    redirect('index.php');
}

if($_SESSION['user']->tipo == 0){
    redirect('carona.php');
}

start_rb();
$cidades = R::findAll('cidades');
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <link rel="stylesheet" href="<?php echo base_url('material_design/material.min.css')?>">
        <script defer src="<?php echo base_url('material_design/material.min.js')?>"></script>
        <title>Criar nova Carona</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo base_url('css/style.css')?>" rel="stylesheet">  
    </head>
    <body>
    <!-- header do site -->
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
                <span class="mdl-layout-title titulo-centralizado"> CaronAki </span>
            </div>
        </header>
        <!--menu-->
            <?php require_once("menu.php");?>
        <!--menu-->
    <div class="mdl-layout__content">
    <!-- conteudo da pagina -->
    <main>
        <div class="content-grid mdl-grid item-centralizado">             
            <div class="demo-card-square mdl-card mdl-shadow--2dp item-centralizado card-padding">
                <div>
                    <img class ='img-card' src="<?php echo base_url('img/5.jpg');?>">
                </div>
                <div class="mdl-card__actions mdl-card--border titulo-centralizado">
                    <form method="POST" action="<?php echo base_url('php/criar_carona.php');?>">

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label card-busca--item">
                         <select name="partida" class="mdl-button mdl-button--raised">
                            <?php foreach($cidades as &$cidade):?>
                            <option value="<?php echo $cidade->id?>"><?php echo $cidade->nome;?></option>
                            <?php endforeach;?>
                        </select>                             
                        </div>         

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label card-busca--item">
                        <select name="destino" class="mdl-button mdl-button--raised">
                            <?php foreach($cidades as &$cidade):?>
                            <option value="<?php echo $cidade->id?>"><?php echo $cidade->nome;?></option>
                            <?php endforeach;?>
                        </select> 
                        </div><br>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" name='vagas' pattern="-?[0-9]*(\.[0-9]+)?">
                        <label class="mdl-textfield__label" for="sample3">Vagas disponiveis</label>
                        <span class="mdl-textfield__error">A entrada deve conter somente numeros</span>
                        </div><br>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="datetime-local" value="<?php echo date('Y-m-d') . 'T06:00:00'?>" name ="hora">
                        <label class="mdl-textfield__label" for="sample3">Horario da saída(Horas:Minutos)</label>
                        </div><br>

                        <button type ='submit' name='criar' value = '1' class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
                            Criar carona
                        </button>
                        <!--<button type ='submit' name= 'agendar' value = '2' class="mdl-button mdl-js-button mdl-button--primary">
                            Agendar
                        </button>-->

                    </form>
                </div>
            </div> 
        </div>

    </main>
    <!-- Rodape do site -->
    <?php require_once("footer.php");?> 
    <!-- Rodape do site -->

            
    </div>
    </div>
    </body>
</html>