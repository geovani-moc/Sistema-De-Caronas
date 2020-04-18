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
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo base_url('css/style.css')?>" rel="stylesheet"> 
    </head>
    <body>
    <!-- header  do site -->
        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
                <span class="mdl-layout-title item-centralizado">CaronAki</span>
            </div>
        </header>
    <div class="mdl-layout__content">
    <!-- corpo  do site -->
    <main>
        <div class="content-grid mdl-grid item-centralizado">             
            <div class="demo-card-square mdl-card mdl-shadow--2dp item-centralizado card-padding">
                <div class = 'item-centralizado'>
                    <img src="img/2.jpg" class="avatar-login">
                </div>
                <?php if(isset($_GET['error'])):?>
                <span class='alerta-senha__error'><?php echo $_GET['error']?></span>
                <?php endif;?>
                <div class="mdl-card__actions mdl-card--border titulo-centralizado">
                    <form method="POST" action="<?php echo base_url(array('php', 'autenticar.php'))?>">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" name='usuario'>
                        <label class="mdl-textfield__label" for="sample3">Usuario</label>
                        </div><br>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="password" name ='senha'>
                        <label class="mdl-textfield__label" for="sample3">Senha</label>
                        </div><br>

                        <button type='submit' name='login' value='1' class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
                            Entrar
                        </button>
                        <a href="cadastro.php" class="mdl-button mdl-js-button mdl-button--primary">
                            Criar Conta
                        </a>
                    </form><br>
                    <a href='<?php echo base_url(array("index.php")) . '?alterarsenha=1';?>' class="mdl-button mdl-js-button mdl-button--primary">Esqueci minha senha</a>
                    <?php
                        if(isset($_GET['alterarsenha']))
                        {
                            $x = $_GET['alterarsenha'];
                            if($x == 1)
                            {
                                $nome = "nome da pessoa"; 
                                $email = "email da pessoa";
                                $token = "tokem de teste";
                                $arquivo = "Para inserir nova senha click no link: <a href=alterar_senha.php/?token=$token?'>";

                                //enviar
  
                                //emails para quem será enviado o formulário
                                $emailenviar = "seuemail@seudominio.com.br";
                                $destino = $emailenviar;
                                $assunto = "Contato pelo Site";

                                //É necessário indicar que o formato do e-mail é html
                                $headers  = 'MIME-Version: 1.0' . "\r\n";
                                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                                    $headers .= 'From: $nome <$email>';
                                //$headers .= "Bcc: $EmailPadrao\r\n";
                                
                                $enviaremail = mail($destino, $assunto, $arquivo, $headers);
                                if($enviaremail)
                                {
                                    $mgm = "E-MAIL ENVIADO COM SUCESSO! <br> O link será enviado para o e-mail fornecido no formulário";
                                    echo $mgm;
                                } 
                                    else
                                    {
                                        $mgm = "ERRO AO ENVIAR E-MAIL!";
                                        echo "";
                                    }
                            }
                        }
                    ?>
                </div>
            </div> 
        </div>
        
    </main>
    <!-- Rodape-->
    <?php require_once("footer.php");?> 
    <!-- Rodape-->
           
 
    </body>
</html>