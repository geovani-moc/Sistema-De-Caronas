<?php require_once('php/common.php');?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <link rel="stylesheet" href="<?php echo base_url('material_design/material.min.css')?>">
        <script defer src="<?php base_url('material_design/material.min.js)'?>"></script>
        <title>Alterar Senha</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo base_url('css/style.css')?>" rel="stylesheet">
    </head>
    <body>
    <body>
        <!-- header  do site -->
        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
                <span class="mdl-layout-title item-centralizado"><a href="index.html">CaronAki</a></span>
            </div>
        </header>
        <div class="mdl-layout__content">
    <main>
    <!--corpo do site-->
        <div class="content-grid mdl-grid">
            <div class="demo-card-square mdl-card mdl-shadow--2dp item-centralizado card-padding">
                <div class="item-centralizado">
                    <h3>Alterar Senha</h3><br><br>
                </div>
                 <div class="mdl-card__actions mdl-card--border titulo-centralizado">
                    <form method="POST" action="#">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="password" name='senha'>
                        <label class="mdl-textfield__label" for="sample3">Nova senha</label>
                        </div><br>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="password" name='confirmasenha'>
                        <label class="mdl-textfield__label" for="sample3">Confirmar senha</label>
                        </div><br>

                        <button type ='submit' name='login' value = '1' class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
                            Alterar Senha
                        </button>
                        <br>
                    </form>
                    <br>
                 </div>
        </div>
        
    </main>
    </body>
</html>