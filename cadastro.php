<?php 
    require_once('php/common.php');
    if(Session::is_set()){
        redirect_user($_SESSION['user']);
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <link rel="stylesheet" href="<?php echo base_url('material_design/material.min.css')?>">
        <script defer src="<?php echo base_url('material_design/material.min.js')?>"></script>
        <title>Cadastro</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo base_url('css/style.css')?>" rel="stylesheet">
    </head>
    <body>
        <!-- header  do site -->
        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
                <span class="mdl-layout-title item-centralizado"><a href="index.php">CaronAki</a></span>
            </div>
        </header>
        <div class="mdl-layout__content">
    <main>
    <!--corpo do site-->
        <div class="content-grid mdl-grid">
            <div class="demo-card-square mdl-card mdl-shadow--2dp item-centralizado card-padding">
                <div class="item-centralizado">
                    <h4>Nova Conta</h4>
                    <?php if(isset($_GET['error'])):?>
                    <span class='alerta-senha__error'><?php echo $_GET['error']?></span>
                    <?php endif;?>
                </div>
                 <div class="mdl-card__actions mdl-card--border titulo-centralizado">
                    <form method="POST" action="<?php echo base_url('php/cadastrar.php')?>">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" name='nome'>
                        <label class="mdl-textfield__label" for="sample3">Nome Completo</label>
                        </div><br>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" name='user'>
                        <label class="mdl-textfield__label" for="sample3">Usuario (para fazer login)</label>
                        </div><br>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="email" name='email'>
                        <label class="mdl-textfield__label" for="sample3">E-mail</label>
                        </div><br>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="password" name='senha'>
                        <label class="mdl-textfield__label" for="sample3">Senha</label>
                        </div><br>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="password" name='confirmasenha'>
                        <label class="mdl-textfield__label" for="sample3">Confirmar senha</label>
                        </div><br>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="number" name='telefone'>
                        <label class="mdl-textfield__label" for="sample3">telefone para contato</label>
                        <span class='mdl-textfield__error'>Somente numeros</span>
                        </div><br>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" name='carro'>
                        <label class="mdl-textfield__label" for="sample3">Carro (Para oferecer carona)</label>
                        </div><br>

                        <button type ='submit' name='login' value = '1' class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
                            Criar conta
                        </button>
                        <br>
                    </form>
                    <br>
                 </div>
            </div>
        </div>
        
    </main>
    <!-- Rodape do site -->
    <?php require_once("footer.php");?> 
    <!-- Rodape do site -->

    </body>
</html>